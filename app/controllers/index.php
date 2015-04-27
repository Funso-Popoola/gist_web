<?php
/**
 * Created by PhpStorm.
 * User: root
 * Date: 2/3/15
 * Time: 11:23 AM
 */

namespace controller;


require_once(ROOT_DIR . '/app/libs/Controller.php');
require_once(ROOT_DIR . '/app/libs/Utility.php');
use libs\Controller;
use models\EmergencyTypeModel;
use libs\Utility;

class IndexController extends Controller{

    public function __construct(){
        parent::__construct('index');
    }

    public function renderIndex(){
        $this->view->render('index');
    }

    public function view(){
        $this->renderIndex();
    }

} 