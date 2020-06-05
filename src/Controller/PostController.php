<?php

namespace Controller;

use Entity\Post;
use ludk\Http\Request;
use ludk\Http\Response;
use ludk\Controller\AbstractController;

class PostController extends AbstractController
{
    public function create(Request $request): Response
    {
        global $typeRepo;

        global $manager;

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
                header('Location: display');
            }
        } else {
            include "../templates/new.php";
        }
    }
}
