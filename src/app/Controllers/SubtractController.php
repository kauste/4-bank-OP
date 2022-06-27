<?php
namespace Savers\Bank\Controllers;
use Savers\Bank\App;
use Savers\Bank\Messages;
use Savers\Bank\DB\JsonDB;
use Savers\Bank\Services\CurrencyService;

class SubtractController {
    // public function subtract(){
    //     return App::view('subtract', ['title'=> 'Subtract']);
    // }
    // public function subtractFrom($uri){
    //     $clients = App::$db -> showAll();
    //     foreach($clients as $client){
    //         if ($uri == $client['id']){
    //             return App::view('subtract', ['title'=> 'Subtract', 'client' => $client]);
    //        }
    //     }
    //     return App::view('home', ['title'=> 'home']);
    // }
    
    public function subtractNow($uri){
        $client = file_get_contents("php://input"); // cia vietoj $_POST
        $client = json_decode($client, 1);
        extract($client);
        // extract($_POST);
        // if(($_POST['csrf']?? '') != App::csrf()){
        //     Messages::add('Ne ten pataikei', 'error');
        //     return App::redirect('subtract/'.$uri);
        // }
        if ($amountWthdrow <= 0){
            $out = ['msg' => 'KLAIDA! Jūs mėginate nuskaičiuoti neigiamą sumą!'];
            $out = json_encode($out);
            echo($out);
            return;
            // Messages::add('Į skolą neduodame.', 'no-error');
            // return App::redirect('subtract/'.$uri);
        }
        // $clients = App::$db -> showAll();
        // $curr = CurrencyService::currencyGet();
        // $withdrowRound = ($amountWthdrow / $curr['currValue']);
        foreach((App::$db-> showAll()) as $user){
            if($user['id'] != $uri){
                continue;
            }
            if($user['suma'] < $amountWthdrow){
                $out = ['msg' => 'KLAIDA!Jūs mėginate nuskaičiuoti didesnę sumą nei yra kliento sąskaitoje!'];
                // Messages::add('KLAIDA!Jūs mėginate nuskaičiuoti didesnę sumą nei yra kliento sąskaitoje!'. $user['suma']. $withdrowRound , 'error');
            } else {
                $user['suma'] -= $amountWthdrow;
                App::$db -> update($uri, $user);
                $out = ['msg' => 'Pasirinkta suma nuskaičiuota nuo nurodytos sąskaitos.', 'user' =>  $user];
            }
        }
            // $out = ['msg', 'KLAIDA! Nurodyto kliento nėra sistemoje'];
            $out = json_encode($out);
            echo($out);
        // return App::redirect('subtract/'.$uri);
    }
}