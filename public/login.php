<?php
$path = "../utile/";
include $path."html/header.php"; ?>
<form action="login.php" method="post">
Email: <input type="email" name="email" id="" placeholder="exemple@gmail.com" value="<?= !empty($_POST['email']) ?  $_POST['email'] : '' ?>">
  <div class="eremail"></div>
Mot de passe: <input type="password" placeholder="Mot de passe de 6 caractere" name="mdp" value="<?= !empty($_POST['mdp']) ?  $_POST['mdp'] : '' ?>">
  <div class="ermdp"></div>
<input type="submit">
  <div class="er"></div>
</form>
<?php
include $path . "link/link.php";
include $path . "function.php";
$email = isvalid($_POST['email']);
$password = isvalid($_POST['password']);
if (!empty($email) && !empty($password)) {
  $result = execute("Select * from compte where email = '" . $email . "' AND password ='" . crypte($password) . "';");
  if (!empty($result)) {
    setcookie("id", $result['id'], time() + 604800, '/');
    header('Location: index.php');
  } else {
    ?> 
        <script type="text/javascript">
            document.getElementsByClassName('er')[0].innerHTML = "l'email ou le Mot de pass est incorect";
        </script>
    <?php
  }
}
?><button name="admin" value="YAMETE"></button><?php /** a suprimer  */
if(!empty($_POST['admin']) && $_POST['admin']=="YAMETE"){
  setcookie("id", "", time() + 604800, '/');
  header('Location: index.php');
}/** */
include $path . "html/footer.php"; ?>