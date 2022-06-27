<?php
namespace Savers\Bank\Services;

class Cache {

    private $time;
    private $valid = 30;

    public function __construct(){
        $this->time = time();
    }

    private function isValid($dataCacheTime){
        return $this->time - $dataCacheTime < $this->valid;
    }

    private function getCacheTime (){
        return $_SESSION['cache_time'] ?? null;
    }
    private function  write($data){
        $_SESSION['cache_data'] = $data; //galima ir i json
        $_SESSION['cache_time'] = $this->time;
    }

    private function read(){
        return $_SESSION['cache_data'] ?? null;
    }

    public function get(){
        $dataCachedOn = $this-> getCacheTime();
        if(!$this->isValid($dataCachedOn)){
            return null;
        }
        return $this->read();
    }
    public function set($data){
        $this->write($data);
    }
}