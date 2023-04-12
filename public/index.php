<?php
$path =   "../utile/";
include $path . "html/header.php";
include $path . "link/link.php";
if (!empty($_COOKIE['id'])) {

    $result = execute("Select role from utilisateur where id ='" . $_COOKIE['id'] . "';");

    if (mysqli_num_rows($result) > 0) {
        while ($row = mysqli_fetch_assoc($result)) {
            $_SESSION['role'] = $row['role'];
        }
    }

    if ($_SESSION['role'] == 'admin') {
        echo "c qui le patron bah c toi ";
    }
    $result = execute("SELECT * FROM utilisateur");
    if (mysqli_num_rows($result) > 0) {
        // Loop through each row of the result
        while ($row = mysqli_fetch_assoc($result)) {
            // Access the data for each row using the associative array $row
            //echo $row['Nom']."<br>";
        }
    } else {
        echo "No results found.";
    }
?>
    <form action="index.php" method="post">
        <input type="text" name="nom">
        <input type="text" name="email" id="">
        <input type="Submit">
    </form>


    <?php
    echo "Albert Higon";
    if (!empty($_POST['nom']) && !empty($_POST['email'])) {

        execute("Update auteur set email='" . $_POST['email'] . "' WHERE Nom='" . $_POST['nom'] . "'");
    }
} else {
    ?>
    <script>
        alert("vous devez etre connecter pour utiliser cette page vous allez etre rediriger vers la page de connection ")
    </script>

<?php
    header("Location: login.php");
}

include "../utile/html/footer.php";
?>