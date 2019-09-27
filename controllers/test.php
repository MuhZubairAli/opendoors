<?php
if(!class_exists('Main'))
    require CONTROLLERS_PATH.'Main.php';
    
class test extends Main {
    function __construct() {
        parent::__construct();
    }

    function index(){
        var_dump(stristr('paid-data/companies','paid-data'));
    }

}