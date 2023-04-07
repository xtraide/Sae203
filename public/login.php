<?php
$path =   "../utile/";
include "../utile/html/header.php"; ?>
<form action="login.php">
  email :
  <input type="text" placeholder="exemple@gmail.com" name="email" value="<?php if(!empty($_POST['email'])){echo $_POST['email'];} ?>">
  Mot de pass
  <input type="password" placeholder="Mot de passe" name="password"value="<?php if (!empty($_POST['password'])) {echo $_POST['password'];}?>">
  <input type="submit">
</form>
<?php 
include $path . "link/link.php";
if (!empty($_POST['login']) && !empty($_POST['password'])) {
  $result = execute("Select * from compte where email = '" . htmlentities(trim($_POST['login'])) . "' AND password ='" . htmlentities(trim($_POST['password'])) . "';");
  if (!empty($result)) {
    setcookie("userId", $result['userId']);
    header('Location : index.php');
  }else {
    echo"mot de passe ou idiantifiant pas correct ";
  }
}
include $path . "html/footer.php"; ?>