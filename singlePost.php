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
                                <input type="hidden" name="post_id" value="<?= $post['id'] ?>">
                                <button type="submit" name="upvote">Me like!</button>
                            </form>
                            <!-- ADD COMMENT -->
                            <form action="/addComment.php?post_id=<?= $post['id']; ?>" method="POST">
                                <button type="submit" name="comment">Reply</button>
                            </form>
                        <?php endif; ?>
                    </td>
                </tr>
            </tbody>
        <?php endif; ?>
        <!----------- COMMENTS -------------->
        <tbody class="tbodyComment">
            <?php if (getComments($pdo, $post_id) !== false) :
                $comments = getComments($pdo, $post_id);
                // die(var_dump($comments));

                foreach ($comments as $comment) :  ?>
                    <!-- COMMENT INFO -->
                    <tr class="tr-sm">
                        <td colspan="4" class="tr-sm">Comment by <?= $comment['author']; ?> on <?= $comment['published']; ?> </td>
                        <?php if ($comment['author'] === $_SESSION['user']['username']) : ?>
                            <td>
                                <form action="app/comments/deleteComment.php" method="post" class="form-sm">
                                    <input type="hidden" name="comment_id" value="<?= $comment['id'] ?>">
                                    <button type="submit" name="delete" class="btn-sm">Delete</button>
                                </form>
                            </td>
                            <!-- <td> <button class="btn-sm toggle-form">Edit comment</button> </td> -->
                    </tr>

                    <!-- COMMENT TEXT -->
                    <tr>
                        <td colspan="6"><?= $comment['text']; ?></td>
                    </tr>

                    <!-- EDIT COMMENT FORM (default display:none)-->
                    <tr class="editCommentForm">
                        <td colspan="6">
                            <form action="app/comments/updateComment.php" method="POST">
                                <input type="text" name="comment" placeholder="Update existing comment here">
                                <input type="hidden" name="comment_id" value="<?= $comment['id'] ?>">
                                <input type="hidden" name="post_id" value="<?= $post['id'] ?>">
                                <button type="submit" name="edit">Update comment</button>
                            </form>
                        </td>
                    </tr>
                <?php else : ?>
                    <!-- COMMENT TEXT -->
                    <tr>
                        <td colspan="6"><?= $comment['text']; ?></td>
                    </tr>
                <?php endif; ?>




            <?php endforeach; ?>
        <?php else : ?>

            <tr>
                <td colspan="6">No comments yet</td>
            </tr>
        <?php endif;   ?>

        <tr class="spaceRow"> </tr>
        </tbody>

    </table>
</main>

<?php require __DIR__ . '/views/footer.php'; ?>
