<?php
class Main extends Controller {
    function __construct()
    {
        parent::__construct();
        $this->plugin->add([
            'jquery' => [
                'js' => [ 'jquery' ]
            ],
            'bootstrap' => [
                'css' => [ 'bootstrap' ],
                'js'  => [ 'bootstrap' ]
            ],
            'font-awesome' => [
                'css' => [ 'font-awesome' ]
            ],
            'effects' => [
                'css' => [ 'animate' ],
                'js' => [
                    'hoverIntent',
                    'superfish.min',
                    'sticky',
                    // 'morphext',
                    'wow',
                    'easing'
                ]
            ],
            'theme' => [
                'css' => [ 'style' ],
                'js'  => [ 'init' ]
            ]
        ]);
        
        $this->load_lib('db');
    }
}