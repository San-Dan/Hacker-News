<?php
require __DIR__ . '/app/autoload.php';
require __DIR__ . '/views/header.php';

if (!isset($_SESSION['user'])) {
        redirect('../../login.php');
}
?>

<main class="profileMain">
    <section class="profile-container">
        <h2>PROFILE PAGE</h2>
        <img src="assets/profile.jpg" alt="avatar">
        <h3>Username: <?php echo $_SESSION['user'];?> </h3>
        <h3>Email: <?php echo $_SESSION['user']['email'] ;?></h3>
        <h3>Bio <?php ?></h3>
        <textarea name="" id="" cols="30" rows="10"></textarea>
        <button type="submit">Edit Info</button>
    </section>

    <section class="pwdSection">
        <h2>PASSWORD</h2>
        <p>Remember to choose a unique password, stay safe out there!</p>
        <button>Change Password</button>
    </section>

</main>

<?php require __DIR__ . '/views/footer.php'; ?>
