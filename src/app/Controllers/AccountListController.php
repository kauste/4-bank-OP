<?php
namespace Savers\Bank\Controllers;
use Savers\Bank\App;
class AccountListController {
    public function list(){
        if(file_exists(__DIR__ .'/../../data/clients.json')){
            $list = json_decode(file_get_contents(__DIR__ .'/../../data/clients.json'), 1);
        } else {
            $list = [['Vardenis', 'Pavardenis', 'Asmens kodas', 'Saskaitos Nr', '0']];
        }
        
        return App::view('accountList', ['title'=> 'Account List', 'list' => $list]);
    }
    
}