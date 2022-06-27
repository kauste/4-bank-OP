<?php
namespace Savers\Bank\Controllers;
use Savers\Bank\App;
use Savers\Bank\Messages;
use Savers\Bank\DB\JsonDB;
use Savers\Bank\Services\CurrencyService;

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
        $client = file_get_contents("php://input"); // cia vietoj $_POST
        $client = json_decode($client, 1);
        extract($client);
        // extract($_POST);
        // if(($_POST['csrf']?? '') != App::csrf()){
        //     Messages::add('Ne ten pataikei', 'error');
        //     return App::redirect('add/'.$uri);
        // }
        if($amount > 0){
            foreach((App::$db-> showAll()) as $user){
                if($user['id'] == $uri){
                    // $curr = CurrencyService::currencyGet();
                    $user['suma'] += $amount;//  / $curr['currValue']
                    App::$db -> update($uri, $user);
                    $out = ['msg' => 'Pasirinkta suma pridėta prie nurodytos sąskaitos', 'user' =>  $user];
                    // Messages::add('Pasirinkta suma pridėta prie nurodytos sąskaitos.', 'no-error');
                    // return App::redirect('add/'.$uri);
                }
            }
            // $out = ['msg' => 'KLAIDA'];
            // Messages::add('Vartotojas neegzistuoj.', 'error');
        } else {
            $out = ['msg' => 'KLAIDA! Minusinė suma negali būti pridedama.'];
            // Messages::add('KLAIDA! Minusinė suma negali būti pridedama.', 'error');
        }
            // return App::redirect('add/'.$uri);
            $out = json_encode($out);
            echo $out;
           
    }
}