<?php

namespace App\Config;
use System\Core\Router;
$router = new Router();

// Routes List
$router->get('/', 'Home::index');
$router->get('/about', 'Home::about');
$router->get('/send', 'EmailTest::sendContactEmail');
$router->post('/contact', 'Contact::submit'); // Example POST route

// $router->get('/protected', 'UserController::profile', ['AuthMiddleware']);



$router->get('/users', 'User::index');
$router->get('/users/{id}', 'User::show');

