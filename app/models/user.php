<?php
/**
 * Created by PhpStorm.
 * User: root
 * Date: 2/18/15
 * Time: 5:54 AM
 */

namespace models;

require_once(ROOT_DIR . '/app/libs/Model.php');
use libs\Model;
use libs\Users;

class UserModel extends Model {

    public function __construct(){
        parent::__construct('users');
    }

    public function view(){

    }

    public function add(){

     }

    public function getByField(){

    }

    public function update(){

    }
} 