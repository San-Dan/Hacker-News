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
//----------------------------------
function getTopPosts(PDO $pdo, string $upvotes) : array {
    $stmt = $pdo->prepare("SELECT * FROM posts ORDERBY $upvotes DESC");

    if (!$stmt) {
        die(var_dump($pdo->errorInfo()));
    }
     $stmt->execute();

     $posts = $stmt->fetchAll(PDO::FETCH_ASSOC);
     return $posts;
}

function getLatestPosts(PDO $pdo, string $published) : array {
    $stmt = $pdo->prepare("SELECT * FROM posts ORDERBY $published DESC");

    if (!$stmt) {
        die(var_dump($pdo->errorInfo()));
    }
     $stmt->execute();

     $posts = $stmt->fetchAll(PDO::FETCH_ASSOC);
     return $posts;
}
// FETCH USERS POSTS IN DB 1
function getUsersPost(PDO $pdo, int $id) : array {
    $stmt = $pdo->prepare("SELECT * FROM posts WHERE id = :id");

    if (!$stmt) {
        die(var_dump($pdo->errorInfo()));
    }
     $stmt->execute();

     $posts = $stmt->fetchAll(PDO::FETCH_ASSOC);
     return $posts;
}

// FETCH USERS POSTS IN DB 2
function getUsersPosts(PDO $pdo, int $id, int $posts_id) {
    $statement = $pdo->prepare('SELECT * FROM posts INNER JOIN users WHERE users_id = :id ;');
    $statement->execute();
    $posts = $statement->fetch(PDO::FETCH_ASSOC);
    return $posts;
    }


function createPost(PDO $pdo, string $title, string $desription, string $link) {
    $stm = $pdo->query("INSERT INTO posts....");

    $rows = $stm->fetchAll(PDO::FETCH_NUM);

    foreach($rows as $row) {    // <-- kanske nåt sånt? I vilken fil..?
        echo("$row[0] $row[1] $row[2]\n");
    }
}

// USER FUNCTIONS
//----------------------------------
/*function bla() {
    die(var_dump($pdo->errorInfo()));

    $statement->execute();
    $user = $statement->fetch(PDO::FETCH_ASSOC);
    return $user;
} */

function getUserProfile() {

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

        redirect('../profile.php');
}

// Läs noga här https://phpdelusions.net/pdo#query
// och här (om execute+bindParam): https://doc.bccnsoft.com/docs/php-docs-7-en/pdostatement.execute.html
