<?php

use App\Core\Router;
$router = new Router();

// *** HINT: Use $router->get for GET requests (retrieving data or viewing pages) ***
// $router->get('/route', 'Controller::method');
// Example: $router->get('/post/{id}', 'Post::view'); // for a single post by ID

// *** HINT: Use $router->post for POST requests (submitting data) ***
// $router->post('/route', 'Controller::method');
// Example: $router->post('/contact', 'Contact::submit'); // for submitting a contact form

// *** HINT: Use $router->put for PUT requests (updating data) ***
// $router->put('/route/{id}', 'Controller::method');
// Example: $router->put('/post/{id}', 'Post::update'); // for updating a specific post

// *** HINT: Use $router->delete for DELETE requests (removing data) ***
// $router->delete('/route/{id}', 'Controller::method');
// Example: $router->delete('/post/{id}', 'Post::delete'); // for deleting a specific post

// *** HINT: Use $router->patch for PATCH requests (partial updates) ***
// $router->patch('/route/{id}', 'Controller::method');
// Example: $router->patch('/post/{id}/title', 'Post::updateTitle'); // for updating a post's title

// *** HINT: Define routes with dynamic parameters (e.g., {id}, {slug}) ***
// Use curly braces {} to capture dynamic segments from the URL
// Example: $router->get('/post/{id}/{slug}', 'Post::view'); // for viewing a post by ID and slug

// Routes List
$router->get('/', 'Home::index');
$router->get('/about', 'Home::about');
$router->get('/send', 'EmailTest::sendContactEmail');
$router->post('/contact', 'Contact::submit'); // Example POST route


$router->get('/users', 'User::index');

