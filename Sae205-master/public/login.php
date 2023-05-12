<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../assets/css/login.css">
    <title>index</title>
</head>
<body>

<form action="<?= basename(__FILE__); ?>" method="post">
<div class="gradient">
<div class="sign-up-wraper">
    <div id="sign" class="sign-up">
        <h2 class="sign-up">Connexion</h2>
        <div class="input-box">
            <span>Email</span>
            <img src="../assets/ressources/login_&_sign-in/mail.png" alt="Email" class="imges" width="20px" height="20px" >
            <input type="email" class="input" placeholder="Entrer votre Email" name="email" value="<?= !empty($_POST['email']) ?  $_POST['email'] : '' ?>">
            <div class="eremail"></div>
        </div>
        <div class="input-box">
            <span>Mot de passe</span>
            <img src="../assets/ressources/login_&_sign-in/pws.png" alt="Pasword" width="20px" height="20px" class="imges">
            <input type="password" class="input" placeholder="Entrer votre mot de passe" name="mdp" value="<?= !empty($_POST['mdp']) ?  $_POST['mdp'] : '' ?>">
            <div class="ermdp" class="erreur"></div>
        </div>
        <a class="forgot" href="#">mot de passe oublier</a>
        <a class="forgot" href="../public/sign-in.php">Pas de compte ? Inscrivez-vous ici</a>
        <input type="submit" class="submit" name="login " value="Connexion">
    </div>
</div>
</div>
</form>
<?php
$path = "../utile/";
 ?>


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
?>
</body>
</html>