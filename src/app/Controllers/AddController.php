<?php
namespace Savers\Bank\Controllers;
use Savers\Bank\App;
use Savers\Bank\Messages;
use Savers\Bank\Controllers\DataBaseController;

class AddController {
    public function add(){
        return App::view('add', ['title'=> 'Add']);
    }
    public function addTo($uri){
        $clients = App::$db -> showAll();
        foreach($clients as $client){
            if ($uri == $client['id']){
                return App::view('add', ['title'=> 'Add', 'client' => $client]);
           }
        }
        return App::view('home', ['title'=> 'home']);
    }

    public function addNow($uri){
        extract($_POST);
        if(($_POST['csrf']?? '') != App::csrf()){
            Messages::add('Ne ten pataikei', 'error');
            return App::redirect('add/'.$uri);
        }
        if($amount > 0){
            foreach((App::$db-> showAll()) as $user){
                if($user['id'] == $uri){
                    $user['suma'] += $amount;
                    App::$db -> update($uri, $user);
                    Messages::add('Pasirinkta suma pridėta prie nurodytos sąskaitos.', 'no-error');
                    return App::redirect('add/'.$uri);
                }
            }
            Messages::add('Vartotojas neegzistuoj.', 'no-error');
        } else {
            Messages::add('KLAIDA! Minusinė suma negali būti pridedama.', 'error');
        }
            return App::redirect('add/'.$uri);
           
    }
}