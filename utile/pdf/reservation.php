<?php $materielId = 165 ?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

<body>
    <h3>
        Adressez par mail cette demande d’accès à la salle VR 2 jours ouvrés avant la date d’accès souhaitée à:<br>
        M. ZAIDI Fares, enseignant responsable de la salle VR: fares.zaidi@univ-eiffel.fr<br>
        et mettez en copie Mme Jean-Louis: chantal.jean-louis@univ-eiffel.fr<br>
    </h3>
    <h3>
        <p>
            Nom et prénom de l’étudiant référent, qui se chargera de récupérer et de remettre les clés de la
            salle à l'accueil, il est tenu responsable du matériel lors de l'utilisation de la salle VR.
            En quittant cette dernière, il doit s’assurer de remettre le matériel à sa place, et de bien fermer la
            porte à clé
        </p>
    </h3>
    <style>
        table {
            border: 2px solid #050505;
            border-collapse: collapse;
            padding: 100%;
        }

        table th {
            border: 2px solid #050505;
            padding: 10px;
            background: #f0f0f0;
            color: #000000;
        }

        table td {
            border: 2px solid #050505;
            text-align: center;
            padding: 15px;
            background: #ffffff;
            color: #313030;
        }
    </style>
    <table>
        <tr>
            <td>
                Nom*:
            </td>
            <td>
                <?= $row['usernom']; ?>
            </td>
        </tr>
        <tr>
            <td>
                Prénom*:
            </td>
            <td>
                <?= $row['userprenom']; ?>
            </td>
        </tr>


    </table>
    <table>
        <tr>
            <th>Matériel souhaité</th>
            <th>Quantité souhaitée</th>
            <th>Quantité disponible</th>
            <th>Référence du matériel</th>
        </tr>
        <?php


        foreach ($row as $row) {
        ?>
            <tr>
                <td><?= $row['nom'] ?></td>
                <td><?= $row['id'] == $materielId ? '1' : '' ?></td>
                <td><?= $row['quantite'] ?> </td>
                <td><?= $row['reference'] ?></td>
            </tr>
        <?php
        }
        ?>
    </table>
</body>

</html>