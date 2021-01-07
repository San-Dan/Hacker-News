<?php
declare(strict_types=1);

require __DIR__ . '/../autoload.php';

if (isset($_POST["submit"])) {
    $username = $_POST["uid"];
    $pwd = $_POST["pwd"];


    if (emptyLoginInput($username, $pwd) !== false) {
        header("location: ../login.php?error=emptyinput");
        exit();
    }

    loginUser($conn, $username, $pwd);
}
else {
    header("location: ../../login.php");
        exit();
}
