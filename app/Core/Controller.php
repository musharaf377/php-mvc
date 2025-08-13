<?php

namespace App\Core;

class Controller{
    protected function render_view($view, $data = []){
        extract($data);
        require_once __DIR__ . "/../Views/$view.php";
    }
}
