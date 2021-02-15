<?php

declare(strict_types=1);

require __DIR__ . '/app/autoload.php';
require __DIR__ . '/views/header.php';

$id = (int)$_SESSION['user']['id'];
$user = getUserById($pdo, $id);

// EDIT EMAIL if user is logged in
if (isset($_SESSION['user'])) {
  if (isset($_POST['newEmail'])) {
    $newEmail = trim(filter_var($_POST['newEmail'], FILTER_SANITIZE_EMAIL));
    $id = (int)$_SESSION['user']['id'];

    $statement = $pdo->prepare('UPDATE users SET email = :newEmail WHERE id = :id');
    $statement->bindParam(':newEmail', $newEmail, PDO::PARAM_STR);
    $statement->bindParam(':id', $id, PDO::PARAM_INT);
    $statement->execute();

    $_SESSION['msg'] = 'Your email was updated!';
    redirect('../../profile.php');
  } else {
    redirect('../../index.php');
  }
}
