<?php
declare(strict_types=1);
require __DIR__ . '/../autoload.php';


// validate link?

// createPost 

// require THIS file in new file addPost.php? or index.php?

if (isset($_POST['submit'])) {
    $title = $_POST['title'];
    $link = $_POST['link'];
    $description = $_POST['description'];

    createPost($pdo, $title, $link, $description);
}

// define function createPost in functions.php
