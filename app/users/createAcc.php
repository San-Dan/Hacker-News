<?php
declare(strict_types=1);

require __DIR__ . '../autoload.php';

if (isset($_POST["submit"])) {
    $name = $_POST["name"];
    $username = $_POST["uid"];
    $email = $_POST["email"];
    $pwd = $_POST["pwd"];
    $pwdRep = $_POST["pwdRep"];


if (emptySignupInput($name, $username, $email, $pwd, $pwdRep) !== false) {
    header("location: ../login.php?error=emptyinput");
    exit();
}

if (invalidUid($username) !== false) {
    header("location: ../login.php?error=einvalidUid");
    exit();
}

if (invalidEmail($email) !== false) {
    header("location: ../login.php?error=invalidEmail");
    exit();
}

if (pwdMatch($pwd, $pwdRep) !== false) {
    header("location: ../login.php?error=noMatchPwd");
    exit();
}

/* INTE SÅHÄR FÖR MIG, bara byta ut $conn?
if (uidExists($conn, $username) !== false) {
    header("location: ../login.php?error=userExists");
    exit();
} */

createAccount($name, $username, $email, $pwd);
}

else {
    header("location: ../login.php");
}

