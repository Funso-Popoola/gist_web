<?php
/**
 * Created by PhpStorm.
 * User: root
 * Date: 4/15/15
 * Time: 3:33 PM
 */

namespace controller;


use libs\Controller;

class CategoryController extends Controller {

    public function __construct(){
        parent::__construct('category');
    }

    public function view($category_id = 1){

        if (is_array($category_id))
            $category_id = $category_id[0];

        $this->view->set("category_id", $category_id);
        $this->view->render('category');
    }

}