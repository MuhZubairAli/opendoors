<?php

class Form {
    protected $form_data = [];
    protected $validation_logs = [];
    protected $validation_rules;
    protected $exceptions_in_alnum = [' ','(',')',',','.','-','&'];
    protected $error_msgs = array(
        'required' => "Required",
        'min_length' => "Must be Greater than or Equal to (attr) Characters long",
        'max_length' => "Must be Less than or Equal to (attr) Characters long",
        'alnum' => "Only alphabets and numbers allowed",
        'alpha' => "Only alphabets allowed",
        'numeric' => "Only Numbers allowed",
        'email' => "Invalid Email Address",
        'greater_than' => "Must be greater than (attr)",
        'less_than' => "Must be less than (attr)",
        'greater_than_the' => "Must be greater than the value of (attr)",
        'less_than_the' => "Must be less than the value of (attr)",
        'text' => "Only alphanumeric and special characters allowed",
        'match' => "Must be equal to (attr)",
        'equal_to' => "Must be equal to the sum of (attr)",
        'phone' => "Phone number is invalid"
    );

    function reset(){
        $this->form_data = [];
        $this->validation_logs = [];
        $this->validation_rules = [];
    }

    function __construct(&$form_data=null)
    {
        if($form_data)
            $this->form_data = $form_data;
    }

    function append_form_data($key,$value){
        $this->form_data[$key] = $value;
    }

    function set_data(&$data){
        $this->form_data =& $data;
    }
    function &get_data(){
        return $this->form_data;
    }

    function clone_data(){
        return $this->form_data;
    }

    function set_validation_logs(&$logs){
        $this->validation_logs =& $logs;
    }
    function &get_validation_logs(){
        return $this->validation_logs;
    }

    function clone_validation_logs(){
        return $this->validation_logs;
    }

    function set_validation_conf(&$vConf){
        $this->validation_rules = $vConf;
    }

    function validate(&$vConfig=null){
        if($vConfig)
            $this->validation_rules =& $vConfig;
        $this->validation_logs = array();
        foreach ($this->validation_rules as $item => $value){
            $rules = explode('|',trim($value,'|'));
            foreach ($rules as $rule){
                $rule_p = explode('[',trim($rule,']'));
                $method = $rule_p[0];
                $params = isset($this->form_data[$item]) ? [$this->form_data[$item]] : [''];
                $gem_args = [$method];
                if(isset($rule_p[1])) {
                    //$args =  explode(',', trim($rule_p[1], ','));
                    //$params = array_merge($params,$args);
                    //$gem_args = array_merge($gem_args,$args);
                    $params[] = trim($rule_p[1], ',');
                    $gem_args[] = trim($rule_p[1], ',');
                }

                if(call_user_func_array(array($this,$method),$params)) {
                    if(!isset($this->validation_logs[$item]))
                        $this->validation_logs[$item] = array();
                    $this->validation_logs[$item][] = call_user_func_array(array($this, 'get_error_msg'), $gem_args); //$this->get_error_msg($method);
                }

            }
        }
        return (count($this->validation_logs)===0);
    }

    private function required($v){
        return empty($v) && strlen($v)===0;
    }

    private function min_length($v,$l){
        return empty($v) ? false : (strlen($v)<$l);
    }

    private function max_length($v,$l){
        return empty($v) ? false : (strlen($v)>$l);
    }

    private function alnum($v){
        $t = str_replace($this->exceptions_in_alnum,'',$v);
        return empty($v) ? false : !(ctype_alnum($t));
    }

    private function alpha($v){
        $t = str_replace($this->exceptions_in_alnum,'',$v);
        return empty($v) ? false : !ctype_alpha($t);
    }

    private function numeric($v){
        return empty($v) ? false : !is_numeric($v);
    }

    private function phone($v){
        $t = str_replace([' ','+'],'',$v);
        return $this->numeric($t);
    }
    private function email($v){
        return empty($v) ? false : !filter_var($v,FILTER_VALIDATE_EMAIL);
    }

    private function greater_than($v,$l){
        return empty($v) ? false : (floatval($v) <= floatval($l));
    }

    private function less_than($v,$l){
        return empty($v) ? false : (floatval($v) >= floatval($l));
    }

    private function greater_than_the($v,$attr){
        return empty($v) ? false : (floatval($v) <= floatval($this->form_data[$attr]));
    }

    private function less_than_the($v,$attr){
        return empty($v) ? false : (floatval($v) >= floatval($this->form_data[$attr]));
    }

    private function match($v,$other){
        return empty($v) ? false : (strcmp($v,$this->form_data[$other])!==0);
    }
    private function text($v){
        $t = str_replace([' ','(',')','-','_','@','&','%','.',',','?','$','!'],'',$v);
        return empty($v) ? false : !ctype_alnum($t);
    }
    private function equal_to($v,$attr){
        $total = 0;
        foreach (explode(',',trim($attr,',')) as $key){
            if(filter_var($this->form_data[$key],FILTER_VALIDATE_INT))
                $total += $this->form_data[$key];
        }
        return empty($v) ? false : bccomp($total,$v)!==0; // $total != $v;
    }
    protected function get_error_msg($func, $attr=''){
        return str_replace("(attr)",$attr,$this->error_msgs[$func]);
    }

    function errors_array($name){
        if(isset($this->validation_logs[$name])){
            if(
                isset($this->validation_logs[$name][0])     &&
                is_array($this->validation_logs[$name][0])
            ){
                $log = array_shift($this->validation_logs[$name]);
                if(count($log) > 0)
                    return $log;
                else
                    return false;
            }else {
                $err =  $this->validation_logs[$name];
                if(count($err)>0)
                    return  $err;
                else
                    return false;
            }
        }
        return false;
    }

    function input_value($name, $valueAttr = true){
        if(isset($this->form_data[$name]) && is_array($this->form_data[$name])){
            $elm = array_shift($this->form_data[$name]);
            if ($valueAttr)
                echo (!empty($elm)) ? " value='{$elm}' " : "";
            else
                echo (!empty($elm)) ? $elm : "";
        }else {
            if ($valueAttr)
                echo (isset($this->form_data[$name])) ? " value='{$this->form_data[$name]}' " : "";
            else
                echo (isset($this->form_data[$name])) ? $this->form_data[$name] : "";
        }
    }
    function input_values_combination($ttl,$id){
        if(isset($this->form_data[$ttl],$this->form_data[$id]))
            echo " value='{$this->combine_title_id($this->form_data[$ttl],$this->form_data[$id])}' ";
        else if(isset($this->form_data[$ttl]) && !isset($this->form_data[$id]))
            $this->input_value($ttl);
    }
    function radio_value($name, $value, $default = false){
        if(isset($this->form_data[$name])) {
            echo ($this->form_data[$name] === $value) ?
                " name='{$name}' value='{$value}' checked " :
                " name='{$name}' value='{$value}' ";
        }else if($default)
            echo " name='{$name}' value='{$value}' checked ";
        else
            echo " name='{$name}' value='{$value}' ";
    }

    function select_value($name, $value, $default = false, $iteration = 0){
        if(isset($this->form_data[$name]) && is_array($this->form_data[$name])){
            $elm = (!empty($this->form_data[$name][$iteration])) ? $this->form_data[$name][$iteration] : '';

            if(!empty($elm)) {
                echo ($elm === $value) ?
                    "<option value='{$value}' selected>" :
                    "<option value='{$value}'>";
            }else if($default)
                echo "<option value='{$value}' selected>";
            else
                echo "<option value='{$value}'>";

        }else {
            if(isset($this->form_data[$name])) {
                echo ($this->form_data[$name] === $value) ?
                    "<option value='{$value}' selected>" :
                    "<option value='{$value}'>";
            }else if($default)
                echo "<option value='{$value}' selected>";
            else
                echo "<option value='{$value}'>";
        }
    }

    function get_value($prop){
        return (isset($this->form_data[$prop])) ? $this->form_data[$prop] : null;
    }

    function combine_title_id($title,$id){
        return "{$title} ({$id})";
    }

    function separate_title_id($str){
        $n_p = explode(' ',$str);
        $id = trim(array_pop($n_p),'()');
        $title = implode(' ', $n_p);
        return ['id'=>$id,'title'=>$title];
    }

    function checkbox_value($name,$value,$default=false){
        if(isset($this->form_data[$name])) {
            echo ($this->form_data[$name] === $value) ?
                " value='{$value}' checked " :
                " value='{$value}' ";
        }else if($default)
            echo " value='{$value}' checked ";
        else
            echo " value='{$value}' ";
    }

    function sanitize_text($text){
        return strip_tags($text);
    }
}