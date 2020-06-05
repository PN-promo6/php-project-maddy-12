<?php

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

$action = $_GET["action"] ?? "display";
switch ($action) {

        //******************** Register 
    case 'register':
        //If user fill the username and password and retypes the correct password
        if (isset($_POST['username']) && isset($_POST['password']) && isset($_POST['passwordRetype'])) {
            //Don't show the error message
            $errorMsg = NULL;
            //If the username exists already
            $users = $userRepo->findBy(array("nickname" => $_POST['username']));
            $userEmail = $userRepo->findBy(array("email" => $_POST['email']));
            if (count($users) > 0) {
                //Show error message
                $errorMsg = "Username already used.";
            } elseif (count($userEmail) > 0) {
                $errorMsg = "E-mail already used.";

                //If the retyped password is diffrent from the pwd filled previously
            } else if ($_POST['password'] != $_POST['passwordRetype']) {

                //Show error message
                $errorMsg = "Passwords are not the same.";

                //If the password is too short (less than 8 characters)
            } else if (strlen(trim($_POST['password'])) < 8) {

                //Show error message
                $errorMsg = "Your password should have at least 8 characters.";

                //if the username is too short ( less than 4 characters)
            } else if (strlen(trim($_POST['username'])) < 4) {

                //Show error message
                $errorMsg = "Your nickame should have at least 4 characters.";
            }

            if ($errorMsg) {
                include "../templates/register.php";
            } else {
                //Create a new user
                $newUser = new User();
                $newUser->nickname = $_POST['username'];
                $newUser->password = md5($_POST['password']);
                $newUser->email = $_POST['email'];

                $manager->persist($newUser);
                $manager->flush();
                $_SESSION['user'] = $user;
                header('Location: ?action=display');
            }
        } else {
            include "../templates/register.php";
        }
        break;

        //******************LOGOUT
    case 'logout':
        if (isset($_SESSION['user'])) {
            unset($_SESSION['user']);
        }
        header('Location: ?action=display');
        break;
        //*****************LOGIN
    case 'login':
        if (isset($_POST['username']) && isset($_POST['password'])) {
            $usersWithThisLogin = $userRepo->findBy(array("nickname" => $_POST['username']));
            if (count($usersWithThisLogin) == 1) {
                $firstUserWithThisLogin = $usersWithThisLogin[0];
                if ($firstUserWithThisLogin->password != md5($_POST['password'])) {
                    $errorMsg = "Wrong password.";
                    include "../templates/login.php";
                } else {
                    $_SESSION['user'] = $usersWithThisLogin[0];
                    header('Location:/?action=display');
                }
            } else {
                $errorMsg = "Nickname doesn't exist.";
                include "../templates/login.php";
            }
        } else {
            include "../templates/login.php";
        }
        break;

        // ************************Create a new post
    case 'new':
        $types = $typeRepo->findAll();

        if (
            isset($_SESSION['user'])
            && isset($_POST['image'])
            && isset($_POST['title'])
            && isset($_POST['description'])
            && isset($_POST['price'])
            && isset($_POST['type'])
        ) {
            $errorMsg = NULL;
            //image
            if (strlen(trim($_POST['image'])) == 0) {
                $errorMsg = "Please put the URL link of the image";
            } elseif (strlen(trim($_POST['title'])) == 0) {
                $errorMsg = "Please put a title";

                //description
            } else if (strlen(trim($_POST['description'])) == 0) {
                $errorMsg = "Please write a description";

                //price
            } else if (strlen(trim($_POST['price'])) == 0) {
                $errorMsg = "Please set the price";

                //type
            } else if (($_POST['type']) == "-") {
                $errorMsg = "Please select a type";
            }
            if ($errorMsg != null) {
                include "../templates/new.php";
            } else {
                //create a new post
                $newPost = new Post();
                $currentType = $typeRepo->find($_POST['type']);
                $newPost->title = $_POST['title'];
                $newPost->description = $_POST['description'];
                $newPost->user = $_SESSION['user'];
                $newPost->price = $_POST['price'];
                $newPost->type = $currentType;
                $newPost->image = $_POST['image'];
                $newPost->postedTime = time();

                $manager->persist($newPost);

                $manager->flush();
                header('Location: ?action=display');
            }
        } else {
            include "../templates/new.php";
        }
        break;

        //****************** Default case
    case 'display':
    default:
        $items = array();

        if (isset($_GET['search'])) {
            $search = $_GET['search'];

            if (strpos($search, "@") === 0) {

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
        include '../templates/display.php';
        break;
}
