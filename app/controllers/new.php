<?php
/**
 * Created by PhpStorm.
 * User: root
 * Date: 4/15/15
 * Time: 1:15 PM
 */

namespace controller;


use libs\Controller;

class NewController extends Controller {

    public function __construct(){
        parent::__construct('news');
    }

    public function view($news_id){
        if (is_array($news_id))
            $news_id = $news_id[0];
        $this->view->set("news_id", $news_id);
        $this->view->render('news');
    }

} 