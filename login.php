<?php
require __DIR__ . '/app/autoload.php';
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>.hackernews - Sign In</title>
</head>

<body>
    <?php require __DIR__ . '/views/header.php'; ?>
    <main class="loginMain">
        <h1>Welcome, hackers!</h1>
        <p><?php if (isset($_SESSION['msg'])) {
                echo $_SESSION['msg'];
                unset($_SESSION['msg']);
            }; ?></p>
        <section class="signinForm formContainer">
            <h2 class="loginHeading">Sign in here</h2>
            <p><?php if (isset($_SESSION['error'])) {
                    echo $_SESSION['error'];
                    unset($_SESSION['error']);
                }; ?></p>
            <form action="app/users/signin.php" method="post">
                <label for="username">Username</label>
                <input type="text" name="uid" placeholder="..." required>
                <label for="password">Password</label>
                <input type="password" name="pwd" placeholder="..." required> <!-- id="password" id="username" -->
                <button type="submit" name="submit">SIGN IN</button>
            </form>
        </section>

        <section class="registerForm">
            <h2 class="loginHeading">Register for the latest hacker news!</h2>
            <p><?php if (isset($_SESSION['error'])) {
                    echo $_SESSION['error'];
                    unset($_SESSION['error']);
                }; ?></p>
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
        </section>
    </main>

    <?php require __DIR__ . '/views/footer.php'; ?>
