<?php
if(!class_exists('Main'))
    require CONTROLLERS_PATH.'Main.php';

class open_data extends Main {
    
    function __construct(){
        parent::__construct();
        $this->plugin->add('open-data');
    }

    public function index(){
        $page_data = array(
            'page_title' => 'Open Doors For All'
        );

        $this->load_view('layout', $page_data);
    }

    public function companies(){
        $page_data = array(
            'page_title' => 'Open Doors For All',
        );

        $this->load_view('layout', $page_data);
    }

    public function reports(){
        $page_data = array(
            'page_title' => 'Open Doors For All'
        );

        $this->load_view('layout', $page_data);
    }

    public function company($company_name='',$type=''){
        $page_data = array(
            'page_title' => 'Open Doors For All',
            'company' => $company_name,
            'type' => $type
        );
        $this->plugin->add('stats');
        $this->load_view('layout', $page_data);
    }

}