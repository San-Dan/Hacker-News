<?php
require __DIR__ . '/app/autoload.php';
require __DIR__ . '/views/header.php';
?>
<div class="boxXL">
<main>
    <table>
    <?php if (isset($_GET['votes'])) {  // använd === true?
                    $posts = getTopPosts($pdo);
             }
            else {                             //if (isset($_GET['latest' OR ''])) return $posts;
                $posts = getLatestPosts($pdo);
                } ?>
        <tbody>
            <tr>
                <th>#</th>
                <th>POSTS</th>
            </tr>
            <?php foreach ($posts as $post) : ?>
                <tr>
                <td><?php echo $post['id']; ?></td>
                <td><?php echo $post['author']; ?></td>
                <td><?php echo $post['title']; ?></td>
                <td><?php echo $post['description']; ?></td>
                <td><?php echo $post['link']; ?></td>
                <td><?php echo $post['upvotes']; ?></td>
            </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</main>
</div>

<?php require __DIR__ . '/views/footer.php'; ?>
