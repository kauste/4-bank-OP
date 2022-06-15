<?php
namespace Savers\Bank\Controllers;
use Savers\Bank\App;
use Savers\Bank\Messages;
use Savers\Bank\Controllers\DataBaseController;
class AccountListController {
    public function list(){
        if(file_exists(App::CLIENTS)){
            $list = (new DataBaseController('clients')) -> showAll();
        } else {
            $list = [[]];
             // per if patikrinti, ar yra saskaitu views'e
        }
        return App::view('accountList', ['title'=> 'Account List', 'list' => $list ]);
    }
    public function deleteItem(int $id){
        if(($_POST['csrf']?? '') != App::csrf()){
            Messages::add('Ne ten pataikei', 'error');
            return App::redirect('list');
        }
        $list = App::$db -> showAll();
        if($list[$id]['suma'] == 0){
            $DBobj -> delete($id);
            Messages::add('Sąskaita ištrinta', 'no-error');
        }
        else {
            Messages::add('KLAIDA! Kliento '.$list[$id]['vardas'].' '.$list[$id]['pavarde'].' sąskaitoje yra '.$list[$id]['suma'].' eur., todėl jo sąskaita negali būti ištrinta', 'error');
        }
        return App::redirect('list');
    }  
}