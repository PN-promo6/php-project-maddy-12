<!DOCTYPE html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
    <!-- CSS -->
    <!-- <link rel="stylesheet" href="../css/login.css?time=<?php echo time(); ?>"> -->
    <title>Artists cave</title>
</head>

<body>
    <div class="container">

        <div class="row">

            <div class="col">

                <h1> Add a new post </h1>

                <form class="mt-5" method="$_POST" action="?action=new">
                    <div class="form-group">
                        <label for="image">The URL link of your image</label>
                        <input type="url" class="form-control" name="image" placeholder="Put the link to your illustration here">
                    </div>
                    <div class="form-group">
                        <label for="title">Title</label>
                        <input type="text" class="form-control" name="title" placeholder="Another input placeholder">
                    </div>
                    <div class="form-group">
                        <label for="artist">Artist</label>
                        <input type="text" class="form-control" name="artist" placeholder="Another input placeholder">
                    </div>

                    <div class="form-group">
                        <label for="description">Description</label>
                        <textarea class="form-control" name="description" rows="3"></textarea>
                    </div>

                    <div class="form-group">
                        <label for="price">Price</label>
                        <input type="text" class="form-control" name="price" placeholder="Another input placeholder">
                    </div>
                    <label>Illustration type</label>
                    <select name="type" class="form-control mb-4">
                        <option value="-">Select a type</option>
                        <?php
                        foreach ($types as $oneType) {
                        ?>
                            <option value="<?= $oneType->id ?>" <?= $oneType->name ?>></option>
                        <?php
                        }
                        ?>
                    </select>
                    <div class="form-group ">
                        <input class="btn btn-info" type="submit" value="Submit">
                    </div>
                </form>

            </div>
        </div>
    </div>

</body>

</html>