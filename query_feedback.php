<!DOCTYPE html>
<html lang="nl">
<head>
	<title>query_bieding</title>
	<meta charset="utf-8">
  	<meta name="viewport" content="width=device-width, initial-scale=1">
  	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.4/css/bootstrap.min.css">
 	<link rel="stylesheet" href="css/custom.css">
 	<link rel="stylesheet" href="css/product-box.css">
 	<link rel="stylesheet" href="css/artikel.css">
 	<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.2/jquery.min.js"></script>
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.4/js/bootstrap.min.js"></script>
	<script src="js/main.js"></script>
 	<?php 	require 'includes/connect.php';
 			require 'includes/functions.php';	 
 			require 'includes/header.php';

	?>
</head>
<?php
$session = $_SESSION['loginnaam'];
$voorwerp = $_POST['voorwerpID'];
$rub_nr = $_POST['rub_nr'];
}
if(!isset($session)
{
	echo 'U moet eerst inloggen voordat u feedback kan geven'
	header('refresh:4; url= artikel.php?id='.$voorwerp.'&rub_nr='.$rubriek);
}
else
{
	$commentaar = $_POST['feedback'];
	$rating = $_POST['rating'];
}




	
require 'includes/footer.php';
?>