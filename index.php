<?php

require_once 'core/init.php';
require_once 'core/Reflect.php';
require_once __DIR__ . '/vendor/bramus/router/src/Bramus/Router/Router.php';

// Create a Router
$router = new \Bramus\Router\Router();
// Custom 404 Handler
$router->set404(function () {
    header($_SERVER['SERVER_PROTOCOL'] . ' 404 Not Found');
    Redirect::to(404);
});
// Before Router Middleware
$router->before('GET', '/.*', function () {
    header('X-Powered-By: bramus/router');
});

// Static route: / (homepage)
$router->get('/', function () {
    Reflect::call('IndexController', 'view');
});
$router->get('/register', function () {
    Reflect::call('RegisterController', 'view');
});
$router->post('/register', function () {
    Reflect::call('RegisterController', 'doRegister');
});
$router->get('/login', function () {
    Reflect::call('LoginController', 'view');
});
$router->post('/login', function () {
    Reflect::call('LoginController', 'doLogin');
});
$router->get('/logout', function () {
    Reflect::call('LoginController', 'logout');
});
$router->get('/logout', function () {
    Reflect::call('LoginController', 'logout');
});
$router->get('/profile', function () {
    Reflect::call('ProfileController', 'viewEditProfile');
});
$router->post('/profile', function () {
    Reflect::call('ProfileController', 'updateProfile');
});
$router->get('/profile/(\w+)', function ($username) {
    Reflect::call('ProfileController', 'view', $username);
});
$router->get('/change-password', function () {
    Reflect::call('ProfileController', 'viewChangePassword');
});
$router->post('/change-password', function () {
    Reflect::call('ProfileController', 'changePassword');
});

$router->run();