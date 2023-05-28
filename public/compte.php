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
                    <td class="gauche">Nom</td>
                    <td class="droite"><?= $row['nom']; ?></td>
                </tr>
                <tr>
                    <td class="gauche">Prenom</td>
                    <td><?= $row['prenom']; ?></td>
                </tr>
                <tr>
                    <td class="gauche">Date de naissance</td>
                    <td class="droite"><?= $row['date']; ?></td>
                </tr>
                <tr>
                    <td class="gauche">Email</td>
                    <td class="droite"><?= $row['email']; ?></td>
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
