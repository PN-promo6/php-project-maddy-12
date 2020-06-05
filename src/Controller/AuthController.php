<?php

namespace Controller;

use Entity\User;
use ludk\Http\Request;
use ludk\Http\Response;
use ludk\Controller\AbstractController;

class AuthController extends AbstractController
{
    public function login(Request $request): Response
    {
        $userRepo = $this->getOrm()->getRepository(User::class);
        if ($request->request->has('username') && $request->request->has('password')) {
            $usersWithThisLogin = $userRepo->findBy(array("nickname" => $request->request->get('username')));

            if (count($usersWithThisLogin) == 1) {
                $firstUserWithThisLogin = $usersWithThisLogin[0];
                if ($firstUserWithThisLogin->password != md5($request->request->get('password'))) {
                    $errorMsg = "Wrong password.";

                    $data = array(
                        "errorMsg" => $errorMsg
                    );
                    return $this->render("login.php", $data);
                } else {

                    $request->getSession()->set('user', $usersWithThisLogin[0]);
                    return $this->redirectToRoute('display');
                }
            } else {
                $errorMsg = "Nickname doesn't exist.";

                $data = array(
                    "errorMsg" => $errorMsg
                );
                return $this->render("login.php", $data);
            }
        } else {
            return $this->render("login.php");
        }
    }

    public function logout(Request $request): Response
    {

        if ($request->getSession()->has('user')) {
            $request->getSession()->remove('user');
        }
        return $this->redirectToRoute('display');
    }

    public function register(Request $request): Response
    {
        $userRepo = $this->getOrm()->getRepository(User::class);
        $manager = $this->getOrm()->getManager();

        //If user fill the username and password and retypes the correct password
        if ($request->request->has('username') && $request->request->has('password') && $request->request->has('passwordRetype')) {
            //Don't show the error message
            $errorMsg = NULL;
            //If the username exists already
            $users = $userRepo->findBy(array("nickname" => $request->request->get('username')));
            $userEmail = $userRepo->findBy(array("email" => $request->request->get('email')));
            if (count($users) > 0) {
                //Show error message
                $errorMsg = "Username already used.";
            } elseif (count($userEmail) > 0) {
                $errorMsg = "E-mail already used.";

                //If the retyped password is diffrent from the pwd filled previously
            } else if ($request->request->get('password') != $request->request->get('passwordRetype')) {

                //Show error message
                $errorMsg = "Passwords are not the same.";

                //If the password is too short (less than 8 characters)
            } else if (strlen(trim($request->request->get('password'))) < 8) {

                //Show error message
                $errorMsg = "Your password should have at least 8 characters.";

                //if the username is too short ( less than 4 characters)
            } else if (strlen(trim($request->request->get('username'))) < 4) {

                //Show error message
                $errorMsg = "Your username should have at least 4 characters.";
            }

            if ($errorMsg) {

                $data = array(
                    "errorMsg" => $errorMsg
                );
                return $this->render("register.php", $data);
            } else {
                //Create a new user
                $newUser = new User();
                $newUser->nickname = $request->request->get('username');
                $newUser->password = md5($request->request->get('password'));
                $newUser->email = $request->request->get('email');

                $manager->persist($newUser);
                $manager->flush();

                $request->getSession()->set('user', $newUser);
                return $this->redirectToRoute('display');
            }
        } else {

            return $this->render("register.php");
        }
    }
}
