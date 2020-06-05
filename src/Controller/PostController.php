<?php

namespace Controller;

use Entity\Post;
use Entity\Type;
use ludk\Http\Request;
use ludk\Http\Response;
use ludk\Controller\AbstractController;

class PostController extends AbstractController
{
    public function create(Request $request): Response
    {
        $typeRepo = $this->getOrm()->getRepository(Type::class);

        $manager = $this->getOrm()->getManager();

        $types = $typeRepo->findAll();

        if (
            ($request->getSession()->has('user'))
            && $request->request->has('image')
            && $request->request->has('title')
            && $request->request->has('description')
            && $request->request->has('price')
            && $request->request->has('type')
        ) {
            $errorMsg = NULL;
            //image
            if (strlen(trim($request->request->get('image'))) == 0) {
                $errorMsg = "Please put the URL link of the image";
            } elseif (strlen(trim($request->request->get('title'))) == 0) {
                $errorMsg = "Please put a title";

                //description
            } else if (strlen(trim($request->request->get('description'))) == 0) {
                $errorMsg = "Please write a description";

                //price
            } else if (strlen(trim($request->request->get('price'))) == 0) {
                $errorMsg = "Please set the price";

                //type
            } else if (($request->request->get('type')) == "-") {
                $errorMsg = "Please select a type";
            }
            if ($errorMsg != null) {
                $data = array(
                    "errorMsg" => $errorMsg,
                    "types" => $types
                );
                return $this->render("new.php", $data);
            } else {
                //create a new post
                $newPost = new Post();
                $currentType = $typeRepo->find($request->request->get('type'));
                $newPost->title = $request->request->get('title');
                $newPost->description = $request->request->get('description');
                $newPost->user = $request->getSession()->get('user');
                $newPost->price = $request->request->get('price');
                $newPost->type = $currentType;
                $newPost->image = $request->request->get('image');
                $newPost->postedTime = time();

                $manager->persist($newPost);

                $manager->flush();
                return $this->redirectToRoute('display');
            }
        } else {
            $data = array(
                "types" => $types
            );
            return $this->render("new.php", $data);
        }
    }
}
