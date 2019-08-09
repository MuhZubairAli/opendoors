<?php
if(!class_exists("Main"))
    require CONTROLLERS_PATH."Main.php";

class apartment extends Main
{
    function __construct()
    {
        parent::__construct();
    }

    function index(){
        $view_data = array(
            'page_title' => "Closet To Cleaners | Apartment Communities"
        );
        $this->plugin->add('apartment');
        $this->load_view('layout',$view_data);
    }
}