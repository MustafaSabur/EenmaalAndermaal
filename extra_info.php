<!DOCTYPE html>
<html lang="nl">
<head>
	<title>Productpagina</title>
	<meta charset="utf-8">
  	<meta name="viewport" content="width=device-width, initial-scale=1">
  	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.4/css/bootstrap.min.css">
 	<link rel="stylesheet" href="css/custom.css">
 	<link rel="stylesheet" href="css/product-box.css">
 	<link rel="stylesheet" href="css/artikel.css">
 	<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.2/jquery.min.js"></script>
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.4/js/bootstrap.min.js"></script>
	<script src="js/main.js"></script>
</head>
<body>
<?php 
	require 'includes/connect.php';
	require 'includes/functions.php';
	require 'includes/header.php'; 
	require 'includes/zoekbalk.php' ;
	

	
	if(!isset($_SESSION['loginnaam']))
	{	
		echo '<div class = "center-box">';
		echo 'U moet eerst inloggen voordat u een vraag kan stellen';
		echo '</div>';
	}
	else
	{
		$voorwerp = $_GET['voorwerpID'] ;
		$sql = "SELECT titel, verkoper FROM voorwerp WHERE voorwerpnummer = $voorwerp";
		$result = sqlsrv_query($conn, $sql, null);
		while ($row = sqlsrv_fetch_array($result, SQLSRV_FETCH_ASSOC)) 
		{
			$titel = $row['titel'];
		}
?>
<div class="container-fluid">
	<div class="content no-nav">
		<div class="center-box">
		<form action="send_mail.php" method="POST">
			<h3>U wilt extra informatie over het voorwerp</h3>
			<h1><?php echo $titel; ?> </h1>
				Stel uw vragen
				<textarea name="vraag" class="feedbackveld" cols="20"></textarea>
				<input type="hidden" name="voorwerpID" value="<?= $_GET['voorwerpID'];?>">
				<input type="hidden" name="rub_nr" value="<?= $_GET['rubriekID'];?>">
				<input type="hidden" name="verkoper" value="<?= $row['verkoper'];?>">
				<input type="hidden" name="titel" value="<?= $titel;?>">
				<button type="submit" class="btn btn-success btn-feedback">Verstuur email</button>
			</form>
		</div>
	</div>
</div>
<?php 
 } require 'includes/footer.php';?>
</body>

