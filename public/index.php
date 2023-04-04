
    <?php
    include "../utile/html/header.php";
    include "../utile/link/config.php";
    include "../utile/link/link.php";
    $result = execute("SELECT * FROM auteur");
    if (mysqli_num_rows($result) > 0) {
        // Loop through each row of the result
        while ($row = mysqli_fetch_assoc($result)) {
            // Access the data for each row using the associative array $row
            echo $row['Nom']."<br>";
        }
    } else {
        echo "No results found.";
    }

    // Free up the result set
    mysqli_free_result($result);

    ?>
    <form action="index.php" method="post">
        <input type="text" name="nom">
        <input type="text" name="email" id="">
        <input type="Submit">
    </form>


    <?php
    echo "Albert Higon";
    if (!empty($_POST['nom']) && !empty($_POST['email'])) {

        execute("Update auteur set email='" . $_POST['email'] . "' WHERE Nom='".$_POST['nom']."'");
        
    }
    include "../utile/html/footer.php";
    ?>
    <script type="text/javascript" src="../assets/js/script.js"></script>
