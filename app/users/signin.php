<?php

declare(strict_types=1);

require __DIR__ . '/../autoload.php';

if (isset($_POST['submit'])) {
    $username = trim(filter_var($_POST['uid'], FILTER_SANITIZE_STRING));
    $pwd = $_POST['pwd'];

    $statement = $pdo->prepare('SELECT * FROM users WHERE username = :username');
    $statement->bindParam(':username', $username, PDO::PARAM_STR);
    $statement->execute();

    $user = $statement->fetch(PDO::FETCH_ASSOC);

    if ($user['username'] && password_verify($pwd, $user['pwd'])) {
        unset($user['pwd']);

        $_SESSION['user'] = [
            'username' => $user['username'],
            'profileimg' => $user['profileimg'],
            'email' => $user['email'],
            'bio' => $user['bio'],
            'id' => $user['id']
        ];

        $_SESSION['msg'] = 'Welcome back, ' . $user['username'] . '!';
        redirect('../../index.php');
    }
    if (!isset($user['username'])) {
        $_SESSION['error'] = 'No matching account found, try again!';
        redirect('../../login.php');
    }
    if (password_verify($pwd, $user['pwd'])) {
        $_SESSION['error'] = 'Wrong password, try again!';
        redirect('../../login.php');
    }
}
