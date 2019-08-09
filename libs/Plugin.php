<?php

class Plugin {
    private $plugins;
    private $customJs;
    private $customCss;
    private $logs;
    function __construct($pluginList=[],$customJs=[],$customCss=[],$logs=[]) {
        $this->plugins = $pluginList;
        $this->customJs = $customJs;
        $this->customCss = $customCss;
        $this->logs = $logs;
    }

    public function loadCSS(){
        $type = 'css';
        foreach ($this->plugins as $key => $plugin){
            if(!is_array($plugin)) {
                if (file_exists(PLUGINS_PATH."{$plugin}".DS."{$plugin}.min.{$type}"))
                    echo '<link rel="stylesheet" type="text/css" href="'.PLUGINS_URL."{$plugin}/{$plugin}.min.{$type}".'">'.PHP_EOL;
                else if (file_exists(PLUGINS_PATH."{$plugin}".DS."{$plugin}.{$type}"))
                    echo '<link rel="stylesheet" type="text/css" href="'.PLUGINS_URL."{$plugin}/{$plugin}.{$type}".'">'.PHP_EOL;
                else
                    $this->addConsoleLog("Plugin file not exists -> ".PLUGINS_URL."{$plugin}/{$plugin}.{$type}");
            }else if(!is_int($key) && is_array($plugin)){
                if(isset($plugin[$type])) {
                    foreach ($plugin[$type] as $file) {
                        if (file_exists(PLUGINS_PATH."{$key}".DS."{$type}".DS."{$file}.min.{$type}"))
                            echo '<link rel="stylesheet" type="text/css" href="'.PLUGINS_URL."{$key}/{$type}/{$file}.min.{$type}".'">'.PHP_EOL;
                        else if (file_exists(PLUGINS_PATH."{$key}".DS."{$type}".DS."{$file}.{$type}"))
                            echo '<link rel="stylesheet" type="text/css" href="'.PLUGINS_URL."{$key}/{$type}/{$file}.{$type}".'">'.PHP_EOL;
                        else
                            $this->addConsoleLog("Plugin file not exists -> " .PLUGINS_URL."{$key}/{$type}/{$file}.{$type}");
                    }
                }
            }
        }

        if(!empty($this->customCss)){
            echo PHP_EOL.PHP_EOL.'<style type="text/css">'.PHP_EOL;
            foreach ($this->customCss as $css){
                echo $css.PHP_EOL;
            }
            echo PHP_EOL.'</style>'.PHP_EOL;
        }
    }

    public function loadJS(){
        $type = 'js';
        foreach ($this->plugins as $key => $plugin){
            if(!is_array($plugin)) {
                if (file_exists(PLUGINS_PATH."{$plugin}".DS."{$plugin}.min.{$type}"))
                    echo '<script type="text/javascript" src="'.PLUGINS_URL."{$plugin}/{$plugin}.min.{$type}".'"></script>'.PHP_EOL;
                else if (file_exists(PLUGINS_PATH."{$plugin}".DS."{$plugin}.{$type}"))
                    echo '<script type="text/javascript" src="'.PLUGINS_URL."{$plugin}/{$plugin}.{$type}".'"></script>'.PHP_EOL;
                else
                    $this->addConsoleLog("Plugin file not exists -> ".PLUGINS_URL."{$plugin}/{$plugin}.{$type}");
            }else if(!is_int($key) && is_array($plugin)){
                if(isset($plugin[$type])) {
                    foreach ($plugin[$type] as $file) {
                        if (file_exists(PLUGINS_PATH."{$key}".DS."{$type}".DS."{$file}.min.{$type}"))
                            echo '<script type="text/javascript" src="'.PLUGINS_URL."{$key}/{$type}/{$file}.min.{$type}".'"></script>'.PHP_EOL;
                        else if (file_exists(PLUGINS_PATH."{$key}".DS."{$type}".DS."{$file}.{$type}"))
                            echo '<script type="text/javascript" src="'.PLUGINS_URL."{$key}/{$type}/{$file}.{$type}".'"></script>'.PHP_EOL;
                        else
                            $this->addConsoleLog("Plugin file not exists -> " .PLUGINS_URL."{$key}/{$type}/{$file}.{$type}");
                    }
                }
            }
        }

        if(!empty($this->customJs)){
            echo PHP_EOL.PHP_EOL.'<script type="text/javascript">'.PHP_EOL;
            foreach ($this->customJs as $js){
                echo $js.PHP_EOL;
            }
            echo PHP_EOL.'</script>'.PHP_EOL;
        }
        $this->loadConsoleLogs();
    }

    public function setPlugins($list){
        if(is_array($list)) {
            $this->plugins = $list;
            return true;
        }
        return false;
    }

    public function add($plugin){
        if(!is_array($plugin))
            $plugin = array($plugin);
        if($this->plugins = array_merge($this->plugins,$plugin))
            return true;
        return false;
    }

    public function addCustomJs($js){
        $this->customJs[count($this->customJs)] = $js;
        return $this->customJs;
    }

    public function addCustomCss($css){
        $this->customCss[count($this->customCss)] = $css;
        return $this->customCss;
    }

    public function getCustomCss(){
        return $this->customCss;
    }

    public function getCustomJs(){
        return $this->customJs;
    }

    public function getPlugins(){
        return $this->plugins;
    }

    public function addConsoleLog($var){
        array_push($this->logs,$var);
        return $this->logs;
    }

    public function loadConsoleLogs(){
        if(count($this->logs) !== 0){
            echo PHP_EOL.PHP_EOL.'<script type="text/javascript">'.PHP_EOL;
            foreach($this->logs as $log){
                echo 'console.error(`';
                var_dump($log);
                echo '`)'.PHP_EOL;
            }
            echo PHP_EOL.'</script>'.PHP_EOL;
        }
    }
}