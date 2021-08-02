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

        redirect('../../profile.php');
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




/*
function userExists(PDO $pdo, string $username, string $email){
    $statement = $pdo->prepare('SELECT * FROM users WHERE username = :username OR email = :email;');
    $statement->bindParam(':username', $username, PDO::PARAM_STR);
    $statement->bindParam(':email', $email, PDO::PARAM_STR);
    $statement->execute();
    $user = $statement->fetch(PDO::FETCH_ASSOC);

    return $user;
}

if (!userExists($pdo, $username, $email)) {
        $_SESSION['error'] = 'No matching account found, try again!';
        redirect('../../login.php');
    }

$found = userExists($username, $email);
$found = $user
if(iseet($found))

$statement->bindParam(':username', $input, PDO::PARAM_STR);
    $statement->bindParam(':email', $input, PDO::PARAM_STR);
*/
