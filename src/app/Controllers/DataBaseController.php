<?php namespace Savers\Bank\Controllers;
use Savers\Bank\DB\DataBase;
use Savers\Bank\AccountID;

class DataBaseController implements DataBase {
    private $data, $file;
    public function __construct ($file){
        $this -> file = $file;
        if(!file_exists(__DIR__.'/../../data/'.$file.'.json')){
            file_put_contents(__DIR__.'/../../data/'.$file.'.json', json_encode([]));
            file_put_contents(__DIR__.'/../../data/'.$file.'_id.json', 0);
        }
        $this-> data = json_decode(file_get_contents(__DIR__.'/../../data/'.$file.'.json'), 1);
    }
    public function __destruct (){
        file_put_contents(__DIR__.'/../../data/'.$this -> file.'.json', json_encode($this -> data));
    }
    private function getId(){
        $id = (int) file_get_contents(__DIR__.'/../../data/'.$this -> file.'_id.json');
        $id++;
        file_put_contents(__DIR__.'/../../data/'.$this -> file.'_id.json', $id);
        return $id;
    }
    public function create(array $data) : void{
        $data['id'] = $this -> getId();
        $this -> data[] = $data;
    }
    public function showAll() : array{
        return $this->data;
    }
    public function show(int $id) : array{
        foreach($this -> data as $item){
            if($item['id'] == $id){
                return $item;
            }
        }
        return [];
    }
    public function delete(int $userId) : void {
        foreach($this -> data as $key=> $item){
            if($item['id'] == $id){
                unset($this->data[$key]);
                break;
            }
        }
    }
    function update(int $id, array $data) : void{
        foreach($this -> data as $key=> $item){
            if($item['id'] == $id){
                $this->data[$key] = $data;
                break;
            }
        }
    }
}