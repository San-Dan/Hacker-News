<?php

declare(strict_types=1);

require __DIR__ . '/../autoload.php';

// Create USER

if (isset($_POST['submit'])) {
    $name = $_POST['name'];
    $username = trim(filter_var($_POST['uid'], FILTER_SANITIZE_STRING));
    $email = trim(filter_var($_POST['email'], FILTER_SANITIZE_EMAIL));
    $pwd = $_POST['pwd'];
    $pwdRep = $_POST['pwdRep'];
    $bio = "Add some personal info here";
    $profileImg = "defaultprofile.jpg";

    // VALIDATE + SANITIZE

    if (!isset($name, $username)) {
        $_SESSION['error'] = 'Oops, something is missing! Please check all fields';
        redirect('../../login.php');
    }
    if (!validateEmail($email)) {
        $_SESSION['error'] = 'Please enter a valid email address.';
        redirect('../../login.php');
    }

    if (!validatePwd($pwd, $pwdRep)) {
        $_SESSION['error'] = 'Passwords did not match, try again!';
        redirect('../../login.php');
    }
}


if (userExists($pdo, $username, $email)) {
    $_SESSION['error'] = 'This user already exists, try again!';
    redirect('../../login.php');
} else {
    createUser($pdo, $name, $username, $email, $pwd, $bio, $profileImg);
    //echo die(var_dump($user['id']));  Error: undefined variable $user + trying to access array offset on value of type null
    unset($user['pwd']);
    // $_SESSION['user'] = [
    //     'username' => $user['username'],
    //     'profileimg' => $user['profileimg'],
    //     'email' => $user['email'],
    //     'bio' => $user['bio'],
    //     'id' => $user['id']
    // ];
    $_SESSION['msg'] = 'Your account was created. Please sign in';
    redirect('../../login.php');
}
