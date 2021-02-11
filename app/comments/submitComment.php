<?php
declare(strict_types=1);
require __DIR__ . '/../autoload.php';


// define function createComment in functions.php


    function createComment(PDO $pdo, int $users_id, int $posts_id, string $author, string $comment, string $published) {
        $statement = $pdo->prepare('INSERT INTO comments (users_id, posts_id, author, text, published) VALUES (:posts_id, :users_id, :author, :text, :published)');
        $statement->bindParam(':users_id', $users_id, PDO::PARAM_INT);
        $statement->bindParam(':posts_id', $posts_id, PDO::PARAM_INT);
        $statement->bindParam(':author', $author, PDO::PARAM_STR);
        $statement->bindParam(':text', $comment, PDO::PARAM_STR);
        $statement->bindParam(':date', $published, PDO::PARAM_STR);
        $statement->execute();
    }



// Logic for creating a comment

if (isset($_SESSION['user'])) {
    if (isset($_POST['comment'], $_POST['submit'])) {
        $comment = trim(filter_var($_POST['comment'], FILTER_SANITIZE_STRING));
        $published = date('Y-m-d H.i.s');
        $users_id =  (int)$_SESSION['user']['id'];
        $author = $_SESSION['user']['username'];
        $posts_id = $_POST['post_id']; // ex url: http://localhost:8000/addComment.php?post_id=2

        //die(var_dump((int)$_SESSION['user']['id']));
        //die(var_dump($users_id));
        createComment($pdo, $posts_id, $users_id, $author, $comment, $published);
        redirect('../../index.php');
    }
    else {
         redirect('../../profile.php');
    }
}

