<?php
// require __DIR__ . '/folderName/fileName.php';
// require __DIR__ . '//.php';
require __DIR__ . '/app/autoload.php';
require __DIR__ . '/app/functions.php';
require __DIR__ . '/app/posts/postsFunc.php';
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>.hackernews</title>
</head>
<body>
    <?php require __DIR__ . '/libs/templates/header.php'; ?>
<main>
    <table>
        <tbody>
            <tr>
                <th>#</th>
                <th>POSTS</th>
            </tr>
            <tr>
                <td>Post ID</td>
                <td>Post title</td>
                <td>Description</td>
            </tr>
            <tr>
                <td>Post id</td>
                <td>Post title</td>
                <td>Description</td>
            </tr>
            <tr>
                <td> Post id</td>
                <td>Post Title</td>
                <td>Description</td>
                </tr>
        </tbody>

    </table>
</main>

<?php require __DIR__ . '/libs/templates/footer.php'; ?>

