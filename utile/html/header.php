<!DOCTYPE html>
<html>

<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="stylesheet" type="text/css" href="../assets/css/style.css">
	<title>SAE 203</title>
</head>

<body>
	<header>
		<h2>CA C'EST POUR TOI MON KILLIAN </h2>
	</header>
	<?php
	if (empty($_COOKIE['id'])) {
		header("Location: login.php");
	?>
		<script>
			alert("vous devez etre connecter pour utiliser cette page vous allez etre rediriger vers la page de connection ")
		</script>

	<?php
	}
