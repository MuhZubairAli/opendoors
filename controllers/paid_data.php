<?php

if(!class_exists('Main'))
    require CONTROLLERS_PATH.'Main.php';

class paid_data extends Main {
    
    function __construct(){
        parent::__construct();
        $this->plugin->add('paid-data');
    }

    public function index(){
        $page_data = array(
            'page_title' => 'Open Doors For All'
        );
        $this->load_lib('db');
        $this->load_view('layout', $page_data);
    }
}
