<?php
/**
 * Created by PhpStorm.
 * User: root
 * Date: 2/2/15
 * Time: 11:55 AM
 */

namespace libs;


class View {

    private $name;
    private $variables = array();


    public function __construct($name){
        $this->$name = $name;
    }

    public function set($key, $value){
        $this->variables[$key] = $value;
    }

    public function render($name){

        $GLOBALS[$name] = $this->variables;
        $extra = '';
        if ($name == 'dashboard' || $name == 'map_view' || $name == 'institutes' || $name == 'requests' || $name == 'circles' || $name == 'notifications')
            $extra = '_admin';
        if ($name == 'tips')
            $extra = '_tips';
        require_once(ROOT_DIR . '/app/views/header' . $extra . '.php');
        require_once(ROOT_DIR . '/app/views/' . $name . '.php');
        require_once(ROOT_DIR . '/app/views/footer'. $extra .'.php');
    }
} 