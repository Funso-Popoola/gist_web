<?php
/**
 * Created by PhpStorm.
 * User: root
 * Date: 2/19/15
 * Time: 11:23 AM
 */

namespace models;

require_once(ROOT_DIR . '/app/libs/Model.php');

use libs\Messages;
use libs\Model;

class MessageModel extends Model {

    public function add($title, $sender_name, $sender_phone_num, $sender_email, $body){
        $params = array($title, $sender_name, $sender_phone_num, $sender_email, $body);
        return $this->noResultQuery(Messages::CREATE, $params);
    }


} 