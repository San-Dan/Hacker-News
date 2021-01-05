<?php
// require __DIR__ . '/folderName/fileName.php';
// require __DIR__ . '//.php';
require __DIR__ . '/libs/config.php';


?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Hacker News</title>
</head>
<body>
    <?php require __DIR__ . '/libs/templates/header.php'; ?>


<!-- Alla posts ska hamna i ordered list, eller table, se papper>
    <main>
        <ol>
            <li>
        </ol>
    </main>

-->

<?php require __DIR__ . '/libs/templates/footer.php'; ?>
</body>
</html>
