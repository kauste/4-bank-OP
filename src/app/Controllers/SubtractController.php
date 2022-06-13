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
        $clients = (new DataBaseController) -> showAll();
        if(array_key_exists($uri, $clients)){
            $client = $clients[$uri];
            return App::view('subtract', ['title'=> 'Subtract', 'client' => $client]);
        }
        else {
            return App::view('home', ['title'=> 'Home']);
        }
    }
    public function subtractNow($uri){
        extract($_POST);
        if(($_POST['csrf']?? '') != App::csrf()){
            Messages::add('Ne ten pataikei', 'error');
            return App::redirect('subtract/'.$uri);
        }
        $clients = (new DataBaseController) -> showAll();
        if ($clients[$uri]['suma'] >= $amount && $amount > 0){
            (new DataBaseController) -> update($uri, [-$amount]);
            Messages::add('Pasirinkta suma nuskaičiuota nuo nurodytos sąskaitos.'. $amount, 'no-error');
        } elseif ($amount < 0){
            Messages::add('Į skolą neduodame.', 'no-error');
        } else {
            Messages::add('KLAIDA!Jūs mėginate nuskaičiuoti didesnę sumą nei yra kliento sąskaitoje!', 'no-error');
        }
        return App::redirect('subtract/'.$uri);
    }
}