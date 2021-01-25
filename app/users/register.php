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

$statement = $pdo->prepare('SELECT * FROM users WHERE username = :username OR email = :email;');
$statement->bindParam(':username', $username, PDO::PARAM_STR);
$statement->bindParam(':email', $email, PDO::PARAM_STR);
$statement->execute();

$userExist = $statement->fetch(PDO::FETCH_ASSOC);
    if ($userExist === true) {
        $_SESSION['error'] = 'This user already exists, try again!';
        redirect('../login.php');
    }

createUser($pdo, $name, $username, $email, $pwd);


redirect('../../profile.php');
