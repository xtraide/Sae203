<?php $path =   "../utile/";
$css = str_replace(".php", "", basename(__FILE__));
include $path . "html/header.php"; ?>
<div class="compteInfo">
    <table>
        <?php
        $result = execute("SELECT nom,prenom,date,email FROM utilisateur WHERE id = :id", [
            "id" => $_COOKIE['id']
        ]);
        while ($row = $result->fetchAll(PDO::FETCH_ASSOC)) {
            foreach ($row as $row) {
        ?>
                <tr>
                    <td>Nom</td>
                    <td><?= $row['nom']; ?></td>
                </tr>
                <tr>
                    <td>Prenom</td>
                    <td><?= $row['prenom']; ?></td>
                </tr>
                <tr>
                    <td>Date de naissance</td>
                    <td><?= $row['date']; ?></td>
                </tr>
                <tr>
                    <td>Email</td>
                    <td><?= $row['email']; ?></td>
                </tr>
        <?php
            }
        }
        ?>
    </table>
</div>


<button onclick="<?php suprUnUser($_COOKIE['id']); ?>">Suprimer votre compte</button>
<?php
function suprUnUser(string $idUser)
{
    execute("DELETE  FROM `utilisateur` WHERE id = :id", [
        "id" => $idUser
    ]);
}
include $path . "html/footer.php";
