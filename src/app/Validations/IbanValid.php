<?php
namespace Savers\Bank\Validations;
use Savers\Bank\DB\JsonDB;
use Savers\Bank\App;

class IbanValid {
    public function validIban(){
        $db = new JsonDB('clients');
        if(file_exists(App::CLIENTS)){
            $clients = $db -> showAll();
            $iban = $this -> iban();
            do {
                $shoudRepeat = 0;
                foreach($clients as $client){
                    if($client['saskaitosNr'] == $iban){
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
    public function iban(){
        $accountNum = strval(rand(0, 9)) . strval(rand(0, 9))  . strval(rand(0, 9))  . strval(rand(0, 9)) . strval(rand(0, 9))  . strval(rand(0, 9)) . strval(rand(0, 9)) . strval(rand(0, 9))  . strval(rand(0, 9))  . strval(rand(0, 9)) . strval(rand(0, 9));
            $bankNum = strval(77777);
            $controlSymbols = '01';
            $iban = 'LT' . $controlSymbols .$bankNum . $accountNum;
            return $iban;
    }
}
