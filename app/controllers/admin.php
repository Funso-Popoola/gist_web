<?php
/**
 * Created by PhpStorm.
 * User: root
 * Date: 4/15/15
 * Time: 11:12 AM
 */

namespace controller;


use libs\Controller;
use libs\Utility;

class AdminController extends Controller {

    public function __construct(){
        parent::__construct('admin_login');
    }

    public function view(){
        if (!isset($_SESSION)){
            session_start();
        }
        if (!isset($_SESSION['user_api_key']) || !isset($_SESSION['user_id'])){
            header("Location: " . Utility::getUrlFor('login'));
            return;
        }
        if (!isset($_SESSION['channel_id'])){
            header("Location: " . Utility::getUrlFor('admin/login'));
            return;
        }
        $this->view->render('admin_home');
    }

    public function index(){
        $this->view();
    }

    public function login(){
        if (!isset($_SESSION)){
            session_start();
        }
        // ensure the user is logged in
        if (!isset($_SESSION['user_api_key']) || !isset($_SESSION['user_id'])){
            header("Location: " . Utility::getUrlFor('login'));
            return;
        }
        $this->view->render('admin_login');
    }

    public function register(){
        if (!isset($_SESSION)){
            session_start();
        }
        // ensure the user is logged in
        if (!isset($_SESSION['user_api_key']) || !isset($_SESSION['user_id'])){
            header("Location: " . Utility::getUrlFor('login'));
            return;
        }
        $this->view->render('admin_register');
    }

    public function verify(){
        // ensure that the user is logged in
        if (!isset($_SESSION['user_api_key']) || !isset($_SESSION['user_id'])){
            header("Location: " . Utility::getUrlFor('login'));
            return;
        }
        if (isset($_POST["channel_id"])){
            if (!isset($_SESSION)){
                session_start();
            }
            $_SESSION["channel_id"] = $_POST["channel_id"];
            header("Location: " . Utility::getUrlFor('admin/home'));
        }
        else{
            $this->view();
        }
    }

    public function home(){
        if (!isset($_SESSION)){
            session_start();
        }
        // ensure that the user is logged in
        if (!isset($_SESSION['user_api_key']) || !isset($_SESSION['user_id'])){
            header("Location: " . Utility::getUrlFor('login'));
            return;
        }
        // ensure that the channel is logged in
        if (!isset($_SESSION['channel_id'])){
            header("Location: " . Utility::getUrlFor('admin/login'));
            return;
        }
        $this->view->render('admin_home');
    }

}