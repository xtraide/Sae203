<?php
$path =   "../utile/";
include $path . "html/header.php";
include $path . "link/linkPdo.php";
session_start();
if (!empty($_SESSION['role'])) {
    if ($_SESSION['role'] == 'admin') {
        echo "c qui le patron bah c toi ";
    }
    $result = execute("SELECT * FROM utilisateur");
    if ($result->rowCount() > 0) {
        // Loop through each row of the result
        foreach ($result as $row) {
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