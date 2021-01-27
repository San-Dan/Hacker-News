<?php
declare(strict_types=1);

require __DIR__ . '/../autoload.php';

if (isset($_POST['submit'])) {
    $username = trim(filter_var($_POST['uid'], FILTER_SANITIZE_STRING));
    $email = filter_var($_POST['email'], FILTER_SANITIZE_EMAIL);
    $pwd = $_POST['pwd'];

    if (!userExists($pdo, $username, $email)) {
        $_SESSION['error'] = 'No matching account found, try again!';
        redirect('../../login.php');
    }

    if (password_verify($pwd, $user['pwd']) !== true) {
        $_SESSION['error'] = 'Wrong password, try again!';
        redirect('../../login.php');
    } else {
        unset($user['pwd']);
        $_SESSION['user'] = $user;
    }
}

redirect('../../profile.php');
