<?php

declare(strict_types=1);
require __DIR__ . '/../autoload.php';

// EDIT AVATAR, kolla Files lektion, spara img-src som string i db

if (isset($_SESSION['user'])) {
    // EDIT Image
    if (isset($_FILES['image'])) {
        $id = (int)$_SESSION['user']['id'];

        $imageFile = $_FILES['image'];
        $imgName = $_FILES['image']['name'];
        $imgTmpName = $_FILES['image']['tmp_name'];
        $imgType = $_FILES['image']['type'];
        $imgSize = $_FILES['image']['size'];
        $imgError = $_FILES['image']['error'];


        $imgExt = explode('.', $imgName);
        $imgActualExt = strtolower(end($imgExt));

        $allowed = array('jpg');
        if (in_array($imgActualExt, $allowed)) {
            if ($imgError === 0) {
                if ($imgSize < 800000) {
                    $imgNameNew = "profileimg" . $id . "." . $imgActualExt;
                    $destination = __DIR__ . '/../uploads' . $fileNameNew;

                    // Delete earlier (by user) uploaded file from uploads??
                    $currentImg = $_SESSION['user']['profileimg'];
                    if (file_exists(__DIR__ . '/uploads/' . $currentImg)) {
                        if ($currentImg !== null) {
                            unlink(__DIR__ . '/uploads/' . $currentImg);
                        }
                    }

                    // New image to uploads
                    move_uploaded_file($imgTmpName, $destination);

                    // New img source to users table in db
                    $statement = $pdo->prepare('UPDATE users SET profileimg = :profileimg WHERE id = :id');
                    $statement->bindParam(':profileimg', $imgNameNew, PDO::PARAM_STR);
                    $statement->bindParam(':id', $id, PDO::PARAM_INT);
                    $statement->execute();

                    $_SESSION['msg'] = 'Your profile image was updated!';
                    redirect('../../profile.php');
                } else {
                    $_SESSION['msg'] = 'File size must be under 8MB';
                }
            } else {
                $_SESSION['msg'] = 'There was an error';
            }
        } else {
            $_SESSION['msg'] = 'Only jpg type allowed';
        }
    } else {
        redirect('../../index.php');
    }
}
