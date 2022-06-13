<?php
namespace Savers\Bank;
use Savers\Bank\App;

class AccountID {
    public static function plusID (){
        if(!file_exists(App::ID)){
            file_put_contents(App::ID, json_encode([1]));
        }
        $id = json_decode(file_get_contents(App::ID));
        $id[0] += 1;
        file_put_contents(App::ID, json_encode($id));
        return $id[0];
    }
}