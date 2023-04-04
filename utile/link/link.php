<?php 


function execute($query) {
    include "../utile/link/config.php";
    $connection = mysqli_connect($host, $username, $password, $database);
    if (mysqli_connect_errno()) {
        echo "Failed to connect to MySQL: " . mysqli_connect_error();
        exit();
    }
    $result = mysqli_query($connection, $query) or exit('Erreur SQL !<br />'.$sql.'<br />'.mysqli_error($connection));
    mysqli_close($connection);
    return $result;
}


?>