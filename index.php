<?php
session_start();
// POST method from login page, set cookie for username and id.
if (isset($_POST["username"])) {
    $username = htmlspecialchars($_POST["username"]);
    setcookie("username", $username, time() + 365 * 24 * 3600, null, null, false, true);
    header("location: /todo/");
}
// If username is not defined, redirect to the login page
elseif (!isset($_COOKIE["username"])) {
    header("location: /todo/login.php");
}

if (isset($_POST["todo"]) && $_POST["todo"] != "") {
    try {
        // Replace by your own settings
        $bdd = new PDO('mysql:host=localhost;dbname=toodoux;charset=utf8', 'root', 'root', array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION));
    } catch (Exception $e) {
        die("Erreur : " . $e->getMessage());
    }
    $todo = htmlspecialchars($_POST["todo"]);
    $todoRequest = $bdd->prepare('INSERT INTO todos(username, todo) VALUES (?, ?)');
    $todoRequest->execute(array($_COOKIE["username"], $_POST["todo"]));
    $todoRequest->closeCursor();
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
    <div class="navbar">
        <h1>TooDoux</h1>
        <span>
            <p>Hello <?php echo $_COOKIE["username"] ?></p>
            <a href="./logout.php">Logout</a>
        </span>

    </div>

    <div class="todos">
        <h3>My Too Doux</h3>
        <div class="todos__new">
            <form action="./index.php" method="POST">
                <label class="todos__new--label" for="todo">New Too Doux</label>
                <input class="todos__new--input" type="text" name="todo">
                <input class="todos__new--submit" type="submit" value="Add" hidden>
            </form>
            <?php if (isset($_POST["todo"]) && $_POST["todo"] == "") {
            ?>
                <p>You can't add an empty Too Doux.</p>
            <?php
            } ?>
            <!-- <i class="fas fa-plus"></i> -->
        </div>

        <?php
        try {
            // Replace by your own settings
            $bdd = new PDO('mysql:host=localhost;dbname=toodoux;charset=utf8', 'root', 'root', array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION));
        } catch (Exception $e) {
            die("Erreur : " . $e->getMessage());
        }

        $todos = $bdd->prepare('SELECT id, todo FROM todos WHERE username=?; ORDER BY id');
        $todos->execute(array($_COOKIE["username"]));
        //  WHERE username=' . $_COOKIE["username"]
        while ($data = $todos->fetch()) {
        ?>
            <div class="todos__single">
                <p data-id=""><?php echo $data["todo"] ?></p>
                <form action="./deleteTooDoux.php" method="POST">
                    <input type="text" value="<?php echo $data["id"] ?>" name="id" hidden>
                    <input type="submit" value="Delete">
                </form>

            </div>
        <?php
        }
        $todos->closeCursor();
        ?>

    </div>





</body>


</html>