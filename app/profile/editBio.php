<?php

declare(strict_types=1);
require __DIR__ . '/../autoload.php';

// ----------------- ALL PROFILE PAGE LOGIC -----------

if (isset($_SESSION['user'])) {
    // EDIT BIO
    if (isset($_POST['newBio'])) {
        $newBio = trim(filter_var($_POST['newBio'], FILTER_SANITIZE_STRING));
        $id = (int)$_SESSION['user']['id'];

        $statement = $pdo->prepare('UPDATE users SET bio = :newBio WHERE id = :id');
        $statement->bindParam(':newBio', $newBio, PDO::PARAM_STR);
        $statement->bindParam(':id', $id, PDO::PARAM_INT);
        $statement->execute();

        $_SESSION['msg'] = 'Your profile info was updated!';
        redirect('../../profile.php');
    } else {
        redirect('../../index.php');
    }
}
