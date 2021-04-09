<?php
declare(strict_types=1);
require __DIR__ . '/../autoload.php';

if (isset($_SESSION['user'])) {
    if (isset($_POST['delete'])) {
        $post_id = (int)$_POST['post_id'];

        $statement = $pdo->prepare('DELETE FROM posts WHERE id = :post_id');
        $statement->bindParam(':post_id', $post_id, PDO::PARAM_INT);
        $statement->execute();
    }
        $_SESSION['msg'] = 'Your post was deleted!';
        redirect('../../index.php');
}
