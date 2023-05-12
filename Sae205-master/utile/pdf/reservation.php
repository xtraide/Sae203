<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

<body>
    <div class="logo"><img src="../../assets/ressources/utile/iutLogo.png" alt="logo"></div>
    <h1>Rapport de reservation de materiel</h1>
    <h3>Information materiel</h3>
    <table style="
    border-bottom: solid;
    border-top :solid;
    ">
        <tr>
            <th>Id</th>
            <th>Nom</th>
            <th>Type</th>
            <th>Reference</th>
        </tr>
        <tr>
            <td>$row['id'] </td>
            <td>$row['nom'] </td>
            <td>$row['type'] </td>
            <td>$row['reference'] </td>
        </tr>
    </table>
    <h3>Information utilisateur</h3>
    <table style="
    border-bottom: solid;
    border-top :solid;
    ">
        <tr>
            <th>Id</th>
            <th>Nom</th>
            <th>Prenom</th>
        </tr>
        <tr>
            <td>$row['id'] </td>
            <td>$row['nom'] </td>
            <td>$row['type'] </td>
            <td>$row['reference'] </td>
        </tr>
    </table>
    <h2>pour le 18/02 </h2>
    <h2>de 18:00 a 20:00 </h2>
</body>

</html>