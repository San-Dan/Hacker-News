<?php

declare(strict_types=1);

require __DIR__ . '/../autoload.php';

// Create USER - Add: SANITIZE USERNAME OCH EMAIL

if (isset($_POST['submit'])) {
    $name = $_POST['name'];
    $username = $_POST['uid'];
    $email = $_POST['email'];
    $pwd = $_POST['pwd'];
    $pwdRep = $_POST['pwdRep'];

    // VALIDATE + SANITIZE

    if (!isset($name, $username)) {
        $_SESSION['error'] = 'Oops, something is missing! Please check all fields';
        redirect('../login.php');
    }
    if (validateEmail($email) !== true) {
        $_SESSION['error'] = 'Please enter a valid email address.';
        redirect('../login.php');
    }

    if (validatePwd($pwd, $pwdRep) !== true) {
        $_SESSION['error'] = 'Passwords did not match, try again!';
        redirect('../login.php');
    }
}
/*
$statement = $pdo->prepare('SELECT * FROM users WHERE username = :username OR email = :email;');
$statement->bindParam(':username', $username, PDO::PARAM_STR);
$statement->bindParam(':email', $email, PDO::PARAM_STR);
$statement->execute();
// error säger fetch ist för execute om denna rad kommenteras ut
// $statement->execute(['username' => $username, 'email' => $email]);

$userExist = $statement->fetch(PDO::FETCH_ASSOC);
    if ($userExist === true) {
        $_SESSION['error'] = 'This user already exists, try again!';
        redirect('../login.php');
    } */

createUser($pdo, $name, $username, $email, $pwd);






/* ERROR MESSAGES (låg först i html)
if (isset($_SESSION["error"])) {
    if ($_SESSION["error"] == "emptyinput") {
        echo $_SESSION["error"];
    } else if ($_SESSION["error"] == "invalidUid") {
        echo      $_SESSION["error"];
    } else if ($_SESSION["error"] == "invalidEmail") {
        echo $_SESSION["error"];
    } else if ($_SESSION["error"] == "noMatchPwd") {
        echo $_SESSION["error"];
    } else if ($_SESSION["error"] == "stmtfailure") {
        echo $_SESSION["error"];
    } else if ($_SESSION["error"] == "userExists") {
        echo $_SESSION["error"];
    } else if ($_SESSION["error"] == "none") {
        echo 'Registration successful!';  // Vill skicka till Profile Page
    }
}

$message = $_SESSION['message'] ?? '';
unset($_SESSION['message']);

$authenticated = $_SESSION['authenticated'] ?? false;
*/
/*if ( !== false) {
        $_SESSION['error'] = 'This user already exists, try again!';
        redirect('../login.php');
    }*/
