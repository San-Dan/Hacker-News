<?php

declare(strict_types=1);

function redirect(string $path)
{
    header("Location: ${path}");
    exit;
}

function validateEmail(string $email): bool
{
    if (filter_var($email, FILTER_VALIDATE_EMAIL)) {
        return true;
    } else {
        return false;
    }
}

function validatePwd(string $pwd, string $pwdRep): bool
{
    if ($pwd === $pwdRep) {
        return true;
    } else {
        return false;
    }
}


// POSTS FUNCTIONS
//----------------------------------
function getTopPosts(PDO $pdo)
{
    $statement = $pdo->prepare('SELECT * FROM posts ORDER BY upvotes DESC'); // ORDER BY upvotes DESC
    $statement->execute();
    $posts = $statement->fetchAll(PDO::FETCH_ASSOC);
    return $posts;
}

function getLatestPosts(PDO $pdo)
{
    $statement = $pdo->prepare('SELECT * FROM posts ORDER BY published DESC'); // ORDER BY published DESC
    $statement->execute();
    $posts = $statement->fetchAll(PDO::FETCH_ASSOC);
    return $posts;
}

function getOnePost(PDO $pdo, int $post_id)
{
    $statement = $pdo->prepare('SELECT * FROM posts WHERE id = :post_id');
    $statement->bindParam(':post_id', $post_id, PDO::PARAM_INT);
    $statement->execute();
    $post = $statement->fetchAll(PDO::FETCH_ASSOC);
    return $post[0];
}

function getUsersPosts(PDO $pdo, int $id, int $posts_id)
{
    $statement = $pdo->prepare('SELECT * FROM posts INNER JOIN users WHERE users_id = :id');
    $statement->execute();
    $posts = $statement->fetch(PDO::FETCH_ASSOC);
    return $posts;
}

function createPost(PDO $pdo, string $title, int $users_id, string $author, string $description, string $link, int $upvotes, string $published)
{
    $statement = $pdo->prepare('INSERT INTO posts (users_id, author, title, description, link, upvotes, published) VALUES (:users_id, :author, :title, :description, :link, :upvotes, :published)');
    $statement->bindParam(':title', $title, PDO::PARAM_STR);
    $statement->bindParam(':users_id', $users_id, PDO::PARAM_INT);
    $statement->bindParam(':author', $author, PDO::PARAM_STR);
    $statement->bindParam(':link', $link, PDO::PARAM_STR);
    $statement->bindParam(':description', $description, PDO::PARAM_STR);
    $statement->bindParam(':upvotes', $upvotes, PDO::PARAM_INT);
    $statement->bindParam(':published', $published, PDO::PARAM_STR);
    $statement->execute();

    $post = $statement->fetchAll(PDO::FETCH_ASSOC);
    return $post[0];
}


// COMMENT FUNCTIONS
//------------------------------------------

function createComment(PDO $pdo, int $users_id, int $posts_id, string $author, string $comment, string $published)
{
    $statement = $pdo->prepare('INSERT INTO comments (users_id, posts_id, author, text, published) VALUES (:users_id, :posts_id, :author, :text, :published)');
    $statement->bindParam(':users_id', $users_id, PDO::PARAM_INT);
    $statement->bindParam(':posts_id', $posts_id, PDO::PARAM_INT);
    $statement->bindParam(':author', $author, PDO::PARAM_STR);
    $statement->bindParam(':text', $comment, PDO::PARAM_STR);
    $statement->bindParam(':published', $published, PDO::PARAM_STR);
    $statement->execute();

    $comment = $statement->fetchAll(PDO::FETCH_ASSOC);
    return $comment[0];
}

function getComments(PDO $pdo, int $post_id)
{
    $statement = $pdo->prepare('SELECT * FROM comments WHERE posts_id = :posts_id ORDER BY published DESC');
    $statement->bindParam(':posts_id', $post_id, PDO::PARAM_INT);
    $statement->execute();

    $comments = $statement->fetchAll(PDO::FETCH_ASSOC);
    return $comments;
}

// USER FUNCTIONS
//----------------------------------
/*function bla() {
    die(var_dump($pdo->errorInfo()));

    $statement->execute();
    $user = $statement->fetch(PDO::FETCH_ASSOC);
    return $user;
} */

function getUserById(PDO $pdo, int $id)
{
    $statement = $pdo->prepare('SELECT * FROM users WHERE id = :id');
    $statement->bindParam(':id', $id, PDO::PARAM_INT);
    $statement->execute();
    $user = $statement->fetch(PDO::FETCH_ASSOC);

    return $user;
}

function userExists(PDO $pdo, string $username, string $email)
{
    $statement = $pdo->prepare('SELECT * FROM users WHERE username = :username OR email = :email');
    $statement->bindParam(':username', $username, PDO::PARAM_STR);
    $statement->bindParam(':email', $email, PDO::PARAM_STR);
    $statement->execute();
    $user = $statement->fetch(PDO::FETCH_ASSOC);

    return $user;
}

function createUser(PDO $pdo, string $name, string $username, string $email, string $pwd)
{
    $statement = $pdo->prepare('INSERT INTO users (name, username, email, pwd) VALUES (:name, :username, :email, :pwd)');
    $hashedPwd = password_hash($pwd, PASSWORD_DEFAULT);

    $statement->bindParam(':name', $name, PDO::PARAM_STR);
    $statement->bindParam(':username', $username, PDO::PARAM_STR);
    $statement->bindParam(':email', $email, PDO::PARAM_STR);
    $statement->bindParam(':pwd', $hashedPwd, PDO::PARAM_STR);
    $statement->execute();
}

function getUsersUpvotes(PDO $pdo, int $post_id, string $username)
{
    $statement = $pdo->prepare('SELECT * FROM upvotes WHERE post_id = :post_id AND liked_by = :username');
    $statement->bindParam(':post_id', $post_id, PDO::PARAM_INT);
    $statement->bindParam(':username', $username, PDO::PARAM_STR);
    $statement->execute();

    $upvotes = $statement->fetch(PDO::FETCH_ASSOC);
    return $upvotes;
}
