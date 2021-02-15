<?php
declare(strict_types=1);
require __DIR__ . '/../autoload.php';

// Logic for creating a comment

if (isset($_SESSION['user'])) {
    if (isset($_POST['comment'], $_POST['submit'])) {
        $users_id =  (int)$_SESSION['user']['id'];
        $posts_id = (int)$_POST['post_id'];
        $author = $_SESSION['user']['username'];
        $comment = trim(filter_var($_POST['comment'], FILTER_SANITIZE_STRING));
        $published = date('Y-m-d H.i.s');

        createComment($pdo, $users_id, $posts_id, $author, $comment, $published);
        $_SESSION['msg'] = 'Your comment was successfully published!';
        redirect('../../index.php');
    }
    else {
        $_SESSION['msg'] = 'Something went wrong, please try again!';
         redirect('../../index.php');
    }
}
