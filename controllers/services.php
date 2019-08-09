<?php
if(!class_exists('Main'))
    require "Main.php";

class services extends Main
{
    function __construct()
    {
        parent::__construct();
        $this->plugin->add([
            'services' => [
                'css' => [ 'style' ]
            ]
        ]);
    }

    function index(){
        $data = [
            'page_title' => 'Closet to Cleaners | Services and Pricing'
        ];
        $this->load_view('layout',$data);
    }

}