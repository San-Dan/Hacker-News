<?php
require __DIR__ . '/../../app/autoload.php';
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Hacker News</title>
</head>
<body>
    <header>
        <h1>Hacker News</h1>
        <nav>
            <a href="login.php">Latest</a>
            <a href="login.php">Most upvoted</a>
            <a href="login.php">About</a>
            <?php
                if (isset($_SESSION["useruid"])) {
                    echo "<a href="profile.php">My Profile</a>"; // Ingen html i php ju?? Ha två index-sidor, en med och en utan session?
                    echo "<a href="/../../app/users/logout.php">Sign Out</a>";
                }
                else {
                    echo "<a href="login.php">Sign Up</a>";
                    echo "<a href="login.php">Sign In</a>";
                }
            ?>
            <a href="login.php">Sign Up</a>
            <a href="login.php">Sign In</a>

        </nav>
    </header>
