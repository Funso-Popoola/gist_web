<?php
/**
 * Created by PhpStorm.
 * User: root
 * Date: 2/21/15
 * Time: 10:28 PM
 */

namespace libs;


class Request {

    protected $urlArr;
    protected $currIndex;

    public function __construct($url){
        $this->urlArr = array($url);
        $this->currIndex = 0;
    }

    public function getNextUrl(){
        if (count($this->urlArr) > $this->currIndex + 1)
            return $this->urlArr[++$this->currIndex];
        else
            return false;
    }

    public function getCurrUrl(){
        return $this->urlArr[$this->currIndex];
    }

    public function setCurrUrl($newUrl){
        $this->urlArr[$this->currIndex] = $newUrl;
    }

    public function pushUrl($url){
        $this->urlArr = array_merge(array($url), $this->urlArr);
    }

    public function popUrl(){

    }
} 