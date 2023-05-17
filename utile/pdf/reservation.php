<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" type="text/css" href="../../assets/css/reservation.css">
</head>

<body>
    <style>
        header {
            white-space: nowrap;
        }

        header div {
            display: inline-block;
            width: 31%;
            box-sizing: border-box;
        }

        #mid {
            text-align: center;
        }

        #right {
            text-align: right;
        }

        table {
            border: 2px solid #050505;
            border-collapse: collapse;
            width: 100%;
        }

        table th {
            border: 2px solid #050505;
            background: #f0f0f0;
            color: #000000;
        }

        table td {
            border: 2px solid #050505;
            text-align: center;
            background: #ffffff;
            color: #313030;
        }

        .deter {
            width: 45%;
        }

        .userinfo {
            background-color: #F4FFB7;
        }

        .red {
            font-style: italic;
            color: red;
        }

        .separ {
            height: 30px;
            width: 100%;
            background-color: blue;
        }
    </style>
    <header>
        <div id="left">
            <img src="http://localhost/iut/Sae205/assets/ressources/utile/navimg/logo_iut.jpg" alt="logo" width="180px" height="40px" class="iut">

        </div>
        <div id="mid">
            <p>
                Demande d'accès à la salle VR (B212)
            </p>
        </div>
        <div id="right">
            <p>
                IUT de MEAUX<br>
                Département MMI
            </p>
        </div>
    </header>
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
    <p class="red">
        Il est obligatoire de respecter l’heure de remise des clés, un contrôle du matériel sera effectué juste après la remise

    </p>

    <br>
    <div class="separ"></div>
    <br>

    <table id="1">
        <?php
        foreach ($row as $row) {
        ?>
            <tr>
                <td class="deter">
                    Nom*:
                </td>
                <td class="userinfo"><?= $row['usernom'] ?></td>
            </tr>
            <tr>
                <td class="deter">
                    Prénom*:
                </td>
                <td class="userinfo"><?= $row['userprenom'] ?></td>
            </tr>

            <tr>
                <td class="deter">
                    Adresse mail*:
                </td>
                <td class="userinfo"><?= $row['email'] ?></td>
            </tr>

            <tr>
                <td class="deter">
                    Date d'accès souhaitée*: jj/mm/aaaa
                </td>
                <td class="userinfo"><?= $row['date'] ?></td>
            </tr>

            <tr>
                <td class="deter">
                    Heure d'accès*: (à partir de 08h30)
                </td>
                <td class="userinfo"><?= $row['horraire_debut'] ?></td>
            </tr>

            <tr>
                <td class="deter">
                    Heure de remise des Clés*: (jusqu'à 18h00 max)
                </td>
                <td class="userinfo"><?= $row['horraire_fin'] ?></td>
            </tr>
    </table>
<?php
        } ?>

<br>
<div class="separ"></div>
<br>
<table id="2">
    <tr>
        <th>Matériel souhaité</th>
        <th>Quantité souhaitée</th>
        <th>Quantité disponible</th>
        <th>Référence du matériel</th>
    </tr>
    <?php

    foreach ($row2 as $row2) {
    ?>
        <tr>
            <td><?= $row2["materiel_nom"] ?></td>
            <td class="userinfo"><?= $row2["id"] == $id ? '1' : '' ?></td>
            <td><?= $row2['quantite'] ?> </td>
            <td class="userinfo"><?= $row2['reference'] ?></td>
        </tr>
    <?php



    } ?>


</table>
</body>

</html>