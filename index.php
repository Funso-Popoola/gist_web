<?php
/**
 * Created by PhpStorm.
 * User: root
 * Date: 2/17/15
 * Time: 12:59 PM
 *
 * This is where all requests lands.
 */

if (!isset($_SESSION)){
    session_start();
}

//grab the root directory
define('ROOT_DIR', dirname(__FILE__));
define('APP_FOLDER', "web/app");

//include the config file and Initialization class
require_once(ROOT_DIR . '/app/config/config.php');
require_once(ROOT_DIR . '/app/libs/Init.php');


use libs\Init;
$init = new Init();
$init->processRequest();