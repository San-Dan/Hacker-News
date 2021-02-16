<?php
declare(strict_types=1);

require __DIR__ . '/../autoload.php';

setcookie(session_name(), '', 100);
session_unset();
session_destroy();
$_SESSION = array();

redirect('../../index.php');


