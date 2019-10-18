<?php
if(!class_exists('Main'))
    require CONTROLLERS_PATH.'Main.php';
    
class test extends Main {
    function __construct() {
        parent::__construct();
    }

    function index(){
        $name = "VILNIAUS_MIESTO_UNIVERSITETINĖ_LIGONINĖ (1).docx";
        echo substr($name,strrpos($name,'.'));
    }
}