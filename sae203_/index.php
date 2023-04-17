<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="index.css">
    <title>index</title>
</head>

<body>
<!--
    <form action="index.php" method="post">
        <div class="gradient">
            <div class="sign-up-wraper">
                <div id="sign" class="sign-up">
                    <h2 class="sign-up">Connexion</h2>
                    <div class="input-box">
                        <span>Email</span>
                        <img src="../premiere page/mail.png" alt="Email" class="imgs" width="20px" height="20px">
                        <input type="text" class="input" placeholder="Entrer votre Email" name="email" value="<?= !empty($_POST['email']) ?  $_POST['email'] : '' ?>">
                        <div class="eremail"></div>
                    </div>
                    <div class="input-box">
                        <span>Mot de passe</span>
                        <img src="../premiere page/pws.png" alt="Pasword" width="20px" height="20px" class="imgs">
                        <input type="password" class="input" placeholder="Entrer votre mot de passe" name="mdp" value="<?= !empty($_POST['mdp']) ?  $_POST['mdp'] : '' ?>">">
                        <div class="ermdp"></div>
                    </div>
                    <a class="forgot" href="#">mot de passe oublier</a>
                    <a class="forgot" href="#">Pas de compte ? Inscrivez-vous ici</a>
                    <button class="submit" name="submit" value="Créer son compte">Envoyer</button>
                </div>
            </div>

-->
            <div class="gradient"></div>
            <div class="sign-up-wraper">
                <div class="sign-up" id="sign">
                    <h2 class="sign-up">Inscription</h2>
                    <div class="input-box">
                        <span>Email</span>
                        <img src="../premiere page/mail.png" alt="Email" class="imgs" width="20px" height="20px">
                        <input type="text" class="input" placeholder="Entrer votre Email" name="email" value="<?= !empty($_POST['email']) ?  $_POST['email'] : '' ?>">
                        <div class="eremail"></div>
                    </div>
                    <div class="input-box">
                        <span>Nom</span>

                        <input type="text" class="input" placeholder="Entrer votre Nom" name="nom" value="<?= !empty($_POST['nom']) ?  $_POST['nom'] : '' ?>">
                        <div class="ernom"></div>
                    </div>
                    <div class="input-box">
                        <span>Prénom</span>

                        <input type="text" class="input" placeholder="Entrer votre Prénom" value="<?= !empty($_POST['prenom']) ?  $_POST['prenom'] : '' ?>">
                        <div class="erprenom"></div>
                    </div>
                    <div class="input-box">
                        <span>date de naissance</span>
                        <input type="date" class="input" placeholder="JJ/MM/AA" name="date" value="<?= !empty($_POST['date']) ?  $_POST['date'] : '' ?>">
                        <div class="erdate"></div>
                    </div>
                    <div class="input-box">
                        <span>Mot de passe</span>
                        <img src="../premiere page/pws.png" alt="Pasword" width="20px" height="20px" class="imgs">
                        <input type="password" class="input" placeholder="Entrer votre mot de passe" name="mdp" value="<?= !empty($_POST['mdp']) ?  $_POST['mdp'] : '' ?>">
                        <div class="ermdp"></div>
                    </div>
                    <div class="input-box">
                        <span>Confirmer le mot de passe</span>
                        <img src="../premiere page/pws.png" alt="Pasword" width="20px" height="20px" class="imgs">
                        <input type="password" class="input" placeholder="Confirmer le mot de passe" name="validmdp" value="<?= !empty($_POST['validmdp']) ?  $_POST['validmdp'] : '' ?>">
                        <div class="ervalidmdp"></div>
                    </div>
                    <button class="submit"  name="submit"value="Créer son compte">Envoyer</button>
                </div>
            </div>
        </div>
    </form>


    <?php
    $path =   "../utile/";
    include "../utile/html/header.php";
    include $path . 'link/linkPdo.php';
    include $path . 'function.php';

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
    include $path . "html/footer.php"; ?>