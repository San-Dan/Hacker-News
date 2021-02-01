<?php
declare(strict_types=1);

require __DIR__ . '/../autoload.php';

if (isset($_POST['submit'])) {
    $username = trim(filter_var($_POST['uid'], FILTER_SANITIZE_STRING));
    //$email = filter_var($_POST['email'], FILTER_SANITIZE_EMAIL);
    $pwd = $_POST['pwd'];

    $statement = $pdo->prepare('SELECT * FROM users WHERE username = :username'); // OR email = :email;
    $statement->bindParam(':username', $username, PDO::PARAM_STR);
    //$statement->bindParam(':email', $email, PDO::PARAM_STR);
    $statement->execute();

    $user = $statement->fetch(PDO::FETCH_ASSOC);
    return $user;

    if ($user['username'] && password_verify($pwd, $user['pwd'] === true)) {
        unset($user['pwd']);
        $_SESSION['user'] = $user;

    }
     else if ($user['username'] === false) {
        $_SESSION['error'] = 'No matching account found, try again!';
        redirect('../../login.php');
    }
    else if (password_verify($pwd, $user['pwd'])) {
        $_SESSION['error'] = 'Wrong password, try again!';
        redirect('../../login.php');
    }

    redirect('../../profile.php');
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
*/
