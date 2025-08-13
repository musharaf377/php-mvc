<?php

use App\Controllers\HomeController;
use app\Core\Router;

// Router::get('/', [HomeController::class, 'index']);

Router::get('/', 'HomeController@index');

Router::get('/about', function(){
    echo "<h1>this is about us page. </h1>";
});