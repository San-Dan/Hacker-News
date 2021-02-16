<?php

declare(strict_types=1);

require __DIR__ . '/../autoload.php';

$id = (int)$_SESSION['user']['id'];
$user = getUserById($pdo, $id);

//var_dump($id);

// EDIT EMAIL if user is logged in
if (isset($_SESSION['user'])) {
  if (isset($_POST['newEmail'])) {
    $email = trim(filter_var($_POST['newEmail'], FILTER_SANITIZE_EMAIL));
    $id = (int)$_SESSION['user']['id'];

    if (validateEmail($email) !== true) {
        $_SESSION['error'] = 'Please enter a valid email address.';
        redirect('../login.php');
    }

    $statement = $pdo->prepare('UPDATE users SET email = :newEmail WHERE id = :id');
    $statement->bindParam(':newEmail', $email, PDO::PARAM_STR);
    $statement->bindParam(':id', $id, PDO::PARAM_INT);
    $statement->execute();

    $_SESSION['msg'] = 'Your email was updated!';
    redirect('../../profile.php');
  } else {
    redirect('../../index.php');
  }
}
