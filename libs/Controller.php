<?php

class Controller {
    protected $message_array = array();
    protected $view_data = array();
    protected $GLOBAL = array();

    function __construct(){
        $this->load_lib('Plugin');
        $this->load_lib('Utils');
    }

    function load_view($view_name='', $view_data=null){
        if($view_data)
            $this->view_data = array_merge($this->view_data, $view_data);
        $view_path = str_replace('/',DS,$view_name);
        if(file_exists(VIEWS_PATH."{$view_path}.php")){

            $temp = array();
            foreach($this->view_data as $key=> $value) {
                if(is_int($key))
                    $temp[] = $value;
                else
                    $$key = $value;
            }

            $DATA_BAG = $temp;

            include(VIEWS_PATH."{$view_path}.php");
        }else {
            $this->message([
                "ttl" => "View Not Found",
                "msg" => "Specified view '{$view_name}' not exists in views directory",
                "logs" => ["view name: {$view_name}", "view data: ".json_encode($view_data)],
                "type" => 'danger'
            ]);
        }
    }

    function load_partial($partial_name, $partial_data=null){
        $this->load_view("partials/{$partial_name}",$partial_data);
    }

    function load_section($section_name,$section_data=null){
        $this->load_view("{$_SERVER['route']['controller']}/sections/{$section_name}",$section_data);
    }

    function load_lib($lib_name, $data = null){
        if(!empty($lib_name)){
            if(!class_exists($lib_name)) {
                if (file_exists(LIBS_PATH . "{$lib_name}.php")) {
                    include(LIBS_PATH . "{$lib_name}.php");
                    $prop = strtolower($lib_name);
                    if ($data)
                        $this->$prop = new $lib_name($data);
                    else
                        $this->$prop = new $lib_name();
                } else {
                    $this->message([
                        "ttl" => "Library Not Found",
                        "msg" => "Specified library '{$lib_name}' not exists in libs directory",
                        "logs" => ["library name: {$lib_name}", "library data: " . json_encode($data)],
                        "type" => 'danger'
                    ]);
                }
            } else {
                $prop = strtolower($lib_name);
                if(!isset($this->$prop)) {
                    if ($data)
                        $this->$prop = new $lib_name($data);
                    else
                        $this->$prop = new $lib_name();
                }else
                    $this->message([
                        "ttl" => "Library Already Loaded",
                        "msg" => "Specified library '{$lib_name}' has already been initialized",
                        "logs" => ["library name: {$lib_name}", "library data: " . json_encode($data)],
                        "type" => "info"
                    ]);
            }
        }else {
            $this->message([
                "ttl" => "Invalid Library",
                "msg" => "Provided library '{$lib_name}' name is invalid or empty",
                "logs" => ["library name: {$lib_name}","library data: ".json_encode($data)],
                "type" => 'danger'
            ]);
        }
    }

    function load_modal($modal_name, $data = null, $reInitialize=false){
        if(!empty($modal_name)){
            if(!class_exists($modal_name)) {
                if (file_exists(MODALS_PATH . "{$modal_name}.php")) {
                    require_once(MODALS_PATH . "{$modal_name}.php");
                    $prop = strtolower($modal_name);
                    if ($data)
                        $this->$prop = new $modal_name($data);
                    else
                        $this->$prop = new $modal_name();
                } else {
                    $this->message([
                        "ttl" => "Modal Not Found",
                        "msg" => "Specified modal '{$modal_name}' not exists in modals directory",
                        "logs" => ["modal name: {$modal_name}", "modal data: " . json_encode($data)],
                        "type" => 'danger'
                    ]);
                }
            } else {
                $prop = strtolower($modal_name);
                if(!isset($this->$prop) || $reInitialize) {
                    $this->$prop = null;
                    if ($data)
                        $this->$prop = new $modal_name($data);
                    else
                        $this->$prop = new $modal_name();
                }else
                    $this->message([
                        "ttl" => "Modal Already Loaded",
                        "msg" => "Specified Modal '{$modal_name}' has already been initialized",
                        "logs" => ["library name: {$modal_name}", "library data: " . json_encode($data)],
                        "type" => "info"
                    ]);
            }
        }else {
            $this->message([
                "ttl" => "Invalid Modal",
                "msg" => "Provided Modal name '{$modal_name}' is invalid or empty",
                "logs" => ["Modal name: {$modal_name}","Modal data: ".json_encode($data)],
                "type" => 'danger'
            ]);
        }
    }

    function load_page($url,$error=[]){
        $url_parts = explode('/',trim($url,'/'),3);
        if(!class_exists($url_parts[0])) {
            if(file_exists(CONTROLLERS_PATH . $url_parts[0] . '.php'))
                require CONTROLLERS_PATH . $url_parts[0] . ".php";
            else
                die("Controller {$url_parts[0]} not exists");
        }
        $controller = new $url_parts[0]();
        if(!empty($error))
            $controller->message($error);

        if(!empty($url_parts[1]))
            $action = $url_parts[1];
        else
            $action = "index";

        if(method_exists($controller,$action)) {
            if(!empty($url_parts[2]))
                $params = explode('/',$url_parts[2]);
            else
                $params = [];
            call_user_func_array(array($controller,$action),$params);
        }
        else
            die("Action {$action} in controller {$url_parts[0]} not exists");
        die;
    }

    function redirect($link){
        header("location:{$link}");
        echo @"<h1>Redirecting, Please wait...</h1>
                <h5><a href='{$link}'>Click Here</a> to proceed manually</h5>
                <script type='text/javascript'>
                    window.location.href= '{$link}';
                </script>";
        die;
    }

    function message($err){
        $this->message_array[] = [
            'ttl' => (empty($err['ttl'])) ? 'An Error Occurred' : $err['ttl'],
            'msg' => $err['msg'],
            'logs' => (empty($err['logs'])) ? [] : $err['logs'],
            'type' => (empty($err['type'])) ? 'info' : $err['type']
        ];
        if(ENVIRONMENT === 'development')
            error_log($err['msg'].'------>'.json_encode(debug_backtrace()));
    }

    function get_message_array($clear = true){
        if(count($this->message_array)>0) {
            $messages = $this->message_array;
            if($clear)
                $this->message_array = [];
            return $messages;
        }
        return false;
    }

    function url($src='', $type = '', $print=false){
        switch ($type){
            case 'img':
                $url = IMGS_URL.$src;
                break;
            default:
                $url = BASEURL.$src;
        }

        if($print)
            echo $url;
        else
            return $url;
    }
    
    function ulify($logs = array(), $classNames = ''){
        $content = (!empty($classNames)) ? "<ul class='{$classNames}'>" : "<ul>";
        if(isset($logs)){
            if(is_array($logs)){
                foreach ($logs as $key => $log){
                    if(!is_array($log) && !is_object($log)){
                        if(is_int($key))
                            $content .= '<li>'.$log.'</li>';
                        else
                            $content .= "<li>{$key} -> {$log}</li>";
                    }
                    else {
                        if(is_int($key))
                            $content .= '<li>' . $this->ulify($log) . '</li>';
                        else
                            $content .= "<li>{$key}" . $this->ulify($log) . '</li>';
                    }
                }

            }
        }
        $content .= '</ul>';
        return $content;
    }

    function throw_json($output,$stt=null,$forward=null){
        if(!is_array($output) || !is_object($output))
            $output = [ $output ];

        if($stt !== null)
            $output['status'] = $stt;

        header('Content-Type: application/json');
        echo json_encode($output);
        exit;
    }

    function set_global($key,$value){
        $this->GLOBAL[$key] = $value;
    }

    function get_global($key){
        return $this->GLOBAL[$key];
    }

    function check_global($key,$value){
        if(isset($this->GLOBAL[$key]))
            return ($this->GLOBAL[$key]===$value);
        return null;
    }

    function is_menu_active($controller = "", $print_class = ""){
        if(strcmp($controller,$_SERVER['route']['controller']) === 0)
            echo $print_class;
    }
}