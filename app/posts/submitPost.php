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
        $users_id = (int)$_SESSION['user']['id'];
        $author = $_SESSION['user']['username'];

        createPost($pdo, $title, $users_id, $author, $description, $link, $published);
        $_SESSION['msg'] = 'Your post was successfully published!';
        redirect('../../index.php');
    }
    else {
        $_SESSION['msg'] = 'Something went wrong, please try again!';
         redirect('../../index.php');
    }

}

