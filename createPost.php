<?php
require __DIR__ . '/app/autoload.php';
require __DIR__ . '/views/header.php';
?>
<div class="boxXL">
<main>
    <section class="postForm formContainer">
        <h2>Create a post</h2>
        <form action="app/posts/submitPost.php" method="post">
            <label for="title">Title</label>
            <input type="text" name="title" placeholder="..." required>

            <label for="info">Description</label>
            <input type="text" name="info" placeholder="...">

            <label for="link">Link</label>
            <input type="text" name="link" placeholder="..." required>
            
            <button type="submit" name="submit">SUBMIT POST</button>
        </form>
        </div>
    </section>

</main>

<?php require __DIR__ . '/views/footer.php'; ?>
