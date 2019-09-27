<?php

class Db {
    protected $con;

    function __construct(){
        $this->con = new mysqli("localhost","root","","attaullah");
        if ($this->con->connect_errno) {
            printf("DB Connection Failed: %s\n", $this->con->connect_error);
            exit();
        }
        if (!$this->con->set_charset("utf8")) {
            printf("Error loading character set utf8: %s\n", $this->con->error);
            exit();
        }
        /*
         * if (!$this->con->query("SET time_zone = '+05:00'")) {
            printf("Error changing timezone to +05:00 (Karachi/Islamabad): %s\n", $this->con->error);
            exit();
        }
        */
    }

    //Real escape string
    function res($str,$addBackTick=false){
        if($addBackTick)
            return "`{$this->con->real_escape_string($str)}`";
        return $this->con->real_escape_string($str);
    }

    function select($table,$params=null){
        //if $table is array then $params is treated as boolean for option to return fetch handle instead of data;
        $returnHandle = false;
        if(is_array($table)) {
            $params = $table;
            $returnHandle = ($params) ? true : false;

            if(!isset($params['table'])){
                return $this->response([
                        "status" => 0,
                        "errmsg" => "Db|select]: - 0 - Required parameter 'table' is not provided." ]
                );
            }
            $tbl = $params['table'];
        }else
            $tbl = $table;

        if(isset($params['table']))
            unset($params['table']);

        if(isset($params['where'])) {
            if(is_array($params['where'])){
                $whereClause = '';
                foreach ($params['where'] as $key => $value){
                    $whereClause = trim($key)."'".$this->con->real_escape_string($value)."' ";
                }
                $whereClause = trim($whereClause,' ');
            }else
                $whereClause = $params['where'];
            unset($params['where']);
        }

        $cols = '';
        foreach ($params as $key=>$val){
            if($key==='*'){
                $cols = $key;
                break;
            }
            if(empty($val))
                $cols .= "`" . $this->con->real_escape_string($key) . "`, ";
            else
                $cols .= "`" . $this->con->real_escape_string($key) . "` AS `". $this->con->real_escape_string($val) . "`, ";
        }
        $cols = trim($cols,", ");

        $sql = "SELECT {$cols} FROM `".$tbl."`";
        if(isset($whereClause))
            $sql .= " WHERE {$whereClause}";
        if($query = $this->con->query($sql)){
            if($query->num_rows && $returnHandle){
                return $this->response([
                    "status" => 1,
                    "result" => $query ]
                );
            }else if($query->num_rows===1) {
                return $this->response([
                        "status" => 1,
                        "result" => $query->fetch_assoc() ]
                );
            }else if($query->num_rows>1){
                return $this->response([
                    'status' => 1,
                    'result' => $query->fetch_all()
                ]);
            }
            else{
                return $this->response([
                    "status" => 0,
                    "errmsg" => "Db|select]: - No row selected against specified criteria" ],
                    $sql
                );
            }
        } else
            return $this->response([
                "status" => 0,
                "errmsg" => "Db|select]: - ".$this->con->errno." - ".$this->con->error ] //." | ".$sql
                , $sql
            );
    }

    public function &getConnection()
    {
        return $this->con;
    }

    function response($res,$sql = ''){
        if($res['status']==0)
            error_log(json_encode($res)." || SQL = ".$sql);
        return $res;
    }
    
    function insert($table=null,$params = false,$replace = false){
        if(is_array($table) && is_bool($params)){
            $replace = $params;
            $params = $table;
            if(!isset($params['table']))
                return $this->response([
                    'status'=>0,
                    'errmsg' => 'Db|insert]: - Table name not provided'
                ]);
            $tbl = $params['table'];
        }else if(!empty($table) && is_array($params)){
            $tbl = $table;
        }else {
            return $this->response([
                'status'=>0,
                'errmsg' => 'Db|insert]: - Passed parameters are invalid'
            ]);
        }
        if(isset($params['table'])){
            unset($params['table']);
        }
        $cols = '(';
        $vals = "VALUES (";
        foreach ($params as $key=>$val){
            $cols .= "`" . $key . "`, ";
            $vals .= "'" . $this->con->real_escape_string($val) . "'" . ", ";
        }
        $cols = trim($cols,", ");
        $cols .= ")";
        $vals = trim($vals,", ");
        $vals .= ")";
        if($replace)
            $sql = "REPLACE INTO {$tbl} {$cols} {$vals}";
        else
            $sql = "INSERT INTO $tbl $cols $vals";
        if($this->con->query($sql)){
            return $this->response([
                "status" => 1,
                "insert_id" => $this->con->insert_id ]
            );
        } else
            return $this->response([
                "status" => 0,
                "errmsg" => "Db|insert]: - ".$this->con->errno." - ".$this->con->error ]//." | ".$sql
            , $sql
            );
    }

    function update($params = array()){
        if(!isset($params['table'])){
            return $this->response([
                "status" => 0,
                "errmsg" => "Db|update]: - 0 - Required parameter 'table' is not provided." ]
            );
        }

        if($params['id'] == null){
            return $this->response([
                "status" => 0,
                "errmsg" => "Db|update]: - 0 - Required parameter 'id' is not provided." ]
            );
        }
        $tbl = $params['table'];
        $id  = $this->con->real_escape_string($params['id']);
        unset($params['table']);
        unset($params['id']);
        $setterString = "";
        foreach ($params as $key=>$val){
                $setterString .= "`".$key."`='".$this->con->real_escape_string($val)."', ";
        }

        $setter = trim($setterString,", ");
        $sql = "UPDATE `$tbl` SET $setter WHERE `id`=$id";
        if($this->con->query($sql)){
            return $this->response([
                "status" => 1,
                "mysqli" => $this->con,
                "affected_rows" => $this->con->affected_rows ]
            );
        } else {
            return $this->response([
                "status" => 0,
                "errmsg" => "Db|update]: - " . $this->con->errno . " - " . $this->con->error ] //. " | " . $sql
            , $sql
            );
        }
    }

    function getValueAgainstID($id,$attribute,$table){
        if($query = $this->con->query("select `{$this->con->real_escape_string($attribute)}` from {$this->con->real_escape_string($table)} where id='{$this->con->real_escape_string($id)}'")){
            if($data = $query->fetch_array()){
                return $data[0];
            } else
                return null;
        }else
            return null;
    }

    function checkIfExists($value,$attrib,$table){
        if($query = $this->con->query("select `id` from `".$this->con->real_escape_string($table)."` where `".$this->con->real_escape_string($attrib)."`='".$this->con->real_escape_string($value)."'")){
            if($query->num_rows==1){
                return (int) $query->fetch_array()[0];
            }
        }
        return false;
    }


}