<?php
/**
 * Created by PhpStorm.
 * User: root
 * Date: 2/18/15
 * Time: 6:05 AM
 */

namespace controller;

require_once(ROOT_DIR . '/app/controllers/login.php');

use libs\Controller;

class UserController extends Controller {

    public function __construct(){
        parent::__construct('user');
    }

    public function register(){
        if (isset($_POST['user_id']) && isset($_POST['user_api_key'])){
            $loginController = new LoginController();
            $loginController->verify();
            return;
        }
        $this->view->render('user_register');
    }
} 