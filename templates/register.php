<!DOCTYPE html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
    <!-- CSS -->
    <link rel="stylesheet" href="../css/login.css?time=<?php echo time(); ?>">
    <title>Artists cave</title>
</head>

<body class="loginPage">
    <div class="box">
        <h2>Register</h2>
        <form class="form-signin" method="POST" action="/register">
            <?php
            if (isset($errorMsg)) {
                echo "<div class='alert alert-warning' role='alert'>$errorMsg</div>";
            }
            ?>
            <div class="inputBox">
                <input type="email" name="email" placeholder="E-mail" required>
                <label>E-mail</label>
            </div>
            <div class="inputBox">
                <input type="text" name="username" placeholder="Username (4 characters)" required>
                <label>Username</label>
            </div>
            <div class="inputBox">
                <input type="password" name="password" placeholder="Password (8 characters)" required>
                <label>Password</label>
            </div>
            <div class="inputBox">

                <input type="password" name="passwordRetype" placeholder="" required>
                <label>Retype your password:</label>

            </div>
            <input type="submit" name="" value="Submit">
        </form>
    </div>

</body>

</html>