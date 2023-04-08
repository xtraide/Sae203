<?php
$path = "../utile/";
include $path."html/header.php"; ?>
<form action="login.php">
Email: <input type="email" placeholder="exemple@gmail.com" name="email" value="<?php if(!empty($_POST['email'])){echo $_POST['email'];} ?>">
  <div class="eremail"></div>
Mot de pass: <input type="password" placeholder="Mot de passe de 6 caractere" name="password"value="<?php if (!empty($_POST['password'])) {echo $_POST['password'];}?>">
  <div class="ermdp"></div>
  <input type="submit">
  <div class="er"></div>
</form>
<?php
include $path . "link/link.php";
include $path . "function.php";
$email = isvalid($_POST['email']);
$password = isvalid($_POST['password']);
if (!empty($email) && !empty($password)) {
  $result = execute("Select * from compte where email = '" . $email . "' AND password ='" . crypte($password) . "';");
  if (!empty($result)) {
    setcookie("userId", $result['userId'], time() + 604800, '/');
    header('Location: index.php');
  } else {
    ?> 
        <script type="text/javascript">
            document.getElementsByClassName('er')[0].innerHTML = "l'email ou le Mot de pass est incorect";
        </script>
    <?php
  }
}
include $path . "html/footer.php"; ?>