<!doctype html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
    <!-- CSS -->
    <link rel="stylesheet" href="../css/style.css?time=<?php echo time(); ?>">
    <title>Artists cave</title>
</head>

<body>
    <header>
        <nav class="navbar navbar-expand-lg navbar-dark bg-dark d-flex justify-content-between">
            <a class="navbar-brand" href="#">Artists cave</a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse d-flex justify-content-between" id="navbarNavDropdown">
                <ul class="navbar-nav">
                    <li class="nav-item">
                        <form class="nav-link" method="get">
                            <input name="search" type="text"></input>
                        </form>
                    </li>
                    <!-- ******************LOGIN & LOGOUT************************ -->
                    <?php
                    // If the user is logged in -> hide "login" and"sign up" = show "logout"
                    if (isset($_SESSION['user'])) {
                    ?>
                        <li class="nav-item">
                            <a class="nav-link" href="/logout" role="button">Logout</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link " href="/new" role="button">+</a>
                        </li>
                    <?php
                        //If not logged in -> show the login & suign up buttons
                    } else {
                    ?>
                        <li class="nav-item">
                            <a class="nav-link" href="/login" role="button">Login</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="/register" role="button">Register</a>

                        </li>
                    <?php  } ?>

                </ul>

            </div>
        </nav>
        <!-- <img src="https://images-wixmp-ed30a86b8c4ca887773594c2.wixmp.com/f/a060e017-039d-4cad-b3dc-b33dbdaf563d/d4mjtv0-7e2cf1f4-ffb4-4e08-b41c-fe84c0564aa7.jpg/v1/fill/w_1024,h_639,q_75,strp/cave_by_zoriy_d4mjtv0-fullview.jpg?token=eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJzdWIiOiJ1cm46YXBwOiIsImlzcyI6InVybjphcHA6Iiwib2JqIjpbW3siaGVpZ2h0IjoiPD02MzkiLCJwYXRoIjoiXC9mXC9hMDYwZTAxNy0wMzlkLTRjYWQtYjNkYy1iMzNkYmRhZjU2M2RcL2Q0bWp0djAtN2UyY2YxZjQtZmZiNC00ZTA4LWI0MWMtZmU4NGMwNTY0YWE3LmpwZyIsIndpZHRoIjoiPD0xMDI0In1dXSwiYXVkIjpbInVybjpzZXJ2aWNlOmltYWdlLm9wZXJhdGlvbnMiXX0.OnMGT_RJN-KAk89_owGx3Hq49P0BZLQkZKJrkmpoVnE" alt=""> -->

    </header>
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

                                    <li>Artist : <a href="?search=@<?php echo $item->user->nickname; ?>" class="card-text">@<?php echo $item->user->nickname; ?></a></li>
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