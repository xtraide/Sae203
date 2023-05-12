<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../assets/css/login.css">
    <title>Document</title>
</head>
<body>
    
</body>
</html>
<form action="<?= basename(__FILE__); ?>" method="post">
<div class="gradient">
<div class="sign-up-wraper">
    <div class="sign-up" id="sign">
        <h2 class="sign-up">Inscription</h2>
        <div class="input-box">
            <span>Email</span>
            <img src="../assets/ressources/login_&_sign-in/mail.png" alt="Email" class="imges" width="20px" height="20px">
            <input type="email" class="input" placeholder="Entrer votre Email" placeholder="Nom" name="email" value="<?= !empty($_POST['nom']) ?  $_POST['nom'] : '' ?>">
            <div class="eremail" class="erreur"></div>
        </div>

        <div class="input-box">
            <span>Nom</span>
            <input type="text" class="input" placeholder="Entrer votre Nom" name="nom" value="<?= !empty($_POST['nom']) ?  $_POST['nom'] : '' ?>">
            <div class="ernom" class="erreur"></div>
        </div>

        <div class="input-box">
            <span>Prénom</span>
            <input type="text" placeholder="Prénom" class="input" placeholder="Entrer votre Prénom" name="prenom" value="<?= !empty($_POST['prenom']) ?  $_POST['prenom'] : '' ?>">
            <div class="erprenom" class="erreur"></div>
        </div>
       
        <div class="input-box">
            <span>date de naissance</span>
            <input type="date" placeholder="Date de naissance" class="input" name="date" value="<?= !empty($_POST['date']) ?  $_POST['date'] : '' ?>">
            <div class="erdate" class="erreur"></div>
        </div>

        <div class="input-box">
            <span>Mot de passe</span>
            <img src="../assets/ressources/login_&_sign-in/pws.png" alt="Pasword" width="20px" height="20px" class="imges">
            <input type="password" class="input" placeholder="Mot de passe de 6 caracteres" name="mdp" value="<?= !empty($_POST['mdp']) ?  $_POST['mdp'] : '' ?>">
            <div class="ermdp" class="erreur"></div>
        </div>

        <div class="input-box">
            <span>Confirmer le mot de passe</span>
            <img src="../assets/ressources/login_&_sign-in/pws.png" alt="Pasword" width="20px" height="20px" class="imges" >
            <input type="password" class="input" placeholder="Confirmer votre mot de passe" name="validmdp" value="<?= !empty($_POST['validmdp']) ?  $_POST['validmdp'] : '' ?>">
            <div class="validmdp"></div>
        </div>
        <div class="forgot" class="erreur">
        <a href="login.php" class="forgot">Deja un compte connecter vous</a>
        </div>

        <input type="submit" class="submit" name="submit" value="Créer son compte">
    </div>
</div>
</div>
</form>


<?php
$path = "../utile/";
?>


<?php
$path =   "../utile/";
include $path . 'link/linkPdo.php';
include $path . 'function.php';
?>

<?php

if (!empty($_POST['submit']) && $_POST['submit'] == "Créer son compte") {
    $nom = isvalid('nom');
    $prenom = isvalid('prenom');
    $date = isvalid('date');
    $email = isvalid('email');
    $mdp = isvalid('mdp');
    if (!empty($nom) && !empty($prenom) && !empty($date) && !empty($email) && !empty($mdp)) {
        $mdp = crypte($mdp);
        execute("INSERT INTO `utilisateur`(`nom`, `prenom`, `date`, `email`, `mdp`, `role`) VALUES (:nom,:prenom,:date,:email,:mdp,utilisateur);", [
            'nom' => $nom,
            'prenom' => $prenom,
            'date' => $date,
            'email' => $email,
            'mdp' => $mdp
        ]);
        //header("Location: login.php");// A SU¨PRIMER
    }
}
?>
