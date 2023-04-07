<?php
$path =   "../utile/";
include "../utile/html/header.php";
?>
<input type="text" placeholder="pseudo" name="login" value="<?php if (!empty($_POST['login'])) {
                                                                echo $_POST['login'];
                                                            } ?>">
<input type="email" name="email" id="" placeholder="exemple@gmail.com" value="<?php if (!empty($_POST['email'])) {echo $_POST['email'];} ?>">




/**
* imail
* nom
* prenom
* date de naissance
* pwd
*/
include $path . "html/footer.php"; ?>