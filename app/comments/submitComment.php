<?php
declare(strict_types=1);
require __DIR__ . '/../autoload.php';

if (isset($_SESSION['user'])) {
    if (isset($_POST['submit'])) {      // click button
        $comment = trim(filter_var($_POST['comment'], FILTER_SANITIZE_STRING));   // added text
        $date = date('Y-m-d H.i');

        createComment($pdo, $comment, $post_id, $users_id, $date);
    }
    else {
         $_SESSION['error'] = 'You must be logged in to comment';
    }
}

// require THIS file in new file addComment.php? or index.php?



// define function createComment in functions.php

// how get the post _id?

echo $_SESSION['error'];
            unset($_SESSION['error']);
