<?php
$path =   "../utile/";
include "../utile/html/header.php";
?>
<input type="text" placeholder="nom" name="nom" value="<?php if (!empty($_POST['nom'])) {echo $_POST['nom'];} ?>">
<input type="text" placeholder="prenom" name="prenom" value="<?php if (!empty($_POST['prenom'])) {echo $_POST['prenom'];} ?>">
<input type="email" name="email" id="" placeholder="exemple@gmail.com" value="<?php if (!empty($_POST['email'])) {echo $_POST['email'];} ?>">
<input type="text" placeholder="date" name="date" value="<?php if (!empty($_POST['date'])) {echo $_POST['date'];} ?>">
<input type="text" placeholder="password" name="password" value="<?php if (!empty($_POST['password'])) {echo $_POST['password'];} ?>">
<?php
require $path . 'function.php';
$nom = isempty('nom');
$prenom = isempty('prenom');
$date = isempty('date');
$email = isempty('email');
$password = isempty('password');
if (!empty($nom) && !empty($prenom) && !empty($date) && !empty($email) && !empty($password)) {
    include $path . 'link/link.php';
    execute("Insert into compte('nom','prenom','date','email',password) value('" . $nom . "','" . $prenom . "','" . $date . "','" . $email . "','" . crypt($password) . "');");
    header("Location : index.php");
}


include $path . "html/footer.php"; ?>