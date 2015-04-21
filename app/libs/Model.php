<?php
/**
 * Created by PhpStorm.
 * User: root
 * Date: 2/2/15
 * Time: 12:11 PM
 */

namespace libs;

require_once(ROOT_DIR . '/app/libs/Query.php');
require_once(ROOT_DIR . '/app/libs/DbHandler.php');

class Model {

    private $tableName;
    private $dbHandler;

    public function __construct($tableName){
        $this->tableName = $tableName;
        $this->dbHandler = new DbHandler();
    }

    public function getAll(){
        $stmt = $this->dbHandler->query(Query::SELECT_ALL, true, $this->tableName);
        return $this->dbHandler->fetchAll($stmt);
    }

    public function getByCondition($condition){
        $stmt = $this->dbHandler->query(Query::CONDITIONAL_SELECT_ALL, true, $this->tableName, array(), $condition);
        return $this->dbHandler->fetchAll($stmt);
    }

    public function getFieldsByCondition($fields, $condition){
        $stmt = $this->dbHandler->query(Query::CONDITIONAL_SELECT_FIELDS, true, $this->tableName, array(), array($fields, $condition));
        return $this->dbHandler->fetchAll($stmt);
    }

    public function getFieldsForAll($fields){
        $stmt = $this->dbHandler->query(Query::SELECT_FIELDS, true, $this->tableName, array(), $fields);
        return $this->dbHandler->fetchAll($stmt);
    }

    public function updateFieldByCondition($field, $value, $condition){
        $this->dbHandler->query(Query::UPDATE, false, array($this->tableName), array($value), array($field, $condition));
        $this->updateTimeFieldByCondition('modified_at', $condition);

    }

    public function updateTimeFieldByCondition($field, $condition){
        $this->dbHandler->query(Query::UPDATE, false, array($this->tableName), array(), array($field, $condition));
    }

    public function noResultQuery($query, $params){
        return $this->dbHandler->query($query, false, array(), $params);
    }

    /**
     * @return \libs\DbHandler
     */
    public function getDbHandler()
    {
        return $this->dbHandler;
    }

    /**
     * @return mixed
     */
    public function getTableName()
    {
        return $this->tableName;
    }


} 