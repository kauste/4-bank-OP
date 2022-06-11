<?php
namespace Savers\Bank\Controllers;
use Savers\Bank\App;
use Savers\Bank\Messages;
class AccountListController {
    public function list(){
        if(file_exists(App::CLIENTS)){
            $list = json_decode(file_get_contents(App::CLIENTS), 1);
        } else {
            $list = [['Vardenis', 'Pavardenis', 'Asmens kodas', 'Saskaitos Nr', '0']];
        }
        
        return App::view('accountList', ['title'=> 'Account List', 'list' => $list, 'messages' => Messages::get()]);
    }
    public function deleteItem(int $id){
        $list = json_decode(file_get_contents(App::CLIENTS), 1);
        if($list[$id]['suma'] == 0){
            unset($list[$id]);
            file_put_contents(App::CLIENTS, json_encode($list));
        }
        else {
            Messages::add('Kliento '.$list[$id]['vardas'].' '.$list[$id]['pavarde'].' sąskaitoje yra '.$list[$id]['suma'].' eur., todėl jo sąskaita negali būti ištrinta', 'error');
        }
        
        return App::redirect('list');
    }
    
}