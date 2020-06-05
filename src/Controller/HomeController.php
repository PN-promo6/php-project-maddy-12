<?php

namespace Controller;

use Entity\Post;
use Entity\User;
use ludk\Http\Request;
use ludk\Http\Response;
use ludk\Controller\AbstractController;

class HomeController extends AbstractController
{
    public function display(Request $request): Response
    {
        $userRepo = $this->getOrm()->getRepository(User::class);

        $postRepo = $this->getOrm()->getRepository(Post::class);

        $items = array();
        if ($request->query->has('search')) {

            $search = $request->query->get('search');
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

        $data = array(
            "items" => $items
        );
        return $this->render("display.php", $data);
    }
}
