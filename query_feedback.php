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
var_dump($voorwerp);

if(!isset($session))
{
	echo 'U moet eerst inloggen voordat u feedback kan geven';
}
else
{
	$commentaar = $_POST['feedback'];
	$rating = $_POST['rating'];

	$sql = "INSERT INTO feedback(voorwerp, soort_gebruiker, rating, commentaar)
			VALUES($voorwerp, 'koper', $rating, '$commentaar')";
	$result = sqlsrv_query($conn, $sql, null);
	echo 'succesvol feedback gegeven';
	}
	header('refresh:0; url= artikel.php?id='.$voorwerp.'&rub_nr='.$rub_nr);
require 'includes/closedb.php';	
require 'includes/footer.php';

?>