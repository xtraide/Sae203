<?php
$path = "../utile/";
include "../utile/html/header.php"; ?>
<form action="login.php">
email :
  <input type="email" placeholder="exemple@gmail.com" name="email" value="<?php if(!empty($_POST['email'])){echo $_POST['email'];} ?>">
  Mot de pass
  <input type="password" placeholder="Mot de passe" name="password"value="<?php if (!empty($_POST['password'])) {echo $_POST['password'];}?>">
  <input type="submit">
</form>
<?php
include $path . "link/link.php";
include $path . "function.php";
$email = isvalid($_POST['email']);
$password = isvalid($_POST['password']);
if (!empty($email) && !empty($password)) {
  $result = execute("Select * from compte where email = '" . $email . "' AND password ='" . crypt($password) . "';");
  if (!empty($result)) {
    setcookie("userId", $result['userId'], time() + 604800, '/');
    header('Location : index.php');
  } else {
    echo "mot de passe ou idiantifiant pas correct ";
  }
}
include $path . "html/footer.php"; ?>