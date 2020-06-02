<?php

use Entity\User;
use Entity\Post;
use Entity\Type;
use ludk\Persistence\ORM;

require __DIR__ . '/../vendor/autoload.php';
// session_start();

//Repository (permet de recupérer les données)
$orm = new ORM(__DIR__ . '/../Resources');
$postRepo = $orm->getRepository(Post::class);
$userRepo = $orm->getRepository(User::class);
$typeRepo = $orm->getRepository(Type::class);
//recup le manager (permet d'edit les données)
// $manager = $orm->getManager();
//On choisi le post à modifier
// $post = $postRepo->find(1);
//On modifie le titre du post 1
// $post->title = "test";
// $manager->persist($post);

//Créer un new post 
// $newPost = new Post();
// $newPost->title = "Earth";
// $newPost->description = "our planet";
// $newPost->user = $post->user;
// $newPost->price = "40€";
// $newPost->type = $post->type;
// $newPost->image = "https://images.unsplash.com/flagged/photo-1585324853527-1c567d53bb72?ixlib=rb-1.2.1&ixid=eyJhcHBfaWQiOjEyMDd9&auto=format&fit=crop&w=2038&q=80";
// $newPost->postedTime = time();

// $manager->persist($newPost);

// $manager->flush();

$action = $_GET["action"] ?? "display";
switch ($action) {
    case 'register':
        break;
    case 'logout':
        break;
    case 'login':
        if (isset($_POST['username']) && isset($_POST['password'])) {
            $users = GetUserIdFromUserAndPassword($_POST['username'], $_POST['password']);
            if (count($users == 1) {
              $_SESSION['userId'] = $userq[0]->id;
              header('Location: ?action=display');
            } else {
              $errorMsg = "Wrong login and/or password.";
              include "../views/LoginForm.php";
            }
          } else {
            include "../views/LoginForm.php";
        break;

    case 'new':
        break;
    case 'display':
    default:
        $items = array();

        if (isset($_GET['search'])) {
            $search = $_GET['search'];

            if (strpos($search, "@") === 0) {
                $userRepo = $orm->getRepository(User::class);
                //permet de decider quelle partie du string on veut passer en url
                $nickname = substr($search, 1);
                $users = $userRepo->findBy(array("nickname" => $nickname));
                //check if user exists
                if (count($users) == 1) {
                    $user = $users[0];
                    $items = $postRepo->findBy(array('user' => $user->id));
                }
            } else {
                $items = $postRepo->findBy(array("title" => $search));
            };
        } else {
            $items = $postRepo->findAll();
        }
        break;
}
include '../templates/display.php';
