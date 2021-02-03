<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="/assets/css/global.css">
    <link rel="stylesheet" href="/assets/css/header.css">
    <link rel="stylesheet" href="/assets/css/index.css">
    <link rel="stylesheet" href="/assets/css/footer.css">
    <link rel="stylesheet" href="/assets/css/login.css">
    <link rel="stylesheet" href="/assets/css/profile.css">
    <title>Hacker News</title>
</head>
<body>
    <header>
        <h1><a href="index.php" id="titleLink">.hackernews</a></h1>
        <nav>
            <a href="index.php?=latest">Latest</a>
            <a href="index.php?=votes">Most upvoted</a>

            <?php if (isset($_SESSION['user'])) : ?>
                <a href="createPost.php" class="bold">Create Post</a>
                <a href="profile.php" class="bold">My Profile</a>
                <a href="app/users/logout.php" class="bold">Log Out</a>
            <?php else : ?>
                <a href="login.php" class="bold">Sign Up</a>
                <a href="login.php" class="bold">Sign In</a>
            <?php endif; ?>
        </nav>
    </header>
