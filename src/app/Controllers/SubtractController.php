<?php
namespace Savers\Bank\Controllers;
use Savers\Bank\App;
use Savers\Bank\Messages;
use Savers\Bank\Controllers\DataBaseController;

class SubtractController {
    public function subtract(){
        return App::view('subtract', ['title'=> 'Subtract']);
    }
    public function subtractFrom($uri){
        $clients = App::$db -> showAll();
        foreach($clients as $client){
            if ($uri == $client['id']){
                return App::view('subtract', ['title'=> 'Subtract', 'client' => $client]);
           }
        }
        return App::view('home', ['title'=> 'home']);
    }
    
    public function subtractNow($uri){
        extract($_POST);
        if(($_POST['csrf']?? '') != App::csrf()){
            Messages::add('Ne ten pataikei', 'error');
            return App::redirect('subtract/'.$uri);
        }
        if ($amount < 0){
            Messages::add('Į skolą neduodame.', 'no-error');
            return App::redirect('subtract/'.$uri);
        }
        $clients = App::$db -> showAll();
        foreach((App::$db-> showAll()) as $user){
            if($user['id'] != $uri){
                continue;
            }
            if($user['suma'] <= $amount){
                Messages::add('KLAIDA!Jūs mėginate nuskaičiuoti didesnę sumą nei yra kliento sąskaitoje!', 'no-error');
                break;
            }
            $user['suma'] -= $amount;
            App::$db -> update($uri, $user);
            Messages::add('Pasirinkta suma nuskaičiuota nuo nurodytos sąskaitos.', 'no-error');
            }
        return App::redirect('subtract/'.$uri);
    }
}