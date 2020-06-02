<?php

use Entity\Post;
use Entity\Type;
use ludk\Persistence\ORM;

require __DIR__ . '/../vendor/autoload.php';
session_start();
$orm = new ORM(__DIR__ . '/../Resources');
$postRepo = $orm->getRepository(Post::class);
//recup le manager 
$manager = $orm->getManager();
//On choisi le post à modifier
$post = $postRepo->find(1);
//On modifie le titre du post 1
$post->title = "test";
$manager->persist($post);

//Créer un new post 
$newPost = new Post();
$newPost->title = "Earth";
$newPost->description = "our planet";
$newPost->user = $post->user;
$newPost->price = "40€";
$newPost->type = $post->type;
$newPost->image = "https://images.unsplash.com/flagged/photo-1585324853527-1c567d53bb72?ixlib=rb-1.2.1&ixid=eyJhcHBfaWQiOjEyMDd9&auto=format&fit=crop&w=2038&q=80";
$newPost->postedTime = time();

$manager->persist($newPost);

$manager->flush();

//Search feature
$items = array();
if (isset($_GET['search'])) {
    $items = $postRepo->findBy(array("title" => $_GET['search']));
} else {
    $items = $postRepo->findAll();
}

?>

<!doctype html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
    <!-- CSS -->
    <link rel="stylesheet" href="style.css?time=<?php echo time(); ?>">
    <title>Artists cave</title>
</head>

<body>
    <header>
        <img src="assets/painting-911804_1920.png" alt="">
    </header>

    <nav class="navbar navbar-expand-lg navbar-dark bg-dark d-flex justify-content-between">
        <a class="navbar-brand" href="#">Artists cave</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNavDropdown">
            <ul class="navbar-nav">
                <li class="nav-item active">
                    <a class="nav-link" href="#">Home <span class="sr-only">(current)</span></a>
                </li>

            </ul>
            <form class="form-inline my-2 my-lg-0">
                <input class="form-control mr-sm-2" type="search" placeholder="Search" aria-label="Search">
                <button class="btn btn-outline-success my-2 my-sm-0" type="submit">Search</button>
            </form>
            <button type="button" class="btn btn-outline-info">Sign Up</button>
            <button type="button" class="btn btn-outline-secondary">Sign In</button>
        </div>
    </nav>

    <!-- row1 -->
    <div class="container">
        <div class="row">
            <?php
            //Loop for the cards
            $i = 0;
            foreach ($items as $item) {
                //Go to the next row when the previous row has 3 cards
                if ($i % 3 == 0 && $i > 0) {
                    echo '</div><div class="row">';
                }
            ?>
                <div class="col-sm-4">
                    <div class="card">
                        <img src="<?php echo $item->image; ?>" class="img-fluid" alt="...">
                        <div class="card-body">
                            <h5 class="card-title"><?php echo $item->title; ?></h5>
                            <p class="card-text">
                                <ul>
                                    <li>Artist : <?php echo $item->user->nickname; ?></li>
                                    <li>Description : <?php echo $item->description; ?> </li>
                                    <li>Tarifs : <?php echo $item->price; ?> </li>
                                    <li>Type : <?php echo $item->type->name; ?> </li>
                                </ul>
                            </p>

                        </div>
                        <p class="card-text"><small class="text-muted">Last updated 3 mins ago</small></p>
                        <button type="button" class="btn btn-dark">Contact me</button>
                    </div>
                </div>
            <?php
                //incrementation of the cards in each row (after this we go to the if ($i % 3 ==0) part)
                $i++;
            }
            ?>
        </div>
    </div>
    <!-- Contenu -->

    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous">
    </script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous">
    </script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous">
    </script>
</body>

</html>