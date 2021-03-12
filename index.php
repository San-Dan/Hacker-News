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
                <tr class="row-post">
                    <td><?= $post['published']; ?></td>
                    <td><?php if($post['author'] == $_SESSION['user']['username']): ?>
                             <b><?= $post['author']; ?></b>
                             <button type="submit" name="edit">Edit Post</button>
                        <?php else:
                            echo $post['author']; ?>
                        <?php endif; ?>
                    </td>
                    <td><a href="<?= $post['link']; ?>"> <?= $post['title']; ?></a></td>
                    <td><?= $post['description']; ?></td>
                    <td><?= $post['upvotes']; ?></td>
                    <td>
                        <!-- SEE COMMENTS -->
                        <form action="/singlePost.php" method="POST">
                            <input type="hidden" name="id" value="<?= $post['id']; ?>">
                            <button type="submit" name="show">Comments</button>
                        </form>
                        <?php if (isset($_SESSION['user'])) : ?>
                            <!-- UPVOTE POST -->
                            <form action="/app/posts/upvotes.php" method="post">
                                <button type="submit" name="upvote">Me like!</button>
                            </form>
                            <!-- ADD COMMENT -->
                            <form action="/addComment.php?post_id=<?= $post['id'] ?>" method="POST">
                                <button type="submit" name="comment">Reply</button>
                            </form>
                    </td>
                <?php endif; ?>

                </tr>
        </tbody>
        <!------------------- COMMENTS ------------------------>
        <tbody class="tbodyComment">
            <?php if (isset($_POST['show'])) :
                    $posts_id = $post['id']; // How do I get the id?
                    $comments = getComments($pdo, $posts_id);
                    if ($comments) :
                        foreach ($comments as $comment) : ?>
                        <tr>
                            <th colspan="6">Comment by <?= $comment['users_username']; ?> on <?= $comment['published']; ?></th>
                            <td colspan="5">comment</td>
                        </tr>
                    <?php endforeach; ?>
                <?php endif; ?>
            <?php endif; ?>
            <tr class="spaceRow"> </tr>
        </tbody>
    <?php endforeach; ?>

    </table>
</main>

<?php require __DIR__ . '/views/footer.php'; ?>
