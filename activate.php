<!DOCTYPE html>
<html lang="nl">		
<head>
	<title>Activatie</title>
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.4/css/bootstrap.min.css">
	<link rel="stylesheet" href="//maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css">
	<link rel="stylesheet" href="css/custom.css">
</head>
<body>
<?php
	require 'includes/connect.php';
	require 'includes/header.php';
?>
<div class="container-fluid">
	<div class="center-box">
		<h1>Activatiecode</h1>
		<form action="query_activate.php" method="post">
		
			<div class="form-group">
				<label> Vul uw gebruikersnaam in. </label>
				<input type="text" class="form-control" name="gebruikersnaam" placeholder="Gebruikersnaam" />
			</div>
			
			<div class="form-group">
				<label> Vul uw activatiecode in. </label>
				<input type="text" class="form-control" name="activatiecode" placeholder="Activatiecode" />
			</div>
				<button type="submit" class="btn btn-primary">Activeer</button>
		</form>
	</div>
</div>
<?php require 'includes/footer.php' ?>
</body>
</html>
