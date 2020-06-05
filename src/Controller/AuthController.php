<?php

namespace Controller;

use Entity\User;

class AuthController
{
    public function login()
    {
        global $userRepo;
        if (isset($_POST['username']) && isset($_POST['password'])) {
            $usersWithThisLogin = $userRepo->findBy(array("nickname" => $_POST['username']));
            if (count($usersWithThisLogin) == 1) {
                $firstUserWithThisLogin = $usersWithThisLogin[0];
                if ($firstUserWithThisLogin->password != md5($_POST['password'])) {
                    $errorMsg = "Wrong password.";
                    include "../templates/login.php";
                } else {
                    $_SESSION['user'] = $usersWithThisLogin[0];
                    header('Location:/');
                }
            } else {
                $errorMsg = "Nickname doesn't exist.";
                include "../templates/login.php";
            }
        } else {
            include "../templates/login.php";
        }
    }

    public function logout()
    {
        if (isset($_SESSION['user'])) {
            unset($_SESSION['user']);
        }
        header('Location: /display');
    }

    public function register()
    {
        global $userRepo;
        global $manager;
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
                header('Location: /display');
            }
        } else {
            include "../templates/register.php";
        }
    }
}
