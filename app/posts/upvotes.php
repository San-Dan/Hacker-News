<?php
declare(strict_types=1);

require __DIR__ . '/../autoload.php';



// ------------------ UPVOTES ------------
// add upvote

function addUpvote($_POST) {

$counter = $_POST['submit'] ?? 0;

$_POST['counter'] = ++$counter;

echo 'Number of upvotes: ' . $_POST['counter'];
}
// delete upvote
