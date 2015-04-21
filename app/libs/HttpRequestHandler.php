<?php
/**
 * Created by PhpStorm.
 * User: root
 * Date: 2/3/15
 * Time: 10:37 AM
 */

namespace libs;

require_once(ROOT_DIR . '/app/libs/Request.php');
use controller;

class HttpRequestHandler {

    private $request;

    public function __construct($request){
        $this->request = $request;
    }

    public function sanitizeUrl(){
        //remove all trailing slashes
        $this->request->setCurrUrl(rtrim($this->request->getCurrUrl(), '/'));

    }

    public function extractRequestComponents(){
        $this->sanitizeUrl();
        $urlArr = explode('/', $this->request->getCurrUrl());

        // the url format: app_name.com/items/view/1/first-item
        // controller ===> items; controller class ===> ItemController
        // model ========> item; model class ===> ItemModel
        // action =======> view;
        // query string => [1, first-item]

        // in case the url has no request component, redirect to home page
        if (empty($urlArr[0])){
            require_once(ROOT_DIR . '/app/controllers/index.php');
            $index = new controller\IndexController();
            $index->renderIndex();
            return;
        }
        if ($urlArr[0] == 'error'){
            require_once(ROOT_DIR . '/app/controllers/error.php');
            $error = new controller\ErrorController('');
            $error->renderError();
            return;
        }

        // check if the controller file exists
        $controllerFile = ROOT_DIR . '/app/controllers/' . rtrim($urlArr[0], 's') . '.php';
        if (!file_exists($controllerFile)){
            $init = new Init();
            $init->initError('File not found', '404');
            return;
        }

        require_once(ROOT_DIR . '/app/controllers/' . rtrim($urlArr[0], 's') . '.php');


        $query = null;
        $action = 'view';
        $controller = 'Index';
        // if there exist an action and query
        if (count($urlArr) >= 3){
            $query = array_slice($urlArr, 2);
            $urlArr = array_slice($urlArr, 0, 2);
        }
        if (count($urlArr) == 2){
            $action = $urlArr[1];
            $urlArr = array_slice($urlArr, 0, 1);
        }
        if (count($urlArr) == 1){
            $controller = ucwords(rtrim($urlArr[0], 's'));
        }

        $model = $controller . 'Model';
        $controller = 'controller\\' . $controller . 'Controller';

        $controller = new $controller();


        if (method_exists($controller, $action)){
            $controller->$action($query);
        }
        else{
            $init = new Init();
            $init->initError('Invalid Request', '404');
            return;
        }

    }


} 