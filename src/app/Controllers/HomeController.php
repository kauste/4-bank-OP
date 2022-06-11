<?php
namespace Savers\Bank\Controllers;
use Savers\Bank\App;
class HomeController {
    public function home (){
        return App::view('home', ['title'=> 'Home']);
    }
}