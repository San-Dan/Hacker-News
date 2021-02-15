<?php

declare(strict_types=1);
require __DIR__ . '/../autoload.php';

// EDIT AVATAR, kolla Files lektion, spara img-src som string i db

if (isset($_SESSION['user'])) {
    // EDIT Image
    if (isset($_POST['newBio'])) {


