<?php
/**
 * Created by PhpStorm.
 * User: root
 * Date: 4/15/15
 * Time: 11:08 AM
 */

namespace controller;


use libs\Controller;

class ChannelController extends Controller {

    public function __construct(){
        parent::__construct('channel');
    }

    public function view($channel_id){
        if (is_array($channel_id))
            $channel_id = $channel_id[0];
        $this->view->set("channel_id", $channel_id);
        $this->view->render('channel');
    }

    public function all(){
        $this->view->render('allChannels');
    }
} 