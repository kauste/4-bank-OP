<?php
namespace Savers\Bank;
use Savers\Bank\Controllers\HomeController;
use Savers\Bank\Controllers\AccountListController;
use Savers\Bank\Controllers\CreateAccountController;
use Savers\Bank\Controllers\AddController;
use Savers\Bank\Controllers\SubtractController;
use Savers\Bank\Controllers\LoginController;
use Savers\Bank\Messages;
class App{
    const DOMAIN = 'http://savers-bank.lt';
    const CLIENTS = __DIR__.'/../data/clients.json';
    const ID = __DIR__.'/../data/id.json';

    private static $html;

    public static function start(){
        session_start();
        Messages::init();
        ob_start(); //pastatom kibira
        $uri = substr($_SERVER['REQUEST_URI'], 1);
        $uri = explode('/', $uri);
        self::route($uri);
        self::$html = ob_get_contents(); //didelis stringas is to, kas buvo returninta visa laika
        ob_end_clean();
    }
    public static function sent(){
        echo self::$html;
    }
    public static function view(string $name, array $data = []){ //galima i cia perkelti messages get
        extract($data);
        $messages = Messages::get();
        $uri = substr($_SERVER['REQUEST_URI'], 1);
        $uri = explode('/', $uri);
        $csrf = self::csrf(); 
        require __DIR__.'/../views/'.$name.'.php'; //responsas butu reikalingas jei echointum
    }
    public static function redirect($url = ''){
        header('Location:'.self::DOMAIN.'/'.$url);
    }
    public static function authAdd(object $user){
        $_SESSION['auth'] = 1;
        $_SESSION['user'] = $user;
    }
    public static function authRem(){
        unset($_SESSION['auth'], $_SESSION['user']);
    }
    public static function authCheck(): bool{
        return isset($_SESSION['auth']) && $_SESSION['auth'] = 1;
    }
 public static function csrf (){
     return md5('utbgfyujbgfku2613kyckbvkl'.$_SERVER['HTTP_USER_AGENT']);
 }
    private static function route(array $uri){
        $m = $_SERVER['REQUEST_METHOD'];
        if($uri[0] !='login' && !self::authCheck()){
            return self::redirect('login');
        }
        if($uri[0] =='login' && self::authCheck()){
            return self::redirect('home');
        }  
        if('GET' == $m && count($uri) == 1 && $uri[0] =='login'){
            return (new LoginController)-> showLogin(); 
        }
        if('POST' == $m && count($uri) == 1 && $uri[0] =='login'){
            return (new LoginController)-> doLogin(); 
        }
        if('POST' == $m && count($uri) == 1 && $uri[0] =='logout'){
            return (new LoginController)-> doLogout(); 
        }
        if(count($uri) == 1 && $uri[0] == ''){
            return (new HomeController)-> home(); 
        }
        if('GET' == $m && count($uri) == 1 && $uri[0] =='list'){
            return (new AccountListController)-> list(); 
        }
        if('POST' == $m && count($uri) == 2 && $uri[0] =='list'){
            return (new AccountListController)-> deleteItem($uri[1]);
        }
        if('GET' == $m && count($uri) == 1 && $uri[0] == 'createAccount'){
            return (new CreateAccountController)->createPage();
        }
        if('POST' == $m && count($uri) == 1 && $uri[0] == 'createAccount'){
            return (new CreateAccountController)->doCreate();
        }
        if('GET' == $m && count($uri) == 2 && $uri[0] == 'add'){
            return (new AddController)->addTo($uri[1]);
        }
        if('POST' == $m && count($uri) == 2 && $uri[0] == 'add'){
            return (new AddController)-> addNow($uri[1]);
        }
        if('GET' == $m && count($uri) == 2 && $uri[0] == 'subtract'){
            return (new SubtractController)->subtractFrom($uri[1]);
        }
        if('POST' == $m && count($uri) == 2 && $uri[0] == 'subtract'){
            return (new SubtractController)-> subtractNow($uri[1]); //Postas ne reuter reikalas
        }
        return (new HomeController)-> home();//???
        
    }

}