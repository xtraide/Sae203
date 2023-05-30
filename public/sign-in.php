<link rel="stylesheet" href="../assets/css/sign-in.css">
<img src="../assets/ressources/utile/fond.png" alt="background" class="background">


<?php
$path =   "../utile/";
$css = str_replace(".php", "", basename(__FILE__));


?>

<form action="<?= basename(__FILE__); ?>" method="post">
    <div class="container">
        <div>
        </div>
        <div class="gradient">
            <div class="sign-up-wraper">
                <div class="sign-up" id="sign">
                    <h2 class="sign-up">Inscription</h2>
                    <div class="input-box">
                        <label for="email">Email : </label>
                        <img src="../assets/ressources/utile/navimg/mail.png" alt="Email" class="imges" width="20px" height="20px">
                        <input type="text" name="email" id="" class="input" placeholder="exemple@gmail.com" value="<?= !empty($_POST['email']) ?  $_POST['email'] : '' ?>">
                        <div class="eremail" class="erreur"></div>
                    </div>

                    <div class="input-box">
                        <label for="Nom ">Nom:</label>
                        <input type="text" class="input" placeholder="Nom" name="nom" value="<?= !empty($_POST['nom']) ?  $_POST['nom'] : '' ?>">
                        <div class="ernom" class="erreur"></div>
                    </div>

                    <div class="input-box">
                        <label for="prenom">Prenom : </label>
                        <input type="text" placeholder="Prénom" class="input" name="prenom" value="<?= !empty($_POST['prenom']) ?  $_POST['prenom'] : '' ?>">
                        <div class="erprenom" class="erreur"></div>
                    </div>

                    <div class="input-box">
                        <label for="date">Date de naissance : </label>
                        <input type="date" placeholder="Date de naissance" class="input" name="date" value="<?= !empty($_POST['date']) ?  $_POST['date'] : '' ?>">
                        <div class="erdate" class="erreur"></div>
                    </div>

                    <div class="input-box">
                        <label for="mdp">Mot de passe : </label>
                        <img src="../assets/ressources/utile/navimg/pws.png" alt="Pasword" width="20px" height="20px" class="imges">
                        <input type="password" placeholder="Mot de passe de 6 caracteres" class="input" name="mdp" value="<?= !empty($_POST['mdp']) ?  $_POST['mdp'] : '' ?>">
                        <div class="ermdp" class="erreur"></div>
                    </div>

                    <div class="input-box">
                        <label for="confimmdp">Confirmation de mot de passe : </label>
                        <img src="../assets/ressources/utile/navimg/pws.png" alt="Pasword" width="20px" height="20px" class="imges">
                        <input type="password" placeholder="Mot de passe de 6 caracteres" class="input" name="validmdp" value="<?= !empty($_POST['validmdp']) ?  $_POST['validmdp'] : '' ?>">
                        <div class="validmdp" class="erreur"></div>
                    </div>
                    <div class="forgot" class="erreur">
                        <a href="login.php" class="forgot">Deja un compte connecter vous</a>
                    </div>

                    <input type="submit" class="submit" name="submit" value="Créer son compte">
                </div>
            </div>
            <div>
                <img src="../assets/ressources/utile/iconorange.png" alt="" height="400px" class="conexion">
            </div>
        </div>
    </div>
</form>
<?php

if (!empty($_POST['submit']) && $_POST['submit'] == "Créer son compte") {

    include $path . 'function.php';
    include $path . 'link/linkPdo.php';
    $nom = isValid('nom');
    $prenom = isValid('prenom');
    $date = isValid('date');
    $email = isValid('email');
    $mdp = isValid('mdp');
    if (!empty($nom) && !empty($prenom) && !empty($date) && !empty($email) && !empty($mdp)) {

        $mdp = crypte($mdp);
        execute("INSERT INTO `utilisateur`(`nom`, `prenom`, `date`, `email`, `mdp`, `role`) VALUES (:nom,:prenom,:date,:email,:mdp,'utilisateur');", [
            'nom' => $nom,
            'prenom' => $prenom,
            'date' => $date,
            'email' => $email,
            'mdp' => $mdp
        ]);
        $result = execute("SELECT MAX(id) as id FROM utilisateur;");
        include $path . "mail/mail.php";
        while ($row = $result->fetchAll(PDO::FETCH_ASSOC)) {
            foreach ($row as $row) {
                $token = md5(uniqid(rand(), true));
                setcookie('token', $token, time() + 604800, "/");
                sendmail(
                    $email,
                    "Confirmation d'adresse email",
                    "cliquer ici pour activer votre compte
                    <a href=`http://localhost/iut/Sae205/utile/function/verif.php?id=`" . $row['id'] . "`&token=`" . $token . ">test</a>
                    "
                );
            }
        }

        echo "votre compte doit etre verifier pour pouvoir vous y connecter ";
    }
}
include $path . "html/footer.php";