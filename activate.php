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
	require 'includes/functions.php';
	require 'includes/header.php';
?>
<div class="container-fluid">
	<div class="content no-nav">
		<?php if (isset($_GET['mail'])) { ?>
		<div class="center-box">
			<h3><small>Bedankt voor uw registratie! U heeft een activatiemail ontvangen op <?=$_GET['mail'];?> . Hierin staat een activatiecode die u kunt invullen op <a href="activate.php">http://iproject27.icasites.nl/activate.php</a></small></h3>
		</div>
		<?php } ?>
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
</div>
<?php require 'includes/footer.php' ?>
</body>
</html>
