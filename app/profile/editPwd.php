<?php

declare(strict_types=1);

require __DIR__ . '/../../autoload.php';

if (!isset($_SESSION['user'])) {
    redirect('../../index.php');
}

$id = (int)$_SESSION['user']['id'];
$user = getUserById($pdo, $id);

// CHANGE PASSWORD
/* enter old password
enter new password x2
hash new password
update users set pwd where id = :id */


if (isset($_POST['oldPwd'], $_POST['newPwd'], $_POST['newPwdRep'])) {
    $oldPwd = $_POST['oldPwd'];
    $pwd = $_POST['newPwd'];
    $pwdRep = $_POST['newPwdRep'];

    if (!validatePwd($pwd, $pwdRep)) {
        $_SESSION['error'] = 'New password did not match, try again!';
        redirect('../../editProfile.php');
    } else {
        $hashedPwd = password_hash($pwd, PASSWORD_DEFAULT);
    }
}
