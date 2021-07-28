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
                    <td><?php if (isset($_SESSION['user'])) : ?>
                            <?php if ($post['author'] === $_SESSION['user']['username']) : ?>
                                <b><?= $post['author']; ?></b>
                                <form action="/editPost.php?post_id=<?= $post['id'] ?>" method="POST">
                                    <button type="submit" name="edit">Edit Post</button>
                                </form>
                            <?php else :
                                echo $post['author']; ?>
                            <?php endif; ?>
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
                        <!-- UPVOTE POST -->
                        <?php if (isset($_SESSION['user'])) : ?>

                            <form action="/app/posts/upvotes.php" method="post">
                                <input type="hidden" name="id" value="<?= $post['id']; ?>">
                                <button type="submit" name="upvote">Me like!</button>
                            </form>

                    </td>
                <?php endif; ?>


                </tr>
        </tbody>

    <?php endforeach; ?>

    </table>
</main>

<?php require __DIR__ . '/views/footer.php'; ?>
