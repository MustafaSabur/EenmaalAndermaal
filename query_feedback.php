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
<body>
<div class="container-fluid">
	<div class="content no-nav">
		<div class="center-box">
<?php
$session = $_SESSION['loginnaam'];
$voorwerp = $_POST['voorwerpID'];
$rub_nr = $_POST['rub_nr'];


if(!isset($session))
{
	echo '<h3><small>U moet eerst inloggen voordat u feedback kan geven.</small></h3>';
}
else
{
	$commentaar = $_POST['feedback'];
	$rating = $_POST['rating'];

	$sql = "INSERT INTO feedback(voorwerp, soort_gebruiker, rating, commentaar)
			VALUES($voorwerp, 'koper', $rating, '$commentaar')";
	$result = sqlsrv_query($conn, $sql, null);
	echo '<h3><small>Succesvol feedback gegeven.</small></h3>';
}
?>
		</div>
	</div>
</div>
<?php
header('refresh:3; url= artikel.php?id='.$voorwerp.'&rub_nr='.$rub_nr);
require 'includes/closedb.php';	
require 'includes/footer.php';

?>

</body>