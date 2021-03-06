<!DOCTYPE html>
<html lang="nl">		
<head>
	<title>Activatie verkoper</title>
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.4/css/bootstrap.min.css">
	<link rel="stylesheet" href="//maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css">
	<link rel="stylesheet" href="css/custom.css">
</head>
<body>
<?php
	require 'includes/connect.php';
	require 'includes/functions.php';
	require 'includes/header.php';
?>
<div class="container-fluid">
	<div class="content no-nav">
		<div class="center-box">
			<h1>Activatiecode verkoper</h1>
			<form action="query_activate_verkoper.php" method="post">
				<div class="form-group">
					<label> Vul uw gebruikersnaam in. </label>
					<input type="text" class="form-control" name="gebruikersnaam" maxlength="24" placeholder="Gebruikersnaam" />
				</div>
				
				<div class="form-group">
					<label> Vul uw verkopers activatiecode in. </label>
					<input type="text" class="form-control" name="activatiecode_verkoper" maxlength="15" placeholder="Activatiecode" />
				</div>
					<button type="submit" class="btn btn-primary">Activeer</button>
			</form>
		</div>
	</div>
</div>
<?php require 'includes/footer.php' ?>
</body>
</html>
