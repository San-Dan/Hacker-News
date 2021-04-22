<?php
require __DIR__ . '/app/autoload.php';
require __DIR__ . '/views/header.php';
?>
<main class="boxXL">
    <table class="tablePosts">
        <!-- GET SINGLE POST -->
        <?php if (isset($_POST['show'])) :
            $post_id = (int)$_POST['id'];
            $post = getOnePost($pdo, $post_id);
        ?>

            <!---------- POST -------------->
            <p><?php if (isset($_SESSION['msg'])) {
                    echo $_SESSION['msg'];
                    unset($_SESSION['msg']);
                } ?></p>
            <tbody class="tbodyPost">
                <tr>
                    <th>#</th>
                    <th>User</th>
                    <th>Title</th>
                    <th>Description</th>
                    <th>Votes</th>
                </tr>
                <tr class="row-post">
                    <td><?= $post['published']; ?></td>
                    <td><?= $post['author']; ?></td>
                    <td><a href="<?= $post['link']; ?>"> <?= $post['title']; ?></a></td>
                    <td><?= $post['description']; ?></td>
                    <td><?= $post['upvotes']; ?></td>
                    <td>
                        <?php if (isset($_SESSION['user'])) : ?>
                            <!-- UPVOTE POST -->
                            <form action="/app/posts/upvotes.php" method="post">
                                <button type="submit" name="upvote">Me like!</button>
                            </form>
                            <!-- ADD COMMENT -->
                            <form action="/addComment.php?post_id=<?= $post['id']; ?>" method="POST">
                                <button type="submit" name="comment">Reply</button>
                            </form>
                    </td>
                <?php endif; ?>
                </tr>
            </tbody>
        <?php endif; ?>
        <!----------- COMMENTS -------------->
        <tbody class="tbodyComment">
            <?php if (getComments($pdo, $post_id) !== false) :
                $comments = getComments($pdo, $post_id);
                // die(var_dump($comments));

                foreach ($comments as $comment) :
            ?>
                    <tr>
                        <th colspan="6">Comment by <?= $comment['author']; ?> on <?= $comment['published']; ?></th>
                        <td colspan="5"><?= $comment['text']; ?></td>
                    </tr>
                <?php endforeach;
                ?>
            <?php else : ?>
                <?php //die(var_dump($comments));
                ?>
                <tr>
                    <td colspan="6">No comments yet</td>
                </tr>
            <?php endif;
            ?>

            <tr class="spaceRow"> </tr>
        </tbody>

    </table>
</main>

<?php require __DIR__ . '/views/footer.php'; ?>
