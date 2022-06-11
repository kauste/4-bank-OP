<?php
namespace Savers\Bank\Controllers;
use Savers\Bank\App;

class AddController {
    public function add(){
        return App::view('add', ['title'=> 'Add']);
    }
}