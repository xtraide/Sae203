<?php
$path =   "../utile/";
include "../utile/html/header.php";
?>
<form action="sign-in.php" method="post">
    Nom: <input type="text" placeholder="Nom" name="nom" value="<?= !empty($_POST['nom']) ?  $_POST['nom'] : '' ?>">
    <div class="ernom"></div>
    Prenom: <input type="text" placeholder="Prenom" name="prenom" value="<?= !empty($_POST['prenom']) ?  $_POST['prenom'] : '' ?>">
    <div class="erprenom"></div>
    Email: <input type="email" name="email" id="" placeholder="exemple@gmail.com" value="<?= !empty($_POST['email']) ?  $_POST['email'] : '' ?>">
    <div class="eremail"></div>
    Date de naissance: <input type="date" placeholder="Date" name="date" value="<?= !empty($_POST['date']) ?  $_POST['date'] : '' ?>">
    <div class="erdate"></div>
    Mot de passe: <input type="password" placeholder="Mot de passe de 6 caractere" name="mdp" value="<?= !empty($_POST['password']) ?  $_POST['password'] : '' ?>">
    <div class="ermdp"></div>
    Confirmation de mot de passe: <input type="password" placeholder="Mot de passe de 6 caractere" name="validmdp" value="">
    <div class="validmdp"></div>
    <input type="submit" name="submit" value="Creé son compte">
</form>
<?php
if (!empty($_POST['submit']) && $_POST['submit'] == "Creé son compte") {
    require $path . 'function.php';
    $nom = isvalid('nom');
    $prenom = isvalid('prenom');
    $date = isvalid('date');
    $email = isvalid('email');
    $mdp = isvalid('mdp');
    if (!empty($nom) && !empty($prenom) && !empty($date) && !empty($email) && !empty($mdp)) {
        include $path . 'link/link.php';
            execute("INSERT INTO `utilisateur`(`nom`, `prenom`, `date`, `email`, `mdp`, `role`) VALUES ('" . $nom . "','" . $prenom . "','" . $date . "','" . $email . "','" . crypte($mdp) . "','admin');");
            //header("Location: login.php"); A SU¨PRIMER

    }
}

include $path . "html/footer.php"; ?>