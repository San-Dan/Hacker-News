<?php

declare(strict_types=1);
require __DIR__ . '/../autoload.php';

// if-sats här om username+post_id finns i upvotes, om false - nedan update, annars - delete?
// Snyggast logik för att kolla om man har likeat - skriv funktion, eller direkt här?

// ------------------ UPVOTES ------------
// ADD UPVOTE

if (isset($_SESSION['user'])) {
    if (isset($_POST['upvote'])) {

        $post_id = (int)$_POST['id'];
        $username = $_SESSION['user']['username'];
        $post = getOnePost($pdo, $post_id);
        $upvotes = $post['upvotes'];

        if (getUsersUpvotes($pdo, $post_id, $username) == true) {
            $minusUpvote = $upvotes - 1;    // testa bara --$upvotes?

            // DELETE UPVOTE
            $statement = $pdo->prepare('DELETE FROM upvotes WHERE post_id = :post_id AND liked_by = :username');
            $statement->bindParam(':post_id', $post_id, PDO::PARAM_INT);
            $statement->bindParam(':username', $username, PDO::PARAM_STR);
            $statement->execute();

            // UPDATE POSTS TABLE
            $statement = $pdo->prepare('UPDATE posts SET upvotes = :upvotes WHERE id = :post_id');
            $statement->bindParam(':post_id', $post_id, PDO::PARAM_INT);
            $statement->bindParam(':upvotes', $minusUpvote, PDO::PARAM_INT);
            $statement->execute();

            $_SESSION['msg'] = 'Your upvote was removed';
            redirect('../../index.php');
        } else {
            $plusUpvote = ++$upvotes;      // testa bara ++$upvotes?

            // INSERT INTO UPVOTES TABLE
            $statement = $pdo->prepare('INSERT INTO upvotes (post_id, liked_by, all_upvotes) VALUES (:post_id, :liked_by, :all_upvotes)');
            $statement->bindParam(':post_id', $post_id, PDO::PARAM_INT);
            $statement->bindParam(':liked_by', $username, PDO::PARAM_STR);
            $statement->bindParam(':all_upvotes', $plusUpvote, PDO::PARAM_INT);
            $statement->execute();

            // UPDATE POSTS TABLE
            $statement = $pdo->prepare('UPDATE posts SET upvotes = :upvotes WHERE id = :post_id');
            $statement->bindParam(':post_id', $post_id, PDO::PARAM_INT);
            $statement->bindParam(':upvotes', $plusUpvote, PDO::PARAM_INT);
            $statement->execute();

            $_SESSION['msg'] = 'Good choice! You liked the best post yet :)';
            redirect('../../index.php');
        }
    }
}
