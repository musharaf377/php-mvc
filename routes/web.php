<?php

use app\Core\Router;


Router::get('/', function(){
    echo "<h1>this is Home page. </h1>";
});

Router::get('/about', function(){
    echo "<h1>this is about us page. </h1>";
});