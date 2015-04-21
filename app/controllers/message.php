<?php
/**
 * Created by PhpStorm.
 * User: root
 * Date: 2/18/15
 * Time: 5:31 AM
 */

namespace controller;

require_once(ROOT_DIR . '/app/models/message.php');
require_once(ROOT_DIR . '/app/libs/Init.php');

use libs\Controller;
use models\MessageModel;
use libs\Init;

class MessageController extends Controller {

    public function __construct(){
        parent::__construct('contact_us');
    }

    public function view(){
        $this->view->render('contact_us');
    }

    public function add(){
        if (isset($_POST['body'])){
            var_dump($_POST);
            $title = $_POST['title'];
            $name = $_POST['name'];
            $phone_num = $_POST['phone_num'];
            $body = $_POST['body'];
            $sender_email = $_POST['sender_email'];

            $this->model = new MessageModel('messages');
            $this->model->add($title, $name, $phone_num, $sender_email, $body);

            header("Location: http://localhost/web/");
        }
        else{
            $init = new Init();
            $init->initError('Empty form', 'Submit');
            return;
        }
    }
} 