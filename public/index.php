<?php

use Entity\Post;
use ludk\Persistence\ORM;

require __DIR__ . '/../vendor/autoload.php';
$orm = new ORM(__DIR__ . '/../Resources');
$postRepo = $orm->getRepository(Post::class);
$items = $postRepo->findAll();

//////////////////////////////////  ADD TYPES ////////////////////////////
//Add painting type1
// $waterColor = new Type();
// $waterColor->id = 1;
// $waterColor->name = "Watercolor";

//Add painting type2
// $oilPaint = new Type();
// $oilPaint->id = 2;
// $oilPaint->name = "Oil painting";

//Add painting type2
// $digitalArt = new Type();
// $digitalArt->id = 3;
// $digitalArt->name = "Digital art";

//////////////////////////////// ADD USERS ///////////////////////////////
//Add user1
// $userRicchi = new User();
// $userRicchi->id = 1;
// $userRicchi->nickname = "Ricchi";
// $userRicchi->password = "12ririri";
// $userRicchi->email = "ricchi@gmail.com";

//Add user2
// $userMadmady = new User();
// $userMadmady->id = 2;
// $userMadmady->nickname = "Madmady";
// $userMadmady->password = "93mmmm";
// $userMadmady->email = "mad-mady@gmail.com";

////////////////////////////////// ADD  POSTS ///////////////////////////////////

//Add post1
// $post1 = new Post();
// $post1->id = 1;
// $post1->user = $userRicchi;
// $post1->title = "Lady";
// $post1->image = 'https://cdn.pixabay.com/photo/2017/04/02/16/58/man-2196323_960_720.jpg';
// $post1->description = "Illustration done for a client who wanted to use it as gift last month ";
// $post1->posted_time = time();
// $post1->type = $waterColor;
// $post1->price = "25€";

//Add post2
// $post2 = new Post();
// $post2->id = 2;
// $post2->user = $userMadmady;
// $post2->title = "Maison";
// $post2->image = 'https://cdn.pixabay.com/photo/2015/03/30/11/01/paintings-698290_960_720.jpg';
// $post2->description = "Illustration done for a client who wanted to use it as gift last month ";
// $post2->posted_time = time();
// $post2->type = $oilPaint;
// $post2->price = "35€";

//Add post3
// $post3 = new Post();
// $post3->id = 3;
// $post3->user = $userMadmady;
// $post3->title = "Music";
// $post3->image = 'https://images-wixmp-ed30a86b8c4ca887773594c2.wixmp.com/f/4cf9906a-ff47-41e0-9b64-a1f1773044a4/d7k903e-55edefc7-e41c-4b6c-9cf5-d27189689301.jpg/v1/fill/w_600,h_450,q_75,strp/music_pulse_by_ritsu_mady_d7k903e-fullview.jpg?token=eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJzdWIiOiJ1cm46YXBwOjdlMGQxODg5ODIyNjQzNzNhNWYwZDQxNWVhMGQyNmUwIiwiaXNzIjoidXJuOmFwcDo3ZTBkMTg4OTgyMjY0MzczYTVmMGQ0MTVlYTBkMjZlMCIsIm9iaiI6W1t7ImhlaWdodCI6Ijw9NDUwIiwicGF0aCI6IlwvZlwvNGNmOTkwNmEtZmY0Ny00MWUwLTliNjQtYTFmMTc3MzA0NGE0XC9kN2s5MDNlLTU1ZWRlZmM3LWU0MWMtNGI2Yy05Y2Y1LWQyNzE4OTY4OTMwMS5qcGciLCJ3aWR0aCI6Ijw9NjAwIn1dXSwiYXVkIjpbInVybjpzZXJ2aWNlOmltYWdlLm9wZXJhdGlvbnMiXX0.V52E3JMtSzFD8fbDNt8csROujc3HNJA4C-p4TTnwzNY';
// $post3->description = "Illustration done for a client who wanted to use it as gift last month ";
// $post3->posted_time = time();
// $post3->type = $digitalArt;
// $post3->price = "15€";

// ... other objects creations
// $items = array($post1, $post2, $post3, $post2, $post1, $post3, $post1, $post2, $post3, $post2, $post1, $post2, $post1, $post2);
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

    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
        <a class="navbar-brand" href="#">Navbar</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
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
                    <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLink" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
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