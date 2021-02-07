<?php
declare(strict_types=1);
require __DIR__ . '/../autoload.php';

// Logic for creating a post

if (isset($_SESSION['user'])) {
    if (isset($_POST['title'], $_POST['link'], $_POST['info'])) {
        $title = trim(filter_var($_POST['title'], FILTER_SANITIZE_STRING));
        $link = trim(filter_var($_POST['link'], FILTER_SANITIZE_URL));
        $description = trim(filter_var($_POST['info'], FILTER_SANITIZE_STRING));
        $published = date("Y-m-d H:i:s");
        $id = $_SESSION['user']['id'];
        $author = $_SESSION['user']['username'];


// set as function createPost() instead?
        $statement = $pdo->prepare('INSERT INTO posts (users_id, author, title, description, link, published) VALUES (:users_id, :author, :title, :description, :link, :published)');
        $statement->bindParam(':title', $title, PDO::PARAM_STR);
        $statement->bindParam(':users_id', $id, PDO::PARAM_INT);
        $statement->bindParam(':author', $author, PDO::PARAM_STR);
        $statement->bindParam(':link', $link, PDO::PARAM_STR);
        $statement->bindParam(':description', $description, PDO::PARAM_STR);
        $statement->bindParam(':published', $published, PDO::PARAM_STR);
        $statement->execute();
    }

    redirect('../../index.php');
}
