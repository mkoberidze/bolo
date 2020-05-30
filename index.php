<?php

use app\controllers\HomeController;
use app\controllers\LoginController;
use app\controllers\RegisterController;

require_once __DIR__."/vendor/autoload.php";

$router = new \app\Router(new \app\Request());

$router->get('/', 'home');

$router->get('/about', 'about');

$router->get('/contact','contact');

$router->get('/event','event');

$router->get('/register','register');

$router->get('/login','login');

$router->post('/login', [LoginController::class,'login']);

$router->post('/register', [RegisterController::class,'register']);

$router->post('/contact', [HomeController::class,'contact']);

$router->resolve();

