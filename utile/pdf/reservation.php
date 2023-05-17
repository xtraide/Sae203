<?php $materielId = 165 ?>
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
            width: 30%;
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
            <img src="https://cdn.discordapp.com/attachments/1086329363265490967/1108160527965896811/logo_iut.jpg" alt="" height="65px" class="iut">

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
        <tr>
            <td class="deter">
                Nom*:
            </td>
            <td class="userinfo"><?= 'usernom' ?></td>
        </tr>
        <tr>
            <td class="deter">
                Prénom*:
            </td>
            <td class="userinfo"><?= 'userprenom' ?></td>
        </tr>

        <tr>
            <td class="deter">
                Adresse mail*:
            </td>
            <td class="userinfo"><?= 'userprenom' ?></td>
        </tr>

        <tr>
            <td class="deter">
                Date d'accès souhaitée*: jj/mm/aaaa
            </td>
            <td class="userinfo"><?= 'userprenom' ?></td>
        </tr>

        <tr>
            <td class="deter">
                Heure d'accès*: (à partir de 08h30)
            </td>
            <td class="userinfo"><?= 'userprenom' ?></td>
        </tr>

        <tr>
            <td class="deter">
                Heure de remise des Clés*: (jusqu'à 18h00 max)
            </td>
            <td class="userinfo"><?= 'userprenom' ?></td>
        </tr>
    </table>
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



        ?>
        <tr>
            <td><?= "nom" ?></td>
            <td class="userinfo"><?= "id" == $materielId ? '1' : '' ?></td>
            <td><?= 'quantite' ?> </td>
            <td class="userinfo"><?= 'reference' ?></td>
        </tr>
        <?php

        ?>
    </table>
</body>

</html>