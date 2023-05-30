<!DOCTYPE html>
<html>

<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="stylesheet" type="text/css" href="../assets/css/all.css">
	<link rel="stylesheet" type="text/css" href="../assets/css/nav.css">
	<link rel="stylesheet" type="text/css" href="../assets/css/<?= $css ?>.css">
	<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
	<title>SAE 203</title>
</head>

<body>
	<img src="../assets/ressources/utile/fond.png" alt="background" class="background">
	<?php
	include "../utile/link/linkPdo.php";
	include "../utile/function.php";
	session_start();
	if (empty($_COOKIE['id'])) {
	?>
		<script>
			alert("vous devez etre connecter pour utiliser cette page vous allez etre rediriger vers la page de connection ")
		</script>
		<?php
		header("Location: login.php");
	}
	if (!array_key_exists('verified', $_SESSION)) {
		$result = execute("SELECT verified FROM `utilisateur` WHERE id = :id", [
			"id" => $_COOKIE['id']
		]);
		while ($row = $result->fetchAll(PDO::FETCH_ASSOC)) {
			foreach ($row as $row) {
				if ($row['verified'] == 1) {
					$_SESSION['verified'] = 1;
				} else {
		?>
					<script>
						alert("vous devez verifier votre adresse mail  pour utiliser cette page vous allez etre rediriger vers la page de connection ")
					</script>
	<?php
					header("Location: login.php");
				}
			}
		}
	}
	?>
	<header>
		<?php include_once("nav.php");
		?>
	</header>