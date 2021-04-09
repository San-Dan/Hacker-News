<?php
declare(strict_types=1);
require __DIR__ . '/../autoload.php';


if (isset($_SESSION['user'])) {
    if (isset($_POST['title'])) {
        $post_id = (int)$_POST['post_id'];
        $title = trim(filter_var($_POST['title'], FILTER_SANITIZE_STRING));

        $statement = $pdo->prepare('UPDATE posts SET title = :title WHERE id = :post_id');
        $statement->bindParam(':post_id', $post_id, PDO::PARAM_INT);
        $statement->bindParam(':title', $title, PDO::PARAM_STR);
        $statement->execute();

    }
     if (isset($_POST['link'])) {
        $post_id = (int)$_POST['post_id'];
        $link = trim(filter_var($_POST['link'], FILTER_SANITIZE_URL));
        // FILTER_SANITIZE_URL funkar ej nu pga använder textarea i form

        $statement = $pdo->prepare('UPDATE posts SET link = :link WHERE id = :post_id');
        $statement->bindParam(':post_id', $post_id, PDO::PARAM_INT);
        $statement->bindParam(':link', $link, PDO::PARAM_STR);
        $statement->execute();
     }

     if (isset($_POST['description'])) {
        $post_id = (int)$_POST['post_id'];
        $description = trim(filter_var($_POST['info'], FILTER_SANITIZE_STRING));

        $statement = $pdo->prepare('UPDATE posts SET description = :description WHERE id = :post_id');
        $statement->bindParam(':post_id', $post_id, PDO::PARAM_INT);
        $statement->bindParam(':description', $description, PDO::PARAM_STR);
        $statement->execute();
    }

    // kan nedan rader ligga här eller 1 st per inre if-sats ovan?
    $_SESSION['msg'] = 'Your post was successfully updated!';
    redirect('../../index.php');

}
else {
    $_SESSION['msg'] = 'Something went wrong, please try again!';
     redirect('/'); // Mål: tillbaka till samma sida
}
