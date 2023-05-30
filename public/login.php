<?php
$path =   "../utile/";
$css = str_replace(".php", "", basename(__FILE__));
?>
<link rel="stylesheet" href="../assets/css/login.css">
<img src="../assets/ressources/utile/fond.png" alt="background" class="background">
<form action="<?= basename(__FILE__); ?>" method="post">
  <div class="container">
    <div>
      <img src="../assets/ressources/utile/Plan_de_travail_2.png" alt="" class="plan">
    </div>
    <div class="gradient">
      <div class="sign-up-wraper">
        <div id="sign" class="sign-up">
          <h2 class="sign-up">Connexion</h2>
          <div class="input-box">
            <label for="logemail">Email : </label>
            <img src="../assets/ressources/utile/navimg/mail.png" alt="Email" class="imges" width="20px" height="20px">
            <input type="text" name="email" id="" class="input" placeholder="Entrer votre Email" value="<?= !empty($_POST['email']) ?  $_POST['email'] : '' ?>">
            <div class="eremail"></div>
          </div>
          <div class="input-box">
            <label for="logmdp">Mot de passe : </label>
            <img src="../assets/ressources/utile/navimg/pws.png" alt="Pasword" width="20px" height="20px" class="imges">
            <input type="password" class="input" placeholder="Entrer votre mot de passe" name="mdp" value="<?= !empty($_POST['mdp']) ?  $_POST['mdp'] : '' ?>">
            <div class="ermdp" class="erreur"></div>
          </div>
          <div class="er"></div>
          <a class="forgot" href="../public/sign-in.php">Pas de compte ? Inscrivez-vous ici</a>
          <input type="submit" class="submit" name="Connexion" value="Connexion">
        </div>
      </div>
      <div>
        <img src="../assets/ressources/utile/iconviolet.png" alt="" height="400px" class="conexion">
      </div>
    </div>
  </div>
</form>
<?php

session_start();
if (!empty($_POST['Connexion'])) {
  include $path . "link/linkPdo.php";
  include $path . "function.php";
  $email = isValid('email', false);
  $password = isValid('mdp', false);
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
}
include $path . "html/footer.php";
