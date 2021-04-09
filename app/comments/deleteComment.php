<?php
declare(strict_types=1);
require __DIR__ . '/../autoload.php';

if (isset($_SESSION['user'])) {
    if (isset($_POST['delete'])) {
        $comment_id = (int)$_POST['comment_id'];

        $statement = $pdo->prepare('DELETE FROM comments WHERE id = :comment_id');
        $statement->bindParam(':comment_id', $comment_id, PDO::PARAM_INT);
        $statement->execute();
    }
        $_SESSION['msg'] = 'Your comment was deleted!';
        redirect('../../index.php');
}
