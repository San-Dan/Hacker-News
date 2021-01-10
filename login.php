<?php
// require __DIR__ . '/folderName/fileName.php';
// require __DIR__ . '//.php';
require __DIR__ . '/app/autoload.php';
require __DIR__ . '/app/functions.php';
require __DIR__ . '/app/users/register.php';
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>.hackernews - Sign In</title>
</head>
<body>
    <?php require __DIR__ . '/libs/templates/header.php'; ?>
    <main class="loginMain">
    <h1>Welcome, hackers!</h1>
    <section class="signinForm formContainer">
        <h2>Sign in here</h2>
        <form action="app/users/signin.php" method="post">
            <label for="username">Username/Email</label>
            <input type="text" name="name" placeholder="..." id="username" required>
            <label for="password">Password</label>
            <input type="password" name="pwd" placeholder="..." id="password" required>
            <button type="submit" name="submit">SIGN IN</button>
        </form>
        <div class=errorMsgBox>
            <p>
        <?php
        if (isset($_SESSION["error"])) {
            if ($_SESSION["error"] == "wronglogin") {
                echo $_SESSION["error"];
            }
        } ?>
            </p>
        </div>
    </section>

    <section class="registerForm">
    <h2>Register for the latest hacker news!</h2> <!-- action ska va sidan man skickas till som inloggad? eller dit dtan skickas = db? !-->
    <form action="app/users/register.php" method="post" class="formContainer">
        <label for="fullName">Full Name</label>
        <input type="text" name="name" placeholder="..." id="fullName" required>
        <label for="username">Username</label>
        <input type="text" name="uid" placeholder="..." id="username" required>
        <label for="email">Email</label>
        <input type="email" name="email" placeholder="..." id="email" required>
        <label for="password">Password</label>
        <input type="password" name="pwd" placeholder="..." id="password" required>
        <label for="password">Repeat Password</label>
        <input type="password" name="pwdRep" placeholder="..." id="password" required>
        <button type="submit" name="submit">SIGN UP</button>
    </form>
    <div class="errorMsgBox"> <!-- display:none until error is triggered -->
        <p>
            <?php // Borde kunna ha sep fil med error message och require här?
            if (isset($_SESSION["error"])) {
                if ($_SESSION["error"] == "emptyinput") {
                    echo $_SESSION["error"];
                }
                else if ($_SESSION["error"] == "invalidUid") {
                    echo $_SESSION["error"];
                }

                else if ($_SESSION["error"] == "invalidEmail") {
                    echo $_SESSION["error"];
                }

                else if ($_SESSION["error"] == "noMatchPwd") {
                    echo $_SESSION["error"];
                }

                else if ($_SESSION["error"] == "stmtfailure") {
                    echo $_SESSION["error"];
                }
                else if ($_SESSION["error"] == "userExists") {
                    echo $_SESSION["error"];
            }
            else if ($_SESSION["error"] == "none") {
                echo 'Registration successful!';  // Vill skicka till Profile Page
            }
        }
        ?>
        </p>
    </div>
    </section>
    </main>

<?php require __DIR__ . '/libs/templates/footer.php'; ?>
</body>
</html>
