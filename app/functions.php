<?php
declare(strict_types=1);
require __DIR__ . '/autoload.php';

function redirect(string $path) {
    header("Location: ${path}");
    exit;
}

// ----------- VALIDATING & CHECKING INPUTS --------------
function emptySignupInput($name, $username, $email, $pwd, $pwdRep) : bool {
    if (empty($name) || empty($username) || empty($email) || empty($pwd) || empty($pwdRep)) {
        return true;
    }
    else {
        return false;
    }
}

function validateEmail(string $email) : bool {
    if (filter_var($email, FILTER_VALIDATE_EMAIL)) {
    return true;
    }
    else {
        return false;
    }
}

function pwdMatch(string $pwd, string $pwdRep) : bool {
    if ($pwd !== $pwdRep) {
    return true;
    }
    else {
        return false;
    }
 }

// CHECKING IF USER EXISTS IN DB
 function userExists(PDO $pdo, string $username, string $email) {
    $statement = $pdo->prepare('SELECT * FROM users WHERE username = :username OR email = :email;');
    $user = $statement->fetch(PDO::FETCH_ASSOC);

    return $user;
    }

// Create USER - Add: SANITIZE USERNAME OCH EMAIL
 function createUser(PDO $pdo, string $name, string $username, string $email, string $pwd) {
    $insert = 'INSERT INTO users(name, username, email, password) VALUES(:name, :username, :email)';
    $statement = $pdo->prepare($insert);
    $hashedPwd = password_hash($pwd, PASSWORD_DEFAULT);

    if (!userExists($pdo, $username, $email)) {

        if (!$statement) {
            die(var_dump($pdo->errorInfo()));
        }
        $statement->bindParam(':name', $name, PDO::PARAM_STR);
        $statement->bindParam(':username', $username, PDO::PARAM_STR);
        $statement->bindParam(':email', $email, PDO::PARAM_STR);
        $statement->bindParam(':password', $hashedPwd, PDO::PARAM_STR);
        $statement->execute();

        redirect('../profile.php');
    }
}

// --------- LOGIN A USER --------------
function emptyLoginInput(string $username, string $pwd) : bool {
    if (empty($username) || empty($pwd)) {
        return true;
    }
    else {
        return false;
    }
}

// Gör PDO version
function loginUser(string $username, string $pwd) {
    $uidExists = userExists($pdo, $username, $username);

    if ($uidExists === false) {
        redirect('../../login.php?error=wronglogin');
    }
    $pwdHashed = $uidExists["password"]; // Vad händer här..?
    $checkPwd = password_verify($pwd, $pwdHashed);

    if ($checkPwd == false) {
        redirect('../../login.php?error=wronglogin');
    }
    else if ($checkPwd == true) {
        session_start();
        $_SESSION["userid"] = $uidExists["id"];
        $_SESSION["useruid"] = $uidExists["username"];
        redirect('../index.php?userId=');
    }
}
