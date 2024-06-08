<?php
require_once '../config/config.php';
require_once '../vendor/autoload.php';

use Core\App;
use Core\Router;

$router = new Router();

$router->add('', 'HomeController', 'index', true); 
$router->add('teste', 'TesteController', 'index'); 
$router->add('login', 'AuthController', 'index'); 

$router->add('user/{id}/{nome}', 'TesteController', 'show');

$app = new App($router);
$app->run();