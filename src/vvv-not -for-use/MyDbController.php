<?php
namespace Savers\Bank\Controllers;
use Savers\Bank\App;
use Savers\Bank\DB\DataBase;
use Savers\Bank\AccountID;

class DataBaseController implements DataBase {
    
    public function create(array $client) : void{
        if(!file_exists(App::CLIENTS)){
            file_put_contents(App::CLIENTS, json_encode([]));
        }
        $client['suma'] = 0;
        $id = AccountID::plusID();
        $clients = $this -> showAll();
        $clients[$id] = $client;
        file_put_contents(App::CLIENTS, json_encode($clients));      
    }

    public function update(int $userId, array $userData) : void {
         $clients = $this -> showAll();
         $clients[$userId]['suma'] += $userData[0];
         file_put_contents(App::CLIENTS, json_encode($clients));
    }
    public function delete(int $userId) : void {
        $clients = $this -> showAll();
        unset($clients[$userId]);
        file_put_contents(App::CLIENTS, json_encode($clients));
    }
    public function show(int $userId) : array{
        $clients = $this -> showAll();
        $client = $clients[$userId];
        return $client;
    }
    public function showAll() : array{
        return json_decode (file_get_contents(App::CLIENTS), 1);
    }
}