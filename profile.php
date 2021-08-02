<?php
require __DIR__ . '/app/autoload.php';
require __DIR__ . '/views/header.php';

if (!isset($_SESSION['user'])) {
    redirect('../../index.php');
}
$id = (int)$_SESSION['user']['id'];
$user = getUserById($pdo, $id);
?>

<main class="profileMain">
    <section class="profile-container">
        <p><?php if (isset($_SESSION['msg'])) {
                echo $_SESSION['msg'];
                unset($_SESSION['msg']);
            }; ?></p>
        <h2>PROFILE PAGE</h2>
        <?php if ($user['profileimg'] === null) : ?>
            <img src="app/uploads/defaultprofile.jpg" alt="avatar">
        <?php else : ?>
            <img src="/app/uploads/<?= $_SESSION['user']['profileimg']; ?>" alt="profile image">
        <?php endif; ?>
        <h3>Username: <?= $user['username']; ?> </h3>
        <h3>Email: <?= $user['email']; ?></h3>
        <h3>Bio </h3>
        <div class="bioBox"><?= $user['bio']; ?> </div>
        <form action="/editProfile.php">
            <button type="submit">Edit Profile</button>
        </form>
    </section>

    <section class="pwdSection">
        <h2>PASSWORD</h2>
        <p>Remember to choose a unique password, stay safe out there!</p>
        <form action="/editProfile.php">
            <button type="submit">Change Password</button>
        </form>
    </section>

</main>

<?php require __DIR__ . '/views/footer.php'; ?>
