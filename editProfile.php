<?php
require __DIR__ . '/app/autoload.php';
require __DIR__ . '/views/header.php';

if (!isset($_SESSION['user'])) {
        redirect('../../login.php');
}
?>

<main class="profileMain">
    <form class="editForm" action="/app/profile/editData.php" method="POST">
        <h2>PROFILE</h2>
        <img src="assets/profile.jpg" alt="avatar">
        <button>Add Image</button>
        <label>Username: <?php echo $_SESSION['user']['username'];?> </label>
        <label>Email: <?php echo $_SESSION['user']['email'];?></label>
        <input type="email" name="newEmail" placeholder="Your new email">
        <label>Bio: </label>
        <div class="bioBox"><?php echo $_SESSION['user']['bio'];?> </div>
        <textarea type="text" name="newBio" placeholder="Your new bio"></textarea>
        <button type="submit">Save Info</button>
    </form>

    <section class="pwdSection">
        <h2>PASSWORD</h2>
        <p>Remember to choose a unique password, stay safe out there!</p>
        <button>Change Password</button>
    </section>

</main>

<?php require __DIR__ . '/views/footer.php'; ?>
