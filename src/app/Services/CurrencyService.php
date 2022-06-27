<?php
namespace Savers\Bank\Services;
use Savers\Bank\Messages;
use Savers\Bank\App;
use Savers\Bank\Services\Cache;

class CurrencyService {
        public static $cache;
        public static function currencyPost(){
                self::$cache = new Cache;
                $output = (self::$cache)->get();
                if(null == $output){
                        $curl = curl_init();
                        curl_setopt($curl, CURLOPT_URL, 'https://v6.exchangerate-api.com/v6/c7cbaecbd334bd63f4960e80/latest/EUR');
                        curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
                        $output = curl_exec($curl);
                        $output = json_decode($output, 1);
                        $output = $output['conversion_rates'];
                        curl_close($curl);
                        (self::$cache)->set($output);
        }
       
        $chosenCurrency = strtoupper($_POST['currency']);

                if(!array_key_exists($chosenCurrency, $output)){
                        Messages::add('Tokia valiuta neegzistuoja','error');
                        $chosenCurrency = 'EUR';
                }
        $_SESSION['currency'] = ['curr' => $chosenCurrency, 'currValue' => $output[$chosenCurrency]];
        }
        public static function currencyGet(){
                $curr = $_SESSION['currency'] ?? ['curr' => 'EUR', 'currValue' => 1];
                return $curr;
        }
}