<?php

declare(strict_types=1);

require __DIR__ . '/../autoload.php';

if (!isset($_SESSION['user'])) {
    redirect('../../index.php');
}

$id = (int)$_SESSION['user']['id'];
$user = getUserById($pdo, $id);

// CHANGE PASSWORD

if (isset($_POST['oldPwd'], $_POST['newPwd'], $_POST['newPwdRep'])) {
    $oldPwd = $_POST['oldPwd'];
    $pwd = $_POST['newPwd'];
    $pwdRep = $_POST['newPwdRep'];

    (int)$newPwd = validatePwd($pwd, $pwdRep);

    if (!$newPwd) {
        $_SESSION['error'] = 'New password did not match, try again!';
        redirect('../../editProfile.php');
    } else {
        $hashedPwd = password_hash($pwd, PASSWORD_DEFAULT);
    }

    $statement = $pdo->prepare('UPDATE users SET pwd = :newPwd WHERE id = :id');
    $statement->bindParam(':newPwd', $hashedPwd, PDO::PARAM_STR);
    $statement->bindParam(':id', $id, PDO::PARAM_INT);
    $statement->execute();

    $_SESSION['msg'] = 'Your password was updated!';
    redirect('../../profile.php');
}
