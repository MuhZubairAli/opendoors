<?php

class stats extends Controller {

    private $tableMasks = array(
        'cc' => 'ceo_compensation',
        'as' => 'auditors',
        'cs' => 'companies',
        'ds' => 'degrees',
        'dr' => 'directors',
        'el' => 'edu_levels',
        'mb' => 'missing_bsa',
        'od' => 'os_data',
        'ps' => 'positions',
        'sa' => 'specialization_area',
        'yd' => 'yearly_data'
    );

    function __construct(){
        parent::__construct();
        $this->load_lib('db');
    }

    public function get($table,$filters = null){

        if(!isset($this->tableMasks[$table])){

            http_response_code(404);
            die('Provided data target is invalid');

        }else if($filters === null) {

            return $this->db->count(array(
                'table' => $this->tableMasks[$table]
            ));

        }else if($filters !== null){
            $wc = str_replace('_',' AND ',$filters);
            $wc = str_replace('><','=',$wc);
            return $this->db->count(array(
                'table' =>  $this->tableMasks[$table],
                'where' => $wc
            ));
        }
    }
    

}