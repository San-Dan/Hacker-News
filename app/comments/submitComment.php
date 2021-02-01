<?php
declare(strict_types=1);
require __DIR__ . '/../autoload.php';

if (isset($_SESSION['user'])) {


}

// require THIS file in new file addComment.php? or index.php?

if (isset($_POST['submit'])) {      // click button
    $comment = trim(filter_var($_POST['comment'], FILTER_SANITIZE_STRING));   // added text
    $date = date('Y-m-d H.i');

    createComment($pdo, $comment, $post_id, $users_id, $date);
}

// define function createComment in functions.php

// how get the post _id?
