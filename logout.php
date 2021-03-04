<?php
if (isset($_COOKIE["username"])) {
    // Remove username cookie by setting an empty value and negative lifetime
    setcookie("username", "", -3600);
    header("location: /todo/");
}
