<?php
require __DIR__ . '/app/autoload.php';
require __DIR__ . '/views/header.php';

// Skicka med post_id från index och Hämta hela posten här?
// bra user tänk: svårt att komma ihåg vad man ska svara på ibland

// ex url: http://localhost:8000/addComment.php?post_id=2

$post_id = (int)$_GET['post_id'];

$post = getOnePost($pdo, $post_id);

?>
<div class="boxXL">
    <main>
        <section class="formContainer">
            <h2>Write a comment</h2>
            <form action="app/comments/submitComment.php" method="post">
                <!-- post info -->
                <input type="text" value="<?= $post['title'] ?>" readonly>
                <input type="hidden" name="post_id" value="<?= $post_id; ?>">
                <!-- comment input -->
                <textarea type="text" name="comment" required></textarea>
                <button type="submit" name="submit">ADD COMMENT</button>
            </form>
</div>
</section>
</main>

<?php require __DIR__ . '/views/footer.php'; ?>
