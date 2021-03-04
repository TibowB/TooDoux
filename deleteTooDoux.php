<?php
if (isset($_POST["id"])) {
    try {
        // Replace by your own settings
        $bdd = new PDO('mysql:host=localhost;dbname=toodoux;charset=utf8', 'root', 'root', array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION));
    } catch (Exception $e) {
        die("Erreur : " . $e->getMessage());
    }
    $intId = intval($_POST["id"]);
    $deleteToDo = $bdd->prepare("DELETE from todos WHERE id=?");
    $deleteToDo->execute(array($intId));
    $deleteToDo->closeCursor();
    header("location: /todo/");
}
