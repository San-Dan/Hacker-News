<?php
require __DIR__ . '/app/autoload.php';
require __DIR__ . '/views/header.php';

// Skicka med post_id från index och Hämta hela posten här?
// bra user tänk: svårt att komma ihåg vad man ska svara på ibland

// ex url: http://localhost:8000/addComment.php?post_id=2

$post_id = $_GET['post_id'];

getOnePost($pdo, $post_id);

?>
<div class="boxXL">
<main>
    <section class="formContainer">
        <h2>Write a comment</h2>
        <form action="app/comments/submitComment.php" method="post">
            <input type="text" value="<?php echo $post['title']?>" readonly>
            <textarea type="text" name="comment" required></textarea>
            <button type="submit" name="submit">ADD COMMENT</button>
            <?php //die(var_dump($_GET['post_id'])); ?>
        </form>
        </div>
    </section>
</main>

<?php require __DIR__ . '/views/footer.php'; ?>
