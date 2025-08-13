<?php 

require __DIR__. '/../app/Core/Router.php';
require __DIR__. '/../app/Core/Controller.php';
require __DIR__. '/../routes/web.php';

use App\Core\Router;

$uri = $_SERVER['REQUEST_URI'];
$method = $_SERVER['REQUEST_METHOD'];
// echo $method;
Router::dispatch($uri, $method);