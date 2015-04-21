<?php
/**
 * Created by PhpStorm.
 * User: root
 * Date: 2/2/15
 * Time: 12:12 PM
 */

namespace libs;


class Entity{

    private $tableName;
    private $fields;
    private $fieldValues;

    public function __construct($tableName, $fields){
        $this->tableName = $tableName;
        $this->fields = $fields;
    }

    public function getTableName(){
        return $this->tableName;
    }

    public function getFields(){
        return $this->fields;
    }

    public function serialize(){

    }

    public function toArray(){
        $arr = array();
        for ($i = count($this->fields); $i >= 0; $i--){
            $arr[$this->fields[$i]] = $this->fieldValues[$i];
        }

    }



} 