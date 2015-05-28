<!DOCTYPE html>
<html lang="nl">		
<head>
	<title>Registreren</title>
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.4/css/bootstrap.min.css">
	<link rel="stylesheet" href="css/custom.css">
</head>
<body>
<?php
	require 'includes/connect.php';
	require 'includes/header.php';
?>
<div class="container-fluid">
	<div class="center-box">
		<h1>Verkoper worden <small>Vul hier uw gegevens in.</small></h1>

		<form action="query_verkoper_worden.php" method="post">
			<div class="form-group">
				<label> Gebruikersnaam: </label>
				<input type="text" class="form-control" maxlength="24" name="gebruikersnaam" placeholder="Uw gebruikersnaam mag bestaan uit letters en cijfers zonder spaties" />
			</div>
			
				
			<button type="submit" name="verkoper_worden" class="btn btn-primary">Verkoper worden</button><br><br>
		</form>
	</div>
</div>
<?php require 'includes/footer.php' ?>
</body>
</html>
