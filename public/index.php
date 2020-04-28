<?php

use Entity\Post;
use Entity\User;
use Entity\Type;

require '../vendor/autoload.php';

//////////////////////////////////  ADD TYPES ////////////////////////////
//Add painting type1
$waterColor = new Type();
$waterColor->id = 1;
$waterColor->name = "Watercolor";

//Add painting type2
$oilPaint = new Type();
$oilPaint->id = 2;
$oilPaint->name = "Oil painting";

//////////////////////////////// ADD USERS ///////////////////////////////
//Add user1
$userRicchi = new User();
$userRicchi->id = 1;
$userRicchi->nickname = "Ricchi";
$userRicchi->password = "12ririri";
$userRicchi->email = "ricchi@gmail.com";

//Add user2
$userMadmady = new User();
$userMadmady->id = 2;
$userMadmady->nickname = "Madmady";
$userMadmady->password = "93mmmm";
$userMadmady->email = "mad-mady@gmail.com";

////////////////////////////////// ADD  POSTS ///////////////////////////////////

//Add post1
$post1 = new Post();
$post1->id = 1;
$post1->user = $userRicchi;
$post1->title = "Lady";
$post1->image = 'https://cdn.pixabay.com/photo/2017/04/02/16/58/man-2196323_960_720.jpg';
$post1->description = "Illustration done for a client who wanted to use it as gift last month ";
$post1->posted_time = time();
$post1->type = $oilPaint;
$post1->price = "25€";

//Add post2
$post2 = new Post();
$post2->id = 2;
$post2->user = $userMadmady;
$post2->title = "Maison";
$post2->image = 'https://cdn.pixabay.com/photo/2015/03/30/11/01/paintings-698290_960_720.jpg';
$post2->description = "Illustration done for a client who wanted to use it as gift last month ";
$post2->posted_time = time();
$post2->type = $waterColor;
$post2->price = "35€";

// ... other objects creations
$items = array($post1, $post2, $post1, $post2, $post1, $post2, $post1, $post2, $post1, $post2, $post1, $post2, $post1, $post2);
?>

<!doctype html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css"
        integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
    <!-- CSS -->
    <link rel="stylesheet" href="style.css">
    <title>Artists cave</title>
</head>

<body>
    <header>
        <img src="assets/painting-911804_1920.png" alt="">

    </header>

    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
        <a class="navbar-brand" href="#">Navbar</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNavDropdown"
            aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNavDropdown">
            <ul class="navbar-nav">
                <li class="nav-item active">
                    <a class="nav-link" href="#">Home <span class="sr-only">(current)</span></a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#">Features</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#">Pricing</a>
                </li>
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLink" role="button"
                        data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        Dropdown link
                    </a>
                    <div class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
                        <a class="dropdown-item" href="#">Action</a>
                        <a class="dropdown-item" href="#">Another action</a>
                        <a class="dropdown-item" href="#">Something else here</a>
                    </div>
                </li>
            </ul>
        </div>
    </nav>

    <!-- row1 -->

    <div class="row mt-5">
        <div class="col-lg-12 d-flex justify-center">
            <div class="col-lg-12 d-flex justify-center">
                <?php
                $i = 0;
                foreach ($items as $item) {
                ?>
                <div class="card mb-4 mr-3 p-0">
                    <img src="<?php echo $item->image; ?>" class="card-img-top" alt="...">
                    <div class="card-body">
                        <h5 class="card-title">Card title</h5>
                        <p class="card-text">
                            <ul>
                                <li>Artist : <?php echo $item->user->nickname; ?></li>
                                <li>Description : </li>
                                <li>Tarifs : </li>
                                <li>Type : </li>
                            </ul>
                        </p>
                        <p class="card-text"><small class="text-muted">Last updated 3 mins ago</small></p>
                    </div>
                    <button type="button" class="btn btn-dark">Contact me</button>
                </div>
                <?php
                    $i++;
                    if ($i % 3 == 0) {
                        echo '</div></div></div><div class="row mt-5"><div class="col-lg-12 d-flex justify-center"><div class="col-lg-12 d-flex justify-center">';
                    }
                }
                ?>
            </div>
        </div>
    </div>

    <!-- Contenu -->

    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js"
        integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous">
    </script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js"
        integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous">
    </script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js"
        integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous">
    </script>
</body>

</html>