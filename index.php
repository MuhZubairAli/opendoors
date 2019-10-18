<?php

// MAIN SCRIPT 
define('BASEPATH',getcwd());
define('DS', '\\');
define('BASEURL','/');
define('CONTROLLERS_PATH',BASEPATH.DS.'controllers'.DS);
define('LIBS_PATH', BASEPATH.DS.'libs'.DS);
define('MODALS_PATH', BASEPATH.DS.'modals'.DS);
define('VIEWS_PATH', BASEPATH.DS.'views'.DS);
define('ASSETS_PATH', BASEPATH.DS.'assets'.DS);
define('PLUGINS_PATH', ASSETS_PATH.'plugins'.DS);
define('IMGS_PATH', ASSETS_PATH.'imgs'.DS);
define('ASSETS_URL', BASEURL.'assets/');
define('PLUGINS_URL',ASSETS_URL.'plugins/');
define('IMGS_URL', ASSETS_URL.'imgs/');

//Setup timezone
/*
 * date_default_timezone_set("Asia/Karachi");
*/

define('ENVIRONMENT', 'development');
switch (ENVIRONMENT)
{
	case 'development':
		error_reporting(-1);
		ini_set('display_errors', 1);
	break;

	case 'testing':
	case 'production':
		ini_set('display_errors', 0);
		if (version_compare(PHP_VERSION, '5.3', '>=')) {
			error_reporting(E_ALL & ~E_NOTICE & ~E_DEPRECATED & ~E_STRICT & ~E_USER_NOTICE & ~E_USER_DEPRECATED);
		}
		else {
			error_reporting(E_ALL & ~E_NOTICE & ~E_STRICT & ~E_USER_NOTICE);
		}
	break;

	default:
		header('HTTP/1.1 503 Service Unavailable.', TRUE, 503);
		echo 'The application environment is not set correctly.';
		exit(1); // EXIT_ERROR
}

$url_map = trim(key($_GET),'/');
$url_parts = explode('/',$url_map,3);
$_SERVER['route'] = array();
$_SERVER['route']['href'] = $url_map;
$keys = ['controller', 'action', 'query_string'];
$index = 0;
foreach($url_parts as $url_part){
	if(strlen($url_part) > 0){
		$_SERVER['route'][$keys[$index++]] = ($index < 3) ? str_replace([ '-','+' ],'_',$url_part) : $url_part;
	}
}

//Set up default controller and action
$_SERVER['route']['controller'] = empty($_SERVER['route']['controller']) ? 'home' : $_SERVER['route']['controller'];
$_SERVER['route']['action']     = empty($_SERVER['route']['action']) ? 'index' : $_SERVER['route']['action'];

//Executing Route
$controller = $_SERVER['route']['controller'];
$action = $_SERVER['route']['action'];

require(LIBS_PATH."Controller.php");

if(file_exists(CONTROLLERS_PATH.$controller.'.php'))
	require(CONTROLLERS_PATH.$controller.'.php');
else 
	die("Controller '{$controller}' doesn't exist");

$controllerObj = new $controller;
if(method_exists($controllerObj,$action)) {
    if(isset($_SERVER['route']['query_string']))
        $params = explode('/',trim($_SERVER['route']['query_string'],'/'));
    else
        $params = [];
    $result = call_user_func_array(array($controllerObj,$action),$params);
    if(!empty($result)) {
        if(is_array($result) || is_object($result))
            $controllerObj->throw_json($result);
        else
            echo $result;
    }else if($msg = $controllerObj->get_message_array()) {

        $controllerObj->throw_json($msg);
    }
}
else 
	die("Action '{$action}' doesn't exist");