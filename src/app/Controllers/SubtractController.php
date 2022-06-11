<?php
namespace Savers\Bank\Controllers;
use Savers\Bank\App;

class SubtractController {
    public function subtract(){
        return App::view('subtract', ['title'=> 'Subtract']);
    }
}