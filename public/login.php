<?php
$path = "../utile/";
include $path . "html/header.php"; ?>

<a href="sign-in.php">Créer son compte</a>
<form action="login.php" method="post">
  <label for="email">Email : </label>
  <input type="email" name="email" id="" placeholder="exemple@gmail.com" value="<?= !empty($_POST['email']) ?  $_POST['email'] : '' ?>">
  <div class="eremail"></div>
  <label for="mdp">Mot de passe : </label>
  <input type="password" placeholder="Mot de passe de 6 caracteres" name="mdp" value="<?= !empty($_POST['mdp']) ?  $_POST['mdp'] : '' ?>">
  <div class="ermdp"></div>
  <input type="submit">
  <div class="er"></div>
</form>
<?php
session_start();
include $path . "link/linkPdo.php";
include $path . "function.php";
$email = isvalid('email', false);
$password = isvalid('mdp', false);
if (!empty($email) && !empty($password)) {
  $password = crypte($password);
  $result = execute("Select id,role from `utilisateur` where email = :email AND mdp = :password;", [
    'email' => $email,
    'password' => $password
  ]);
 
  if ($result->rowCount() > 0) {
    foreach ($result as $row) {
      setcookie("id", $row['id'], time() + 604800, '/');
      $_SESSION['role'] = $row['role'];
      header('Location: index.php');
      exit;
    }
  } else {
?>
    <script type="text/javascript">
      document.getElementsByClassName('er')[0].innerHTML = "l'e-mail ou le Mot de passe est incorecte";
    </script>
<?php
  }
}


include $path . "html/footer.php"; ?>