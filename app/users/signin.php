<?php
declare(strict_types=1);

require __DIR__ . '/../autoload.php'; 
require __DIR__ . '/../functions.php';

if (isset($_POST["submit"])) {
    $username = $_POST["uid"];
    $pwd = $_POST["pwd"];

    loginUser($username, $pwd);

    if (emptyLoginInput($username, $pwd) !== false) {
        redirect('../login.php?error=emptyinput');
    }


}
else {
    redirect('/../../login.php');
}
