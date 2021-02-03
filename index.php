<?php
require __DIR__ . '/app/autoload.php';
require __DIR__ . '/views/header.php';
?>
<div class="boxXL">
<main>
    <table>
        <tbody>
            <tr>
                <th>#</th>
                <th>POSTS</th>
            </tr>
            <tr>
            <?php if (isset($_GET['votes']) === true) {
                    $posts = getTopPosts($pdo);
             }
            else {                             //if (isset($_GET['latest' OR ''])) return $posts;
                $posts = getLatestPosts($pdo);
                } ?>
            <?php foreach ($posts as $post) : ?>
                <td><?php echo $post['id']; ?></td>
                <td><?php echo $post['author']; ?></td>
                <td><?php echo $post['title']; ?></td>
                <td><?php echo $post['description']; ?></td>
                <td><?php echo $post['link']; ?></td>
                <td><?php echo $post['upvotes']; ?></td>
            <?php endforeach; ?>
            </tr>
        </tbody>
    </table>
</main>
</div>

<?php require __DIR__ . '/views/footer.php'; ?>
