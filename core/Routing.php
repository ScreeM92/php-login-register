<?php

require_once './core/Reflect.php';
require_once './vendor/bramus/router/src/Bramus/Router/Router.php';

class Routing {
    private $router;

    public function __construct() {
        // Create a Router
        $this->router = new \Bramus\Router\Router();
    }

    public function init() {
        // Custom 404 Handler
        $this->router->set404(function () {
            header($_SERVER['SERVER_PROTOCOL'] . ' 404 Not Found');
            Redirect::to(404);
        });
        // Before Router Middleware
        $this->router->before('GET', '/.*', function () {
            header('X-Powered-By: bramus/router');
        });

        // Static route: / (homepage)
        $this->router->get('/', function () {
            Reflect::call('IndexController', 'view');
        });
        $this->router->get('/register', function () {
            Reflect::call('RegisterController', 'view');
        });
        $this->router->post('/register', function () {
            Reflect::call('RegisterController', 'doRegister');
        });
        $this->router->get('/login', function () {
            Reflect::call('LoginController', 'view');
        });
        $this->router->post('/login', function () {
            Reflect::call('LoginController', 'doLogin');
        });
        $this->router->get('/logout', function () {
            Reflect::call('LoginController', 'logout');
        });
        $this->router->get('/logout', function () {
            Reflect::call('LoginController', 'logout');
        });
        $this->router->get('/profile', function () {
            Reflect::call('ProfileController', 'viewEditProfile');
        });
        $this->router->post('/profile', function () {
            Reflect::call('ProfileController', 'updateProfile');
        });
        $this->router->get('/profile/(\w+)', function ($username) {
            Reflect::call('ProfileController', 'view', $username);
        });
        $this->router->get('/change-password', function () {
            Reflect::call('ProfileController', 'viewChangePassword');
        });
        $this->router->post('/change-password', function () {
            Reflect::call('ProfileController', 'changePassword');
        });

        $this->router->run();
    }
}