<?php
namespace Savers\Bank\Controllers;
use Savers\Bank\App;
use Savers\Bank\Messages;
use Savers\Bank\Controllers\DataBaseController;
class LoginController {
    public function showLogin(){
        return App::view('login', ['title'=> 'login']);
    }
    public function doLogin(){
        if(($_POST['csrf']?? '') != App::csrf()){
            Messages::add('Ne ten pataikei', 'error');
            return App::redirect('login');
        }
        $users = (new DataBaseController) -> showAll();
        foreach($users as $user){
            if($_POST['name'] != $user -> name){
                continue;
            }
            if(md5($_POST['password']) != $user -> psw){
                Messages::add('Neteisinga prisijungimo informacija', 'error');
                return App::redirect('login');
            } else {
                App::authAdd($user);
                Messages::add('Laba diena, '.$user->full_name, 'no-error');
                return App::redirect('home');
            }
        }
            Messages::add('Neteisinga prisijungimo informacija', 'error');
            return App::redirect('login');
    }
    public function doLogout(){
        App::authRem();
        return App::redirect('login');
    }

}