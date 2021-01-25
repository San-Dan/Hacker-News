<?php
declare(strict_types=1);

require __DIR__ . '/../autoload.php';

// getUser: måste definiera $user här, alltså hämta info via query

$authenticated = $_SESSION['authenticated'] ?? false;

if (!$authenticated && isset($_POST['email'], $_POST['pwd'])) {
    $email = trim(filter_var($_POST['email'], FILTER_SANITIZE_EMAIL));
    $password = htmlentities($_POST['pwd']);

    if ($email === $user['email'] && password_verify($password, $user['pwd'])) {
        $_SESSION['message'] = 'You\'ve successfully logged in ' . $user['name'] . '!';
        $_SESSION['authenticated'] = true;
    } else {
        $_SESSION['message'] = 'Whoops! Looks like you missed something. Please try again.';
    }
}

// password_verify — Verifies that a password matches a hash
//password_verify ( string $password , string $hash ) : bool




// LOGIN A USER
/*function loginUser(string $username, string $pwd) {         // Gör PDO version
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
        //session_start();
        $_SESSION["userid"] = $uidExists["id"];
        $_SESSION["useruid"] = $uidExists["username"];
        redirect('../index.php?userId=');
    }
}

if (isset($_POST["submit"])) {
    $username = $_POST["uid"];
    $pwd = $_POST["pwd"];

    loginUser($username, $pwd);

    if (emptyLoginInput($username, $pwd) !== false) {
        redirect('../login.php?error=emptyinput');
    }


}
else {
    redirect('/../../login.php');
}

/* Check for missing input fields
function emptyLoginInput(string $username, string $pwd) : bool {
    if (empty($username) || empty($pwd)) {
        return true;
    }
    else {
        return false;
    }
} */
