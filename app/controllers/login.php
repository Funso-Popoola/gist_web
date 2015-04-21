<?php
/**
 * Created by PhpStorm.
 * User: root
 * Date: 2/18/15
 * Time: 6:07 AM
 */

namespace controller;
require_once(ROOT_DIR . '/app/models/user.php');

use libs\Controller;
use libs\Utility;
use models\UserModel;

class LoginController extends Controller {

    public function __construct(){
        parent::__construct('login');
    }

    public function view(){
        $this->view->render('login');
    }

    public function verify(){
        if (isset($_POST["user_id"]) && isset($_POST["user_api_key"])){
            if (!isset($_SESSION)){
                session_start();
            }
            $_SESSION["user_id"] = $_POST["user_id"];
            $_SESSION["user_api_key"] = $_POST["user_api_key"];
            header("Location: " . Utility::getUrlFor());
        }
        else{
            $this->view();
        }
    }

    public function out(){
        if (!isset($_SESSION)){
            session_start();
        }
        session_destroy();
        header("Location: " . Utility::getUrlFor());
    }
} 