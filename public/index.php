<?php

use Controller\AuthController;
use Controller\HomeController;
use Controller\PostController;
use Entity\User;
use Entity\Post;
use Entity\Type;
use ludk\Persistence\ORM;

require __DIR__ . '/../vendor/autoload.php';
session_start();

//Repository (get the data)
$orm = new ORM(__DIR__ . '/../Resources');
$manager = $orm->getManager();
$postRepo = $orm->getRepository(Post::class);
$userRepo = $orm->getRepository(User::class);
$typeRepo = $orm->getRepository(Type::class);

$action = substr(parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH), 1);

switch ($action) {

        //******************** Register 
    case 'register':
        $controller = new AuthController;
        $controller->register();
        break;

        //******************LOGOUT
    case 'logout':
        $controller = new AuthController;
        $controller->logout();
        break;
        //*****************LOGIN
    case 'login':
        $controller = new AuthController();
        $controller->login();
        break;

        // ************************Create a new post
    case 'new':
        $controller = new PostController();
        $controller->create();
        break;

        //****************** Default case: Display
    case 'display':
    default:
        $controller = new HomeController();
        $controller->display();
        break;
}
