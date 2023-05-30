<?php
session_start();
session_unset();
session_destroy();
unset($_COOKIE['id']);
unset($_SESSION);
setcookie('id', null, -1, '/');
header('Location: ../../public/login.php');
exit();
