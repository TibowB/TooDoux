<?php


// If username is defined, redirect to the index page
if (isset($_COOKIE["username"])) {
    header("location: /todo/");
}



?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./public/css/style.css">
    <title>TooDoux</title>
</head>

<body>

    <form class="login-form" action="index.php" method="POST">
        <label for="username">Your name</label>
        <input type="text" name="username">
        <input type="submit" value="Login">
    </form>



</body>

</html>