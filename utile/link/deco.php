<?php
session_start();
session_unset();
session_destroy();
unset($_COOKIE['id']);
setcookie('id', null, -1, '/');
header('Location: ../../public/sign-in.php');
exit();
