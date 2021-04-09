<?php
require __DIR__ . '/app/autoload.php';
require __DIR__ . '/views/header.php';

$post_id = (int)$_GET['post_id'];

$post = getOnePost($pdo, $post_id);

?>

<div class="boxXL">
<main>
    <section class="postForm formContainer">
        <h2>Edit post</h2>
        <form action="app/posts/updatePost.php" method="post">

            <label for="title">Title</label>
            <textarea type="text" name="title" placeholder="..." required style="max-height: 35px;"><?= $post['title'] ?></textarea>

            <label for="info">Description</label>
            <textarea type="text" name="info" placeholder="..."><?= $post['description'] ?></textarea>

            <label for="link">Link</label>
            <textarea type="text" name="link" placeholder="..." required style="max-height: 35px;"><?= $post['link'] ?></textarea>

            <input type="hidden" name="post_id" value="<?= $post_id; ?>">
            <button type="submit" name="submit">UPDATE POST</button>
        </form>
        <br>
        <hr>
        <br>
        <h4>Delete post here (can not be undone)</h4>
        <form action="app/posts/deletePost.php" method="post">
        <input type="hidden" name="post_id" value="<?= $post_id; ?>">
        <button type="submit" name="delete">Delete Post</button>
        <!-- JS med window alert? -->
        </form>
    </section>
</main>
</div>
<?php require __DIR__ . '/views/footer.php'; ?>
