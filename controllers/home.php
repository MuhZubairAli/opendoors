<?php
if(!class_exists('Main'))
    require CONTROLLERS_PATH.'Main.php';
class home extends Main {
    function __construct() {
        parent::__construct();
        $this->plugin->add('home');
    }

    function index(){
        $page_data = array(
            'page_title' => 'Open Doors For All'
        );

        $this->plugin->add('izimodal');
        $this->load_view('layout', $page_data);
    }

}