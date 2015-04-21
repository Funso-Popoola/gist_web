<?php
/**
 * Created by PhpStorm.
 * User: root
 * Date: 2/3/15
 * Time: 10:54 AM
 */

namespace libs;


class Utility {

    const FILE_NOT_FOUND = 404;
    const FORBIDDEN = 403;
    const SERVER_ERROR = 500;

    public static function returnJsonResponse($responseArr){
        return json_encode($responseArr);
    }

    public static function logActivity($fileName = null){
        // prepare the activity description
        $activity = "";

        $logFileName = ROOT_DIR . "/tmp/logs" . (($fileName == null) ? DEFAULT_ACTIVITY_LOG_FILE : $fileName);
        file_put_contents($logFileName, $activity, FILE_APPEND);
    }

    public static function getCurrentTime(){
        return date_format(time(), "");
    }

    public static function formatTime(){

    }

    public static function createAssocArray($keys, $values){
        $assocArray = array();
        if (!is_array($keys)) $keys = array($keys);

        if (!is_array($values)) $values = array($values);

        $i = 0;
        foreach ($keys as $key){
            $assocArray[$key] = $values[$i++];
        }
        return $assocArray;
    }

    public static function getPlaceHolders($query, $regEx){
        $matches = array();
        preg_match_all($regEx, $query, $matches);
        // the matches are returned as the first array in an array(array())
        return $matches[0];

    }

    public static function echoJsonResponse($response){
        echo(json_encode($response));
    }

    public static function abort($errorCode, $extraMessage = null){
        $message = "";
        switch($errorCode){
            case self::FILE_NOT_FOUND:
                $message = "File Not Found";
                break;
            case self::FORBIDDEN:
                $message = "This action is Forbidden. Get Permission";
                break;
            default:
                $message = "Weird Error";
        }
        $response = array('error' => $errorCode, 'detail' => $message);
        if ($extraMessage != null) $response['extra_details'] = $extraMessage;
        self::echoJsonResponse($response);
    }

    public static function getUrlFor($file = null){
        return "http://localhost/web/" . $file;
    }

    public static function getHrefFor($file){
        return "../../../" . APP_FOLDER . '/static/' . $file;
    }

} 