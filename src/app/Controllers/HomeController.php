<?php
namespace Savers\Bank\Controllers;
use Savers\Bank\App;
use Savers\Bank\Messages;
class HomeController {
    public function home (){
        return App::view('home', ['title'=> 'Home']);
    }
}