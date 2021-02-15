<?php
require __DIR__ . '/app/autoload.php';
require __DIR__ . '/views/header.php';
?>
<main class="boxXL">
    <table class="tablePosts">
        <!-- SORT POSTS BY DATE OR VOTES -->
        <?php if (isset($_GET['order'])) {
            $posts = getTopPosts($pdo);
        } else {
            $posts = getLatestPosts($pdo);
        } ?>

        <!------- POSTS -------------->
        <p><?php if (isset($_SESSION['msg'])) {
                echo $_SESSION['msg'];
                unset($_SESSION['msg']);
            }; ?></p>
        <tbody class="tbodyPost">
            <tr>
                <th>#</th>
                <th>User</th>
                <th>Title</th>
                <th>Description</th>
                <th>Votes</th>
            </tr>
            <?php foreach ($posts as $post) : ?>
                <tr>
                    <td><?php echo $post['published']; ?></td>
                    <td><?php echo $post['author']; ?></td>
                    <td><a href="<?php echo $post['link']; ?>"> <?php echo $post['title']; ?></a></td>
                    <td><?php echo $post['description']; ?></td>
                    <td><?php echo $post['upvotes']; ?></td>
                    <form action="/index.php" method="POST">
                        <td><button type="submit" name="show">See Comments</button></td>
                    </form>
                    <?php if (isset($_SESSION['user'])) : ?>
                        <form action="/app/posts/upvotes.php" method="post">
                            <td><button type="submit" name="upvote">Me like!</button></td>
                        </form>
                        <form action="/addComment.php?post_id=<?= $post['id'] ?>" method="POST">
                            <td><button type="submit" name="comment">Add Comment</button></td>
                        </form>

                    <?php endif; ?>
                </tr>
        </tbody>
        <!------------------- COMMENTS ------------------------>
        <tbody class="tbodyComment">
            <?php if (isset($_POST['show'])) :
                    $posts_id = $post['id']; // How do I get the id?
                    $comments = getComments($pdo, $posts_id);
                    foreach ($comments as $comment) : // Warning: foreach() argument must be of type array|object, bool given
            ?>
                    <tr>
                        <th colspan="6">Comment by <?php echo $comment['users_username'] ?> on <?php echo $comment['published']; ?></th>
                        <td colspan="5">comment</td>
                    </tr>
                <?php endforeach; ?>
            <?php endif; ?>
            <tr class="spaceRow"> </tr>
        </tbody>
    <?php endforeach; ?>

    </table>
</main>

<?php require __DIR__ . '/views/footer.php'; ?>
