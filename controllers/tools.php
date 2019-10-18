<?php
if(!class_exists('Main'))
    require CONTROLLERS_PATH.'Main.php';
    
class tools extends Main {
    function __construct() {
        parent::__construct();
    }

    function index(){
        echo '<h1>Tools</h1>';
    }

    function icons(){
        $page_data = array(
            'page_title' => 'Open Doors For All'
        );
        $ccss = @"
            div.ico {
                display: inline-block;
                margin: 5px;
                border: 1px solid black;
                padding: 10px;
                text-align: center;
            }
            div.ico p {
                text-decoration: italics;
            }
            div.ico i.fa {
                display: block;
                font-size: 4em;
            }
        ";
        $this->plugin->addCustomCss($ccss);
        $this->load_view('layout', $page_data);
    }
}