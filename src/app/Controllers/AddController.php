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
        $clients = (new DataBaseController) -> showAll();
        if (array_key_exists($uri, $clients)){
             return App::view('add', ['title'=> 'Add', 'client' => $clients[$uri]]);
        }
        else{
            return App::view('home', ['title'=> 'home']);
        }
    }
    public function addNow($uri){
        extract($_POST);
        if(($_POST['csrf']?? '') != App::csrf()){
            Messages::add('Ne ten pataikei', 'error');
            return App::redirect('add/'.$uri);
        }
        if($amount > 0){
            (new DataBaseController) -> update($uri, [$amount]);
            Messages::add('Pasirinkta suma pridėta prie nurodytos sąskaitos.', 'no-error');
        } else {
            Messages::add('KLAIDA! Minusinė suma negali būti pridedama.', 'error');
        }
            return App::redirect('add/'.$uri);
    }
}