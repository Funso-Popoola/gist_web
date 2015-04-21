<?php
/**
 * Created by PhpStorm.
 * User: root
 * Date: 2/3/15
 * Time: 12:31 PM
 */

namespace controller;

require_once(ROOT_DIR . '/app/libs/Controller.php');
require_once(ROOT_DIR . '/app/libs/Utility.php');
use libs\Controller;
use libs\Utility;

class ErrorController extends Controller{

    private $errorMessages;

    public function __construct($errorMessages){
        parent::__construct('error');
        $this->errorMessages = $errorMessages;
    }

    public function renderError($errorCode=null){
        $errorCode = ($errorCode == null) ? "" : $errorCode;
        $this->view->set('error', $this->errorMessages);
        $this->view->render('error' . $errorCode);
    }

} 