<?php
$path =   "../utile/";
include $path . 'link/linkPdo.php';
include $path . 'function.php';
?>
<a href="login.php">Deja un compte connecter vous</a>
<form action="<?= basename(__FILE__); ?>" method="post">
    <label for="Nom ">Nom:</label>
    <input type="text" placeholder="Nom" name="nom" value="<?= !empty($_POST['nom']) ?  $_POST['nom'] : '' ?>">
    <div class="ernom"></div>
    <label for="prenom">Prenom : </label>
    <input type="text" placeholder="Prénom" name="prenom" value="<?= !empty($_POST['prenom']) ?  $_POST['prenom'] : '' ?>">
    <div class="erprenom"></div>
    <label for="email">Email : </label>
    <input type="text" name="email" id="" placeholder="exemple@gmail.com" value="<?= !empty($_POST['email']) ?  $_POST['email'] : '' ?>">
    <div class="eremail"></div>
    <label for="date">Date de naissance : </label>
    <input type="date" placeholder="Date de naissance" name="date" value="<?= !empty($_POST['date']) ?  $_POST['date'] : '' ?>">
    <div class="erdate"></div>
    <label for="mdp">Mot de passe : </label>
    <input type="password" placeholder="Mot de passe de 6 caracteres" name="mdp" value="<?= !empty($_POST['mdp']) ?  $_POST['mdp'] : '' ?>">
    <div class="ermdp"></div>
    <label for="confimmdp">Confirmation de mot de passe : </label>
    <input type="password" placeholder="Mot de passe de 6 caracteres" name="validmdp" value="<?= !empty($_POST['validmdp']) ?  $_POST['validmdp'] : '' ?>">
    <div class="validmdp"></div>
    <input type="submit" name="submit" value="Créer son compte">
</form>
<?php

if (!empty($_POST['submit']) && $_POST['submit'] == "Créer son compte") {
    $nom = isvalid('nom');
    $prenom = isvalid('prenom');
    $date = isvalid('date');
    $email = isvalid('email');
    $mdp = isvalid('mdp');
    if (!empty($nom) && !empty($prenom) && !empty($date) && !empty($email) && !empty($mdp)) {
        $mdp = crypte($mdp);
        execute("INSERT INTO `utilisateur`(`nom`, `prenom`, `date`, `email`, `mdp`, `role`) VALUES (:nom,:prenom,:date,:email,:mdp,'utilisateur');", [
            'nom' => $nom,
            'prenom' => $prenom,
            'date' => $date,
            'email' => $email,
            'mdp' => $mdp
        ]);
        //header("Location: login.php");// A SU¨PRIMER
    }
}
