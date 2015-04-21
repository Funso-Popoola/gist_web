<?php
/**
 * Created by PhpStorm.
 * User: root
 * Date: 4/15/15
 * Time: 11:12 AM
 */

namespace controller;


use libs\Controller;

class AdminController extends Controller {

    public function __construct(){
        parent::__construct('admin_login');
    }

    public function index(){
        $this->view->render('admin_login');
    }

    public function login(){
        $this->view->render('admin_login');
    }

    public function home(){
        $this->view->render('admin_home');
    }
} 