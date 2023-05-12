<?php
$css = str_replace(".php","",basename(__FILE__)); 
$path = "../utile/";
?>

<a href="sign-in.php">Créer son compte</a>
<form action="<?= basename(__FILE__); ?>" method="post">
  <label for="logemail">Email : </label>
  <input type="logemail" name="logemail" id="" placeholder="exemple@gmail.com" value="<?= !empty($_POST['logemail']) ?  $_POST['logemail'] : '' ?>">
  <div class="eremail"></div>
  <label for="logmdp">Mot de passe : </label>
  <input type="password" placeholder="Mot de passe de 6 caracteres" name="logmdp" value="<?= !empty($_POST['logmdp']) ?  $_POST['logmdp'] : '' ?>">
  <div class="ermdp"></div>
  <input type="submit" value="Connexion">
  <div class="er"></div>
</form>
<?php
session_start();
include $path . "link/linkPdo.php";
include $path . "function.php";
$email = isValid('logemail', false);
$password = isValid('logmdp', false);
if (!empty($email) && !empty($password)) {
  $password = crypte($password);
  $result = execute("Select id,role,verified from `utilisateur` where email = :email AND mdp = :password;", [
    "email" => $email,
    "password" => $password
  ]);
  if ($result->rowCount() > 0) {
    foreach ($result as $row) {
      if ($row['verified' == 1]) {
        setcookie("id", $row['id'], time() + 604800, '/');
        $_SESSION['role'] = $row['role'];
        header('Location: index.php');
        exit;
      } else {
?>
        <script type="text/javascript">
          document.getElementsByClassName('er')[0].innerHTML = "Veillier verifier votre email pour vous connectez";
        </script>
    <?php
      }
    }
  } else {
    ?>
    <script type="text/javascript">
      document.getElementsByClassName('er')[0].innerHTML = "l'e-mail ou le Mot de passe est incorecte";
    </script>
<?php
  }
}
include $path . "html/footer.php";
