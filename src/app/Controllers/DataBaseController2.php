<?php namespace Savers\Bank\Controllers;
use Savers\Bank\DB\DataBase;
use Savers\Bank\AccountID;

class DataBaseController2 implements DataBase {
    private $data, $file;
    public function __construct ($file){
        $this -> file = $file;
        if(!file_exists(__DIR__.'/data/'.$file.'/json')){
            file_put_contents(__DIR__.'/data/'.$file.'.json', json_encode([]));
            file_put_contents(__DIR__.'/data/'.$file.'_id.json', 1);
        }
        $this-> data = json_decode(file_get_contents(__DIR__.'/data/'.$file.'.json'), 0);
    }
    public function __destructor (){
        file_put_contents(__DIR__.'/data/'.$this->file.'.json', json_encode($this-> data));
    }
    private function getId(){
        $id = (int) file_get_contents(__DIR__.'/data/'.$this -> file.'_id.json');
        $id++;
        file_put_contents(__DIR__.'/data/'.$this -> file.'_id.json', $id);
        return $id;

    }
    public function create(array $data) : void{
        $data['id'] = $this -> getId();
        $this -> data[]= $data;
    }
}