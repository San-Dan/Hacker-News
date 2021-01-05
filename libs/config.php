<?php
declare(strict_types=1);

// define PDO - tell about the db file
$pdo = new PDO('sqlite:hackernews.sqlite');

// write sql
$statement = $pdo->query('SELECT * FROM users');

if (!$statement) {
    die(var_dump($pdo->errorInfo()));
}

// run the SQL
$user = $statement->fetch(PDO::FETCH_ASSOC);

// show it on the screen
echo $user['name'];

