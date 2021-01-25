<?php
declare(strict_types=1);
require __DIR__ . '/../autoload.php';


// require THIS file in new file addComment.php? or index.php?

if (isset($_POST['submit'])) {
    $comment = $_POST['comment'];

    createComment($pdo, $comment);
}

// define function createComment in functions.php
