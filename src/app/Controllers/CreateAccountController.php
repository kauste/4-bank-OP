<?php
namespace Savers\Bank\Controllers;
use Savers\Bank\App;
use Savers\Bank\Messages;
use Savers\Bank\DB\JsonDB;
use Savers\Bank\Validations\IbanValid;
use Savers\Bank\Validations\ValidPersonID;

class CreateAccountController{
    // public function createPage(){
    //     return App::view('createAccount', ['title'=> 'Create Account', 'iban' => (new IbanValid)-> validIban()]);
    // }

    public function doCreate(){
            $client = file_get_contents("php://input"); // cia vietoj $_POST
            $client = json_decode($client, 1);

        // $client = $_POST;
        // if(($_POST['csrf']?? '') != App::csrf()){
        //     Messages::add('Ne ten pataikei', 'error');
        //     return App::redirect('createAccount');
        // }
        if (!(New ValidPersonID) ->isValidPersonId($client['asmensKodas'])){
            $out = ['msg' => 'KLAIDA! Nurodytas neteisingas asmens kodas'];
            $out = json_encode($out);
            echo $out;
            return;
            // Messages::add('KLAIDA! Nurodytas neteisingas asmens kodas', 'error');
        } 
        if (strlen($client['vardas']) < 3){
            $out = ['msg' => 'KLAIDA! Nurodytas vardas per trumpas.'];
            $out = json_encode($out);
            echo $out;
            return;
            // Messages::add('KLAIDA! Nurodytas vardas per trumpas.', 'error');
        }
        if (strlen($client['pavarde']) < 3){
            $out = ['msg' => 'KLAIDA! Nurodyta pavardė per trumpa.'];
            $out = json_encode($out);
            echo $out;
            return;
            // Messages::add('KLAIDA! Nurodyta pavardė per trumpa.', 'error');
        }
        // if (!isset($_SESSION['msg']) && !file_exists(App::CLIENTS)){
        //         Messages::add('Sąskaita pridėta.', 'no-error');
        //         $client['suma'] = 0;
        //         App::$db -> create($client);
        // }
        // if (!isset($_SESSION['msg']) && file_exists(App::CLIENTS)){
        //     $clients = App::$db -> showAll();
        //     foreach($clients as $item){
        //         if($item['asmens-kodas'] == $client['asmens-kodas']){
        //             Messages::add('KLAIDA! Sąskaita nurodytu asmens kodu jau egzistuoja.', 'error');
        //             return App::redirect('createAccount');
        //         }
        //     }
            // Messages::add('Sąskaita pridėta.', 'no-error');
            $client['suma'] = 0;
            App::$db -> create($client);
            $out = ['msg' => 'Sąskaita pridėta'];
            $out = json_encode($out);
            echo $out;


        }
        //  return App::redirect('createAccount');
    // }
}

