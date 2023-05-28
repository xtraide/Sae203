<?php
/*
function  execute($query){
    include "../utile/link/config.php";
    $connection = mysqli_connect($host, $username, $password, $dbname);
    if (mysqli_connect_errno()) {
        echo "Failed to connect to MySQL: " . mysqli_connect_error();
        exit();
    }else {
        $result = mysqli_query($connection, $query) or exit('Erreur SQL !<br />'.$sql.'<br />'.mysqli_error($connection));
        return    $result;
        mysqli_close($connection);
        mysqli_free_result($result);
    }
}
/*  $result = execute("SELECT * FROM auteur");
    if (mysqli_num_rows($result) > 0) {
        while ($row = mysqli_fetch_assoc($result)) {
            echo $row['Nom']."<br>";
        }
    } else {
        echo "No results found.";
    }s */
