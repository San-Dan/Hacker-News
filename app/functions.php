<?php
declare(strict_types=1);
require __DIR__ . 'autoload.php';
// ----------- CREATE A NEW USER --------------
function emptySignupInput($name, $username, $email, $pwd, $pwdRep) {
    $result;
    if (empty($name) || empty($username) || empty($email) || empty($pwd) || empty($pwdRep)) {
        $result = true;
    }
    else {
        $result = false;
    }

    return $result;
}

// Kollar bara giltiga teckan? Kanske kan skippa

function invalidUid($username) {
    $result;
    if (!preg_Match("/^[a-zA-Z0-9]*$/", $username)) {
        $result = true;
    }
    else {
        $result = false;
    }

    return $result;
}

function invalidEmail($email) {
    $result;
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
    $result = true;
    }
    else {
        $result = false;
    }
    return $result;
}

function pwdMatch($pwd, $pwdRep) {
    $result;
    if ($pwd !== $pwdRep) {
    $result = true;
    }
    else {
        $result = false;
    }
    return $result;
 }

// CHECKING IF USER EXISTS IN DB, konvertera till PDO/SQLite (kolla på andras + Nr 24, solution nr 5) Krossing ca fr 1:10:00
 function uidExists($conn, $username, $email) {
     $sql = "SELECT * FROM users WHERE usersUid = ? OR usersEmail =?;";  //((--> (YRGO PDO VERSION?; $statement = $pdo->prepare('SELECT * FROM users WHERE username');)
     $stmt = mysqli_stmt_init($conn);
     if (!mysqli_stmt_prepare($stmt, $sql)) {
         header("location: ../login.php?error=userExists");
    exit();
     }

     mysqli_stmt_bind_param($stmt, "ss", $username);
     mysqli_stmt_execute($stmt);

     $resultData = mysqli_stmt_get_result($stmt);

     if ($row = mysqli_fetch_assoc($resultData)) {
        return $row;
     }
     else {
         $result = false;
         return $result;
     }

     mysqli_stmt_close($stmt);
 }

 function createUser($conn, $name, $username, $email, $pwd) {
     $sql = "INSERT INTO users (alla columns exkl id) VALUES (?, ?, ?, ?)"; //<-- 1st ? per value, alltså name email etc, ? är placeholders
     $stmt = mysqli_stmt_init($conn);
     if (!mysqli_stmt_prepare($stmt, $sql)) {
         header("location: ../login.php?error=stmtfailure");
    exit();
     }

     $hashedPwd = password_hash($pwd, PASSWORD_DEFAULT);

     mysqli_stmt_bind_param($stmt, "ssss", $name, $email, $username, $hashedPwd);
     mysqli_stmt_execute($stmt);
     mysqli_stmt_close($stmt);
     header("location: ../login.php?error=none");  //<-- länka direkt till index istället?
    exit();

 }

// --------- LOGIN A USER --------------

function emptyLoginInput($username, $pwd) {
    $result;
    if (empty($username) || empty($pwd)) {
        $result = true;
    }
    else {
        $result = false;
    }

    return $result;
}
// INTE $CONN, hur blir PDO version?
function loginUser($conn, $username, $pwd) {
    $uidExists = uidExists($conn, $username, $username);

    if ($uidExists === false) {
        header("location: ../../login.php?error=wronglogin");
        exit();
    }
    $pwdHashed = $uidExists["password"];
    $checkPwd = password_verify($pwd, $pwdHashed);

    if ($checkPwd == false) {
        header("location: ../../login.php?error=wronglogin");
        exit();
    }
    else if ($checkPwd == true) {
        session_start();
        $_SESSION["userid"] = $uidExists["id"];
        $_SESSION["useruid"] = $uidExists["username"];
        header("location: ../../index.php");
        exit();
    }
}
