<?php
if(!class_exists('Main'))
    require CONTROLLERS_PATH.'Main.php';

class contact extends Main
{
    function __construct()
    {
        parent::__construct();
    }

    function index(){
        $page_data = array(
            'page_title' => 'Closet to Cleaners | Contact Us'
        );
        $this->plugin->add('contact');
        $this->load_view('layout', $page_data);
    }

    function form_post(){
        if(strtolower($_SERVER['REQUEST_METHOD']) !== 'post'){
            return $this->index();
        }
        $vConf = array(
            'type' => 'required',
            'name' => 'required|alpha|min_length[5]|max_length[32]',
            'email' => 'required|email',
            'phone' => 'required|phone|min_length[10]',
            'message' => 'required|alnum|min_length[10]',
            'subject' => 'required|alnum|min_length[6]'
        );
        $this->load_lib('Form',$_POST);
        if($this->form->validate($vConf)) {
            $this->load_lib("Mail");
            $message = @"
<div style='text-align: center;background: #dedede;padding: 50px 0;min-height: 100%;'>
    <h3 class='text-align: center'>Message From <span style='color: navy'>ClosetToCleaners.com</span> Contact Form</h3>
    <table style='width: 70%; margin: 25px auto auto 15%;border-collapse:collapse;text-align:left;background:#efefef' cellpadding='10' border='2'>
        <tbody>
            <tr>
                <th style='min-width: 130px'>Sender Name</th>
                <td>{$_POST['name']}</td>
            </tr>
            <tr>
                <th>Sender Email</th>
                <td>{$_POST['email']}</td>
            </tr>
            <tr>
                <th>Phone Number</th>
                <td>{$_POST['phone']}</td>
            </tr>
            <tr>
                <th>Sender Role</th>
                <td>{$_POST['type']}</td>
            </tr>
            <tr>
                <th>Subject</th>
                <td>{$_POST['subject']}</td>
            </tr>
            <tr>
                <th>Message</th>
                <td>{$_POST['message']}</td>
            </tr>
        </tbody>
    </table>
</div>
";
            $result = $this->mail->send($_POST['name'],$_POST['email'],$_POST['subject'],$message);
            if($result['status'])
                echo "OK";
            else
                echo $result['errmsg'];
        }else
            echo "Failed to validate form data.".json_encode($this->form->get_validation_logs());
    }

}