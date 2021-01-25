<?php
require __DIR__ . '/app/autoload.php';
require __DIR__ . '/views/header.php';
?>
<div class="boxXL">
<main>

    <?php if (isset($_SESSION['?=votes']) === true) {
            $upvotes = 'upvotes';
            $posts = getTopPosts($pdo, $upvotes);
            return $posts; } ?>


            <?php if (isset($_SESSION['?=latest']) === true) {
                $published ='published';
                $posts = getLatestPosts($pdo, $published);
                return $posts;} ?>
    <table>
        <tbody>
            <tr>
                <th>#</th>
                <th>POSTS</th>
            </tr>
            <tr>
            <?php foreach ($posts as $post) : ?>
                <td><?php echo $post['id']; ?></td>
                <td><?php echo $post['title']; ?></td>
                <td><?php echo $post['description']; ?></td>
                <td><?php echo $post['link']; ?></td>
            <?php endforeach; ?>
            </tr>
        </tbody>
    </table>
</main>
</div>

<?php require __DIR__ . '/views/footer.php'; ?>
