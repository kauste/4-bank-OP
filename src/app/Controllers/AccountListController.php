<?php
namespace Savers\Bank\Controllers;
use Savers\Bank\App;
use Savers\Bank\Messages;
use Savers\Bank\DB\JsonDB;
use Savers\Bank\Services\CurrencyService;
class AccountListController {
    
    public function list(){
        if(file_exists(App::CLIENTS)){
            $list = App::$db -> showAll();
        } else {
            $list = [[]];
             // per if patikrinti, ar yra saskaitu views'e
        }
        $list = json_encode($list); //REACT
        echo $list; //REACT
        // return App::view('accountList', ['title'=> 'Account List', 'list' => $list ]); //PHP
    }
    public function deleteItem(int $id){
        // if(($_POST['csrf']?? '') != App::csrf()){
        //     Messages::add('Ne ten pataikei', 'error');
        //     return App::redirect('list');
        // }
        $list = App::$db -> showAll();
        foreach ($list as $person){
            if ($person['id'] == $id){
                $chosenPerson = $person;
                break;
            }
        }
        if($chosenPerson['suma'] == 0){
            App::$db -> delete($id);
            array_values(App:$db);
            // Messages::add('Sąskaita ištrinta', 'no-error');
            $out = ['msg' => 'Sąskaita ištrinta'];
            echo $out;
        }
        else {
            $out = ['msg' => 'Sąskaitoje yra pinigų, todėl ji negai būti ištrinta'];
            echo $out;
            // Messages::add('KLAIDA! Kliento '.$chosenPerson['vardas'].' '.$chosenPerson['pavarde'].' sąskaitoje yra '.$chosenPerson['suma'].' eur., todėl jo sąskaita negali būti ištrinta', 'error');
        }
        // return App::redirect('list');
    }  
    public function listCurr(){
        CurrencyService::currencyPost();
        return App::redirect('list');
    }
}