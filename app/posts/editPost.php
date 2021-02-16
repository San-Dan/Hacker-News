<?php
declare(strict_types=1);
require __DIR__ . '/../autoload.php';

// form action to THIS file in new file editPost.php

$id = (int)$_SESSION['user']['id'];

// posta id i hidden input? eller via ny knapp Edit post?
$posts_id = (int)$_POST['post_id'];
/*
function getUsersPosts(PDO $pdo, int $id, int $posts_id)
{
    $statement = $pdo->prepare('SELECT * FROM posts INNER JOIN users WHERE users_id = :id');
    $statement->execute();
    $posts = $statement->fetch(PDO::FETCH_ASSOC);
    return $posts;
}
*/


if (isset($_SESSION['user'])) {
    if (isset($_POST['title'], $_POST['link'], $_POST['description'])) {
        $title = trim(filter_var($_POST['title'], FILTER_SANITIZE_STRING));
        $link = trim(filter_var($_POST['link'], FILTER_SANITIZE_URL));
        $description = trim(filter_var($_POST['description'], FILTER_SANITIZE_STRING));
        $published = date("Y-m-d H:i:s");


// set as function editPost() instead?
        $statement = $pdo->prepare('UPDATE posts SET (title, description, link, published) VALUES (:title, :description, :link, :published)');
        $statement->bindParam(':title', $title, PDO::PARAM_STR);
        $statement->bindParam(':users_id', $id, PDO::PARAM_INT);
        $statement->bindParam(':link', $link, PDO::PARAM_STR);
        $statement->bindParam(':description', $description, PDO::PARAM_STR);
        $statement->bindParam(':published', $published, PDO::PARAM_STR);
        $statement->execute();
    }

    redirect('../../index.php');
}
