<?php
require __DIR__ . '/app/autoload.php';
require __DIR__ . '/views/header.php';

if (!isset($_SESSION['user'])) {
        redirect('../../login.php');
}

$id = (int)$_SESSION['user']['id'];
$user = getUserById($pdo, $id);
?>

<main class="profileMain">
<!-- CHANGE PROFILE PICTURE -->
    <form class="editForm" action="/app/profile/editImg.php" method="post">
        <h2>PROFILE</h2>
        <img src="assets/profile.jpg" alt="avatar">
        <button type="submit">Add Image</button>
    </form>
<!-- CHANGE EMAIL -->
    <form class="editForm" action="/app/profile/editEmail.php" method="post">
        <label>Username: <?= $user['username'];?> </label>
        <label>Email: <?= $user['email'];?></label>
        <input type="email" name="newEmail" placeholder="Your new email">
        <button type="submit">Update Email</button>
    </form>
<!-- CHANGE PROFILE BIO -->
    <form class="editForm" action="/app/profile/editBio.php" method="post">
        <label>Bio:</label>
        <textarea type="text" name="newBio" placeholder="Say something about you"><?= $user['bio']; ?></textarea>
        <button type="submit">Update Info</button>
    </form>

    <section class="pwdSection">
    <form class="editForm" action="/app/profile/editPwd.php" method="post">
        <h2>PASSWORD</h2>
        <p>Remember to choose a unique password, stay safe out there!</p>
        <button type="submit">Change Password</button>
    </form>
    </section>

</main>

<?php require __DIR__ . '/views/footer.php'; ?>
