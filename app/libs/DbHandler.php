<?php
/**
 * Created by PhpStorm.
 * User: root
 * Date: 2/2/15
 * Time: 12:12 PM
 */

namespace libs;

require_once(ROOT_DIR . '/app/libs/Utility.php');

class DbHandler {

    private $conn;
    private $dsn;
    private $dbName;

    private $stmt;

    public function __construct(){
        // dsn --> Data Source Name
        $this->dsn = DB_ENGINE . ':host=' . DB_HOST . ';dbname=' . DB_NAME . ';charset=utf8';
        $this->connect($this->dsn, DB_USERNAME, DB_PASSWORD);
    }

    public function connect($dsn, $username, $password){
        try{
            // make connection to the data source
            $this->conn = new \PDO($dsn, $username, $password);

            // set the associated attributes
            $this->conn->setAttribute(\PDO::ATTR_ERRMODE, PDO_ERR_MODE);
        }
        catch(\PDOException $ex){
            echo($ex->getMessage());
            if (!DEVELOPMENT_ENV){
                Utility::logActivity('error.log');
            }

        }
    }

    public function query($query, $hasRecordResult, $tableNames = array(), $params = array(), $sqlParams = array()){

        //replace every tableName placeholders
        $query = $this->replaceTableName($query, $tableNames);
        // replace every placeholders present in the query
        $query = $this->replacePlaceHolders($query, $sqlParams);

//        echo($query);
        try{
            $this->stmt = $this->conn->prepare($query);
            $placeHolders = $this->getParams($query);
            $assocParamArray = Utility::createAssocArray($placeHolders, $params);
            $this->stmt->execute($assocParamArray);


            if (!$hasRecordResult) return true;
            return $this->stmt;
        }
        catch(\PDOException $ex){
            echo('PDO Exception: ' . $ex->getTraceAsString());
        }
        return false;
    }

    public function replacePlaceHolders($query, $sqlParams = array()){

        if ($sqlParams == null) return $query;

        if (!is_array($sqlParams))  $sqlParams = array($sqlParams);

        if (count($sqlParams) == 0){
            return $query;
        }

        $placeHolders = Utility::getPlaceHolders($query, "/[@][a-z|A-Z|_]*/");

        $i = 0;
        foreach ($placeHolders as $placeHolder){
            $query = str_replace($placeHolder, $sqlParams[$i++], $query);
        }

        return $query;
    }

    public function replaceTableName($query, $tableNames = array()){

        if ($tableNames == null) return $query;

        if (!is_array($tableNames))  $tableNames = array($tableNames);

        if (count($tableNames) == 0){
            return $query;
        }

        $tableNamePlaceHolder = Utility::getPlaceHolders($query, "/[#][a-z|A-Z|_]*/");

        $i = 0;
        foreach ($tableNamePlaceHolder as $placeHolder){
            $query = str_replace($placeHolder, $tableNames[$i++], $query);
        }

        return $query;

    }

    public function getParams($query, $params = array()){
        return Utility::getPlaceHolders($query, "/[:][a-z|A-Z|_]*/");
    }

    public function fetch($stmt, $isAssoc = true){
        try{
            $result = $stmt->fetch($isAssoc ? \PDO::FETCH_ASSOC : \PDO::FETCH_NUM);
            return $result;
        }
        catch (\PDOException $ex){
            echo("Error: " . $ex->getTraceAsString());
        }
    }

    public function fetchAll($stmt, $isAssoc = true){
        try{
            $result = $stmt->fetchAll($isAssoc ? \PDO::FETCH_ASSOC : \PDO::FETCH_NUM);
            return $result;
        }
        catch (\PDOException $ex){
            echo("Error: " . $ex->getTraceAsString());
        }
    }

    public function fetchObj($stmt, $isAssoc = true){

        try{
            $result = $stmt->fetchObject($isAssoc ? \PDO::FETCH_ASSOC : \PDO::FETCH_NUM);
            return $result;
        }
        catch (\PDOException $ex){
            echo("Error: " . $ex->getTraceAsString());
        }
    }

    public function getLastInsertId(){
        return $this->conn->lastInsertId();
    }

    public function disconnect(){
        $this->conn = null;
    }

    public function __destruct(){
        $this->disconnect();
    }

} 