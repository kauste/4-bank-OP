<?php
namespace Savers\Bank;
use Savers\Bank\Controllers\HomeController;
use Savers\Bank\Controllers\AccountListController;
use Savers\Bank\Controllers\CreateAccountController;
use Savers\Bank\Controllers\AddController;
use Savers\Bank\Controllers\subtractController;
use Savers\Bank\Messages;
class App{
    const DOMAIN = 'http://savers-bank.lt';
    const CLIENTS = __DIR__.'/../data/clients.json';
    const ID = __DIR__.'/../data/id.json';

    public static function start(){
        session_start();
        Messages::init();
        $uri = substr($_SERVER['REQUEST_URI'], 1);
        $uri = explode('/', $uri);
        self::route($uri);
    }
    public static function view(string $name, array $data = [], array $messages = []){
        extract($data);
        require __DIR__.'/../views/'.$name.'.php';
    }
    public static function redirect($url = ''){
        header('Location:'.self::DOMAIN.'/'.$url);
    }
    private static function route(array $uri){
        $m = $_SERVER['REQUEST_METHOD'];
        if(count($uri) == 1 && $uri[0] == ''){
            return (new HomeController)-> home();
        }
        if(count($uri) == 1 && $uri[0] =='list'){
            return (new AccountListController)-> list();
        }
        if('GET' == $m && count($uri) == 1 && $uri[0] == 'createAccount'){
            return (new CreateAccountController)->create();
        }
        if('POST' == $m && count($uri) == 1 && $uri[0] == 'createAccount'){
            return (new CreateAccountController)->doCreate();
        }
        if(count($uri) == 1 && $uri[0] == 'add'){
            return (new AddController)->add();
        }
        if(count($uri) == 1 && $uri[0] == 'subtract'){
            return (new SubtractController)->subtract();
        }
        else{
            echo 'kita';
        }
    }

}