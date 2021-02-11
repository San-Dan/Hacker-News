<?php
declare(strict_types=1);
require __DIR__ . '/../autoload.php';

// ----------------- ALL PROFILE PAGE LOGIC -----------

if (!isset($_SESSION['user'])) {
    redirect('../../index.php');
}

$id = $_SESSION['user']['id'];
$email = $_SESSION['user']['email'];
$bio = $_SESSION['user']['bio'];

// EDIT BIO AND EMAIL

if (isset($_POST['newBio'], $_POST['submit'])) {
    $newBio = trim(filter_var($_POST['newBio'], FILTER_SANITIZE_STRING));

    $statement = $pdo->prepare('UPDATE users SET bio = :newBio WHERE id = :id);');
    $statement->bindParam(':newBio', $newBio, PDO::PARAM_STR);
    $statement->bindParam(':id', $id, PDO::PARAM_INT);
    $statement->execute();
}

if (isset($_POST['newEmail'], $_POST['submit'])) {
    $email = trim(filter_var($_POST['email'], FILTER_SANITIZE_EMAIL));

    $statement = $pdo->prepare('UPDATE users SET email = :newEmail WHERE id = :id);');
    $statement->bindParam(':newEmail', $newEmail, PDO::PARAM_STR);
    $statement->bindParam(':id', $id, PDO::PARAM_INT);
    $statement->execute();

}


// EDIT AVATAR (NON UNIQUE VALUES), kolla Files lektion


// CHANGE PASSWORD
/* enter old password
enter new password x2
hash new password
update users set pwd where id = :id
