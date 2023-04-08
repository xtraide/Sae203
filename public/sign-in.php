<?php
$path =   "../utile/";
include "../utile/html/header.php";
?>
<form action="sign-in.php" method="post">
    Nom: <input type="text" placeholder="Nom" name="nom" value="<?php if (!empty($_POST['nom'])) {echo $_POST['nom'];} ?>">
        <div class="ernom"></div>
    Prenom: <input type="text" placeholder="Prenom" name="prenom" value="<?php if (!empty($_POST['prenom'])) {echo $_POST['prenom'];} ?>">
        <div class="erprenom"></div>
    Email: <input type="email" name="email" id="" placeholder="exemple@gmail.com" value="<?php if (!empty($_POST['email'])) {echo $_POST['email'];} ?>">
        <div class="eremail"></div>
    Date de naissance: <input type="date" placeholder="Date" name="date" value="<?php if (!empty($_POST['date'])) {echo $_POST['date'];} ?>">
        <div class="erdate"></div>
    Mot de passe: <input type="text" placeholder="Mot de passe de 6 caractere" name="mdp" value="<?php if (!empty($_POST['mdp'])) {echo $_POST['mdp'];} ?>">
        <div class="ermdp"></div>
    <input type="submit" name="submit" value="Creé son compte">
</form>
<?php
if(!empty($_POST['submit'])&& $_POST['submit'] == "Creé son compte"){
    require $path . 'function.php';
    $nom = isvalid('nom');
    $prenom = isvalid('prenom');
    $date = isvalid('date');
    $email = isvalid('email');
    $mdp = isvalid('mdp');
        if (!empty($nom) && !empty($prenom) && !empty($date) && !empty($email) && !empty($mdp)) {
                include $path . 'link/link.php';
                execute("Insert into compte('nom','prenom','date','email','mdp') value('" . $nom . "','" . $prenom . "','" . $date . "','" . $email . "','" . crypte($mdp) . "');");
                header("Location: index.php");
            }
        }
include $path . "html/footer.php"; ?>