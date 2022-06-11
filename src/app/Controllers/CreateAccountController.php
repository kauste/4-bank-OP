<?php
namespace Savers\Bank\Controllers;
use Savers\Bank\App;
use Savers\Bank\Messages;
class CreateAccountController{
    public function create(){
        return App::view('createAccount', ['title'=> 'Create Account', 'iban' => $this-> validIban(), 'messages'=> Messages::get()]);
    }
    public function doCreate(){
        $clients = json_decode(file_get_contents(App::CLIENTS), true);   
        foreach($clients as $item){
            if($item['asmens-kodas'] == $_POST['asmens-kodas']){
                Messages::add('Sąskaita nurodytu asmens kodu jau egzistuoja.', 'error');
                break;
            }
        } 
        if (!self::isValidPersonId()){
            Messages::add('Nurodytas neteisingas asmens kodas', 'error');
        } 
        if (strlen($_POST['vardas'])< 3){
            Messages::add('Nurodytas vardas per trumpas.', 'error');
        }
        if (strlen($_POST['pavarde'])< 3){
            Messages::add('Nurodyta pavardė per trumpa.', 'error');
        }
        if ($_SESSION['msg'] == []) {
            Messages::add('Sąskaitos numeris pridėtas', 'no-error');
            self::addClient();
        }
        return App::redirect('createAccount');
    }
    private static function isValidPersonId(){
        $year = $_POST['asmens-kodas'][1] . $_POST['asmens-kodas'][2];
        $month = $_POST['asmens-kodas'][3] . $_POST['asmens-kodas'][4];
        $day = $_POST['asmens-kodas'][5] . $_POST['asmens-kodas'][6];
        function dayRange($month ){
            if ($month == '02'){
                return range(1, 29);
            }
            else if($month == '04' || $month == '06' || $month == '09' || $month == '11') {
                return range(1, 30);
            } else {
                return range(1, 31);
            }
        }
        if (strlen($_POST['asmens-kodas']) != 11
        || !in_array($_POST['asmens-kodas'][0], range(3, 4))
        || !in_array($month, range(1, 12))
        || !in_array($day, dayRange($month))){
            return false;
        }
        else {
            return true;
        }
    }
    private static function  addClient(){
        if(!file_exists(App::CLIENTS)){
            file_put_contents(App::CLIENTS, json_encode([]));
        }
        $clients = json_decode(file_get_contents(App::CLIENTS), 1);
        $_POST['suma'] = 0;
        $id = self::plusID();
        $clients[$id] = $_POST;
        file_put_contents(App::CLIENTS, json_encode($clients));
    }
    private function validIban(){
        if(file_exists(App::CLIENTS)){
            $clients = json_decode(file_get_contents(App::CLIENTS), 1);
            $iban = $this -> iban();
            do {
                $shoudRepeat = 0;
                foreach($clients as $client){
                    if($client['saskaitos-numeris'] == $iban){
                        $shoudRepeat = 1;
                        break;
                    }
                }
            } while(!!$shoudRepeat);
        } else {
            $iban = $this -> iban();
        }
        return $iban;
    }
    private function iban(){
        $accountNum = strval(rand(0, 9)) . strval(rand(0, 9))  . strval(rand(0, 9))  . strval(rand(0, 9)) . strval(rand(0, 9))  . strval(rand(0, 9)) . strval(rand(0, 9)) . strval(rand(0, 9))  . strval(rand(0, 9))  . strval(rand(0, 9)) . strval(rand(0, 9));
            $bankNum = strval(77777);
            $controlSymbols = '01';
            $iban = 'LT' . $controlSymbols .$bankNum . $accountNum;
            return $iban;
    }

    public static function plusID (){
        if(!file_exists(App::ID)){
            file_put_contents(App::ID, json_encode([0]));
        }
        $id = json_decode(file_get_contents(App::ID));
        $id[0] += 1;
        file_put_contents(App::ID, json_encode($id));
        return $id[0];
    }

}