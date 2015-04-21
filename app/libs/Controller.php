<?php
/**
 * Created by PhpStorm.
 * User: root
 * Date: 2/2/15
 * Time: 12:10 PM
 */

namespace libs;

require_once(ROOT_DIR . '/app/libs/View.php');

class Controller {

    // every controller has a view to render
    protected $view;
    protected $model;

    public function __construct($viewName){
        // instantiate the view
        $this->view = new View($viewName);
    }

} 