<?php
require __DIR__ . '/app/autoload.php';
require __DIR__ . '/views/header.php';
?>
<div class="boxXL">
<main>
    <table class="postsTable">
<!-- SORT POSTS BY DATE OR VOTES -->
    <?php if (isset($_GET['votes'])) {
                    $posts = getTopPosts($pdo);
             }
            else {
                $posts = getLatestPosts($pdo);
                } ?>
        <tbody>
            <tr>
                <th>#</th>
                <th>User</th>
                <th>Title</th>
                <th>Description</th>
                <th>Votes</th>
            </tr>
            <?php foreach ($posts as $post) : ?>
            <tr>
                <td><?php echo $post['id']; ?></td>
                <td><?php echo $post['author']; ?></td>
                <td><a href="<?php echo $post['link']; ?>"> <?php echo $post['title']; ?></a></td>
                <td><?php echo $post['description']; ?></td>
                <td><?php echo $post['upvotes']; ?></td>
                <td><button>Me like!</button></td>
                    <!-- if session user och upvote {button Remove like} -->
            </tr>
            </tbody>
            <tbody>
                <tr>
                    <td colspan="6">Comments</td>
                </tr>
                

                <tr class="spaceRow">  </tr>
            </tbody>

            <?php endforeach; ?>

    </table>
</main>
</div>

<?php require __DIR__ . '/views/footer.php'; ?>
