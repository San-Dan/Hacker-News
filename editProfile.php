<?php
require __DIR__ . '/app/autoload.php';
require __DIR__ . '/views/header.php';

if (!isset($_SESSION['user'])) {
    redirect('../../login.php');
}

$id = (int)$_SESSION['user']['id'];
$user = getUserById($pdo, $id);
$profileImg = $user['profileimg'];
$imgUpload = __DIR__ . '/app/profile/uploads/' . $profileImg;

?>

<main class="profileMain">
    <h2>PROFILE</h2>
    <?php if (profileImgExists($imgUpload)) :  ?>
        <img src="/app/profile/uploads/<?= $profileImg ?>" alt="profile image">
    <?php else : ?>
        <img src="/app/profile/uploads/defaultprofile.jpg" alt="avatar">
    <?php endif; ?>
    <!-- CHANGE PROFILE PICTURE -->
    <form class="editForm" action="/app/profile/editImg.php" method="post" enctype="multipart/form-data">
        <label for="image">Choose a file (only jpg allowed)</label>
        <input type="file" name="image" id="image" accept=".jpg" required>
        <button type="submit">Upload Image</button>
    </form>
    <!-- CHANGE EMAIL -->
    <form class="editForm" action="/app/profile/editEmail.php" method="post">
        <label>Username: <?= $user['username']; ?> </label>
        <label>Email: <?= $user['email']; ?></label>
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
            <label for="pwd">Old Password</label>
            <input type="password" name="oldPwd" placeholder="Old password">
            <label for="pwd">New Password</label>
            <input type="password" name="newPwd" placeholder="New password">
            <input type="password" name="newPwdRep" placeholder="Repeat new password">
            <button type="submit">Change Password</button>
        </form>
    </section>

</main>

<?php require __DIR__ . '/views/footer.php'; ?>
