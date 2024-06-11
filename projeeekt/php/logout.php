<?php if (isset($_COOKIE["nick"]) != null) {
    unset($_COOKIE["nick"]);
    setcookie("nick", "", time() - 9999, "/");
} ?>

Wylogowano!
<a href="./index.php">Powróć na stronę</a>