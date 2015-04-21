<?php
/**
 * Created by PhpStorm.
 * User: root
 * Date: 2/23/15
 * Time: 8:15 AM
 */

namespace controller;


use libs\Controller;

class HelpController extends Controller {

    public function __construct(){
        parent::__construct('help');
    }

    public function view(){
        $this->view->render('help');
    }
} 