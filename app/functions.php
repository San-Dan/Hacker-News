<?php
declare(strict_types=1);

 function redirect(string $path) {
    header("Location: ${path}");
    exit;
}

function validateEmail(string $email): bool {
    if (filter_var($email, FILTER_VALIDATE_EMAIL)) {
        return true;
    } else {
        return false;
    }
}

function validatePwd(string $pwd, string $pwdRep): bool {
    if ($pwd === $pwdRep) {
        return true;
    } else {
        return false;
    }
}




// POSTS FUNCTIONS

// Extended error info: if (!$statement) { die(var_dump($pdo->errorInfo())); }
//----------------------------------
function getTopPosts(PDO $pdo) {
    $statement = $pdo->prepare('SELECT * FROM posts ORDER BY upvotes DESC');
    $statement->execute();

    $posts = $statement->fetchAll(PDO::FETCH_ASSOC);
    return $posts;

}

function getLatestPosts(PDO $pdo) {
    $statement = $pdo->prepare('SELECT * FROM posts ORDER BY published DESC');
    $statement->execute();

    $posts = $statement->fetchAll(PDO::FETCH_ASSOC);
    return $posts;
}

function getUsersPosts(PDO $pdo, int $id, int $posts_id) {
    $statement = $pdo->prepare('SELECT * FROM posts INNER JOIN users WHERE users_id = :id ;');
    $statement->execute();
    $posts = $statement->fetch(PDO::FETCH_ASSOC);
    return $posts;
    }


function createPost(PDO $pdo, string $title, int $users_id, string $description, string $link, string $date) {
    $statement = $pdo->prepare('INSERT INTO posts (id, users_id, title, description, link, date) VALUES (:posts_id, :users_id, :author, :text, :date)');
    $statement->bindParam(':post_id', $post_id, PDO::PARAM_INT);
    $statement->bindParam(':user_id', $user_id, PDO::PARAM_INT);
    $statement->bindParam(':author', $author, PDO::PARAM_STR);
    $statement->bindParam(':text', $text, PDO::PARAM_STR);
    $statement->bindParam(':date', $date, PDO::PARAM_STR);
    $statement->execute();

    $rows = $statement->fetchAll(PDO::FETCH_NUM);

    foreach($rows as $row) {    // <-- kanske nåt sånt? I vilken fil..?
        echo("$row[0] $row[1] $row[2]\n");
    }
}

// COMMENT FUNCTIONS
//------------------------------------------

function createComment(PDO $pdo, string $comment, int $posts_id, int $users_id, string $date) {
    $statement = $pdo->prepare('INSERT INTO comments (posts_id, users_id, comment, date) VALUES (:posts_id, :users_id, :author, :text, :date)');
    $statement->bindParam(':post_id', $post_id, PDO::PARAM_INT);
    $statement->bindParam(':user_id', $user_id, PDO::PARAM_INT);
    $statement->bindParam(':author', $author, PDO::PARAM_STR);
    $statement->bindParam(':text', $text, PDO::PARAM_STR);
    $statement->bindParam(':date', $date, PDO::PARAM_STR);
    $statement->execute();
}
// USER FUNCTIONS
//----------------------------------
/*function bla() {
    die(var_dump($pdo->errorInfo()));

    $statement->execute();
    $user = $statement->fetch(PDO::FETCH_ASSOC);
    return $user;
} */

function getProfile(PDO $pdo, int $id) {
    $statement = $pdo->prepare('SELECT * FROM profile WHERE users_id = :id');
    $statement->bindParam(':users_id', $id, PDO::PARAM_STR);
    $statement->execute();
    $profile = $statement->fetch(PDO::FETCH_ASSOC);

    return $profile;
}

function userExists(PDO $pdo, string $username, string $email){
    $statement = $pdo->prepare('SELECT * FROM users WHERE username = :username OR email = :email;');
    $statement->bindParam(':username', $username, PDO::PARAM_STR);
    $statement->bindParam(':email', $email, PDO::PARAM_STR);
    $statement->execute();
    $user = $statement->fetch(PDO::FETCH_ASSOC);

    return $user;
}

function createUser(PDO $pdo, string $name, string $username, string $email, string $pwd) {
    $statement = $pdo->prepare('INSERT INTO users (name, username, email, pwd) VALUES (:name, :username, :email, :pwd);');
    $hashedPwd = password_hash($pwd, PASSWORD_DEFAULT);

        if (!$statement) {
            die(var_dump($pdo->errorInfo()));
        }
        $statement->bindParam(':name', $name, PDO::PARAM_STR);
        $statement->bindParam(':username', $username, PDO::PARAM_STR);
        $statement->bindParam(':email', $email, PDO::PARAM_STR);
        $statement->bindParam(':pwd', $hashedPwd, PDO::PARAM_STR);
        $statement->execute();
}

// Läs noga här https://phpdelusions.net/pdo#query
// och här (om execute+bindParam): https://doc.bccnsoft.com/docs/php-docs-7-en/pdostatement.execute.html
