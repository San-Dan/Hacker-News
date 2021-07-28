<?php

declare(strict_types=1);
require __DIR__ . '/../autoload.php';

// Logic for updating a comment

if (isset($_SESSION['user'])) {
    if (isset($_POST['edit'])) {

        // posta id i hidden input, för att kunna länka vidare efter success?

        //$post_id = (int)$_POST['post_id'];
        $comment_id = (int)$_POST['comment_id'];
        $comment = trim(filter_var($_POST['comment'], FILTER_SANITIZE_STRING));

        $statement = $pdo->prepare('UPDATE comments SET text = :comment WHERE id = :comment_id');
        $statement->bindParam(':comment_id', $comment_id, PDO::PARAM_INT);
        $statement->bindParam(':comment', $comment, PDO::PARAM_STR);
        $statement->execute();

        // kan nedan rader ligga här eller 1 st per inre if-sats ovan?
        $_SESSION['msg'] = 'Your comment was successfully updated!';
        redirect('../../index.php'); // leda till singlePost.php?post=<?= $post_id endphp> ist för index.php
    } else {
        $_SESSION['msg'] = 'Something went wrong, please try again!';
        redirect('../../index.php'); 
    }
}
