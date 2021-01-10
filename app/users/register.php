<?php
declare(strict_types=1);

require __DIR__ . '/../autoload.php';
require __DIR__ . '/../functions.php';

if (isset($_POST['submit'])) {
    $name = $_POST['name'];
    $username = $_POST['uid'];
    $email = $_POST['email'];
    $pwd = $_POST['pwd']; 
    $pwdRep = $_POST['pwdRep'];

    createUser($pdo, $name, $username, $email, $pwd);


    if (emptySignupInput($name, $username, $email, $pwd, $pwdRep) !== false) {
        redirect('../login.php?error=emptyinput');
    }

    if (validateEmail($email) !== false) {
        redirect('../login.php?error=invalidEmail');
    }

    if (pwdMatch($pwd, $pwdRep) !== false) {
        redirect('../login.php?error=noMatchPwd');
    }

    if (userExists($pdo, $username, $email) !== false) {
        redirect('../login.php?error=userExists');
    }

}

else {
    redirect('../login.php');
}

