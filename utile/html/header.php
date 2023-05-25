<!DOCTYPE html>
<html>

<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="stylesheet" type="text/css" href="../assets/css/all.css">
	<link rel="stylesheet" type="text/css" href="../assets/css/nav.css">
	<link rel="stylesheet" type="text/css" href="../assets/css/<?= $css ?>.css">
	<title>SAE 203</title>
</head>

<body>
	<?php
	include "../utile/link/linkPdo.php";
	include "../utile/function.php";
	?>
	<header>
		<?php include_once("nav.php");
		?>
	</header>
	<?php
	session_start();

	if (!array_key_exists('verified', $_SESSION)) {

		if (empty($_COOKIE['id'])) {

			header("Location: login.php");
	?>
			<script>
				alert("vous devez etre connecter pour utiliser cette page vous allez etre rediriger vers la page de connection ")
			</script>

			<?php

		} else {

			$result = execute("SELECT * FROM `utilisateur` WHERE id = :id", [
				"id" => $_COOKIE['id']
			]);
			while ($row = $result->fetchAll(PDO::FETCH_ASSOC)) {
				foreach ($row as $row) {

					if ($row['verified'] != 1) {
			?>
						<script>
							alert("vous devez verifier votre adresse mail  pour utiliser cette page vous allez etre rediriger vers la page de connection ")
						</script>
	<?php

					} else {
						echo $_SESSION['verified'], $_COOKIE['id'];

						$_SESSION['verified'] = 1;
					}
				}
			}
		}
	}
