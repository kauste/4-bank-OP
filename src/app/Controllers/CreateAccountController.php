<?php
namespace Savers\Bank\Controllers;
use Savers\Bank\App;
use Savers\Bank\Messages;
use Savers\Bank\Controllers\DataBaseController;
use Savers\Bank\Validations\IbanValid;
use Savers\Bank\Validations\ValidPersonID;

class CreateAccountController{
    public function createPage(){
        return App::view('createAccount', ['title'=> 'Create Account', 'iban' => (new IbanValid)-> validIban()]);
    }

    public function doCreate(){
        $client = $_POST;
        if(($_POST['csrf']?? '') != App::csrf()){
            Messages::add('Ne ten pataikei', 'error');
            return App::redirect('createAccount');
        }
        if (!(New ValidPersonID) ->isValidPersonId($client['asmens-kodas'])){
            Messages::add('KLAIDA! Nurodytas neteisingas asmens kodas', 'error');
        } 
        if (strlen($client['vardas']) < 3){
            Messages::add('KLAIDA! Nurodytas vardas per trumpas.', 'error');
        }
        if (strlen($client['pavarde']) < 3){
            Messages::add('KLAIDA! Nurodyta pavardė per trumpa.', 'error');
        }
        if (!isset($_SESSION['msg']) && !file_exists(App::CLIENTS)){
                Messages::add('Sąskaita pridėta.', 'no-error');
                $client['suma'] = 0;
                App::$db -> create($client);
        }
        if (!isset($_SESSION['msg']) && file_exists(App::CLIENTS)){
            $clients = App::$db -> showAll();
            foreach($clients as $item){
                if($item['asmens-kodas'] == $client['asmens-kodas']){
                    Messages::add('KLAIDA! Sąskaita nurodytu asmens kodu jau egzistuoja.', 'error');
                    return App::redirect('createAccount');
                }
            }
            Messages::add('Sąskaita pridėta.', 'no-error');
            $client['suma'] = 0;
            App::$db -> create($client);
        }
         return App::redirect('createAccount');     
    }
}

