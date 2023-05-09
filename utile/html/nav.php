<?php
$array = scandir("../public/");/*, [
    ".",
    "..",
    "detail.php",
    "admin.php",
    "verif.php",
    "404.php",
    "login.php",
    "sign-in.php"
]);*/

foreach ($array as $test) {
?>

    <a href="<?= $test ?>"><?= $test ?></a> <br>
<?php
} ?>