<?php


/*
function execute($sql){
    require "config.php";
    try {
        $mysqlClient = new PDO(
            'mysql:host=' . $host . ';dbname=' . $dbname . ';charset=utf8',
            $user,
            $password,
            [PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION],
        );
    } catch (Exception $e) {
        die('Erreur : ' . $e->getMessage());
    }
    $recipesStatement = $mysqlClient->prepare($sql);
    $recipesStatement->execute();
    $recipes = $recipesStatement->fetchAll();
return $recipes;
}


/*foreach (execute('SELECT * FROM auteur') as $recipe) {
    echo '<p>'. $recipe['Nom']. '</p>';

}*/

?>