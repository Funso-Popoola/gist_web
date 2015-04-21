<?php
/**
 * Created by PhpStorm.
 * User: root
 * Date: 2/2/15
 * Time: 12:11 PM
 */

namespace libs;

require_once('HttpRequestHandler.php');
require_once(ROOT_DIR . '/app/controllers/error.php');

use controller\ErrorController;

class Init {

    public function __construct(){
        $this->setErrorReporting();
        //$this->unsetGlobals();
    }

    public function processRequest(){
        $url = "";
        if (isset($_GET['url'])) $url = $_GET['url'];
        // create a request object and make it the current one
        $GLOBALS['currentRequest'] = new Request($url);
        $httpRequestHandler = new HttpRequestHandler($GLOBALS['currentRequest']);
        $httpRequestHandler->extractRequestComponents();
    }

    public function setErrorReporting(){
        error_reporting(E_ALL);
        // In development process, display errors
        if (DEVELOPMENT_ENV) {
            ini_set('display_error', 'On');
        }
        // In production, log errors rather than display them
        else{
            ini_set('display_error', 'Off');
            ini_set('log_error', 'On');
            ini_set('error_log', ROOT_DIR . '/tmp/logs/error.log');
        }
    }

    public function unsetGlobals(){
        if (ini_get('register_globals')){
            $global_arr = array('_SESSION', '_GET', '_POST', '_COOKIE', '_REQUEST');
            foreach($global_arr as $value){
                foreach($GLOBALS[$value] as $key => $val){
                    if ($val === $GLOBALS[$key]) {
                        unset($GLOBALS[$key]);
                    }
                }
            }
        }
    }


    public function __autoload($class){

    }

    public function initError($errorMessage, $errorCode=null){
        $error = new ErrorController($errorMessage);
        $error->renderError($errorCode);
    }

} 