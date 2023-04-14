<?php


/*
function execute($sql){
    try {
        $db = new PDO(
            'mysql:host=localhost;dbname=coursphp;charset=utf8',
            'root'
        );
        $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    } catch (Exception $e) {
        die(print_r($e));
    }

    if (array_key_exists('username', $_POST) && $_POST['username'] != null && array_key_exists('score', $_POST) && $_POST['score'] != null) {
        $sql = 'INSERT INTO leaderboard(username, score, createdAt) VALUES (:username, :score, current_timestamp())';
        $insertScore = $db->prepare($sql);
        //var_dump($json['score']);
        $sqlParams = [
            'username' => $_POST["username"],
            'score' => $_POST["score"]
        ];
        $insertScore->execute($sqlParams) or die($db->errorInfo());
        echo "Ajout du score confirmé pour {$_POST["username"]} avec un score de {$_POST["score"]}";
    }
return $recipes;
}


/*foreach (execute('SELECT * FROM auteur') as $recipe) {
    echo '<p>'. $recipe['Nom']. '</p>';

}*/

?>