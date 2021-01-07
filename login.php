<?php
// require __DIR__ . '/folderName/fileName.php';
// require __DIR__ . '//.php';
require __DIR__ . '/app/autoload.php';

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Hacker News - Sign In</title>
</head>
<body>
    <?php require __DIR__ . '/libs/templates/header.php'; ?>

    <h1>Welcome, hackers!</h1>
    <section>
        <h2>Sign in here</h2>
        <form action="app/users/signin.php" method="post">
            <label for="username">Username/Email</label>
            <input type="text" name="name" id="username">

            <label for="password">Password</label>
            <input type="password" name="pwd" id="password">

            <button type="submit" name="submit">SIGN IN</button>
        </form>
        <?php
        if (isset($_GET["error"])) {
            if ($_GET["error"] == "wronglogin") {
                echo "<p>Invalid input. Please, try again!</p>";
            }
        } ?>
    </section>

    <section>
    <h2>Register for the latest hacker news!</h2> <!-- action ska va sidan man skickas till som inloggad? !-->
    <form action="app/users/createAcc.php" method="post">
        <label for="username">Full Name</label>
        <input type="text" name="name" id="fullName">
        <label for="username">Username</label>
        <input type="text" name="uid" placeholder="Username" id="username">
        <label for="email">Email</label>
        <input type="email" name="email" id="email">
        <label for="password">Password</label>
        <input type="password" name="pwd" id="password">
        <label for="password">Repeat Password</label>
        <input type="password" name="pwdRep" id="password">
        <button type="submit" name="submit">SIGN IN</button>
    </form>

    <?php
// Borde kunna ha sep fil med error message och require här?
    if (isset($_GET["error"])) {
        if ($_GET["error"] == "emptyinput") {
            echo "<p>Fill in all fields, please</p>";
        }
        else if ($_GET["error"] == "invalidUid") {
            echo "<p>Your username is invalid</p>";
        }

        else if ($_GET["error"] == "invalidEmail") {
            echo "<p>Your email is invalid</p>";
        }

        else if ($_GET["error"] == "noMatchPwd") {
            echo "<p>Your pwd is invalid</p>";
        }

        else if ($_GET["error"] == "stmtfailure") {
            echo "<p>Oops, sth went wrong, try again!</p>";
        }
        else if ($_GET["error"] == "userExists") {
            echo "<p>Darn! Your username was so cool it's already been taken</p>";
    }
    else if ($_GET["error"] == "none") {
        echo "<p>Yay, you are signed up!</p>";  // Vill skicka till Profile Page
    }
}
?>
    </section>


<?php require __DIR__ . '/libs/templates/footer.php'; ?>
</body>
</html>
