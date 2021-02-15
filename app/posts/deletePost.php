<?php
declare(strict_types=1);
require __DIR__ . '/../autoload.php';

$id = (int)$_SESSION['user']['id'];

// posta id i hidden input? eller via ny knapp Edit post?
$posts_id = (int)$_POST['post_id'];
/*
function getUsersPosts(PDO $pdo, int $id, int $posts_id)
{
    $statement = $pdo->prepare('SELECT * FROM posts INNER JOIN users WHERE users_id = :id');
    $statement->execute();
    $posts = $statement->fetch(PDO::FETCH_ASSOC);
    return $posts;
}
*/
