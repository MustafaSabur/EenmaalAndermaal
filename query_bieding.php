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
$input_check = true;

if(!isset($session))
{
	echo 'U moet eerst inloggen voordat u kan bieden.';
}
else
{
	$bedrag = $_POST['InputBedrag'];
	$gebruiker = $session;
	$voorwerp = $_POST['voorwerpID'];
	$rubriek = $_POST['rubriekID'];
	$huidigBod = $_POST['hoogsteBod'];
}

$sql = "SELECT verkoper FROM voorwerp WHERE voorwerpnummer = '$voorwerp'";
$result = sqlsrv_query($conn, $sql, null);

while ($row = sqlsrv_fetch_array($result, SQLSRV_FETCH_ASSOC)) {
	if ($row['verkoper'] == $gebruiker) {
		echo 'U mag niet op uw eigen voorwerpen bieden.';
		header('refresh:3; url= artikel.php?id='.$voorwerp.'&rub_nr='.$rubriek);
		$input_check = false;
	}
}

$huidigBod = (float)$huidigBod;
$bedrag = (float)$bedrag;


	if (!is_numeric($bedrag)) {
	echo 'Het door u opgegeven bedrag is niet geldig.';
	header('refresh:3; url= artikel.php?id='.$voorwerp.'&rub_nr='.$rubriek);
	$input_check = false;
	}

	if($bedrag <= $huidigBod)
	{
	echo 'Het door u ingegeven bedrag is kleiner/gelijk aan het huidige bodbedrag. <br>
			Biedingen moeten hoger zijn dan het huidige bodbedrag.
			';
	header('refresh:3; url= artikel.php?id='.$voorwerp.'&rub_nr='.$rubriek);
	$input_check = false; 
	}

	if ($huidigBod < 50.00 && $huidigBod > 0.00) 
	{
		if ($bedrag < $huidigBod + 0.50) 
		{
			$input_check = false;
			echo 'bedrag is te laag 0-50';
			header('refresh:3; url= artikel.php?id='.$voorwerp.'&rub_nr='.$rubriek);
		}
	}
	if ($huidigBod < 500.00 && $huidigBod > 50.00) 
	{
		if ($bedrag  < $huidigBod + 1.00) 
		{
			$input_check = false;
			echo 'bedrag is te laag 50-500';
			header('refresh:3; url= artikel.php?id='.$voorwerp.'&rub_nr='.$rubriek);
		}
	}
	if ($huidigBod < 1000.00 && $huidigBod > 500.00) 
	{
		if ($bedrag < $huidigBod + 5.00) 
		{
			$input_check = false;
			echo 'bedrag is te laag 500-1000';
			header('refresh:3; url= artikel.php?id='.$voorwerp.'&rub_nr='.$rubriek);
		}
	}
	if ($huidigBod < 5000.00 && $huidigBod > 1000.00) 
	{
		if ($bedrag < $huidigBod + 10.00) 
		{
			$input_check = false;
			echo 'bedrag is te laag 1000-5000';
			header('refresh:3; url= artikel.php?id='.$voorwerp.'&rub_nr='.$rubriek);
		}
	}
	if ($huidigBod > 5000.00) 
	{
		if ($bedrag < $huidigBod + 50.00) 
		{
			$input_check = false;
			echo 'bedrag is te laag 5000+';
			header('refresh:3; url= artikel.php?id='.$voorwerp.'&rub_nr='.$rubriek);
		}
	}

if ($input_check == true) {
    $sql = "INSERT INTO [dbo].[Bod] 
			([voorwerp],
			[bodbedrag],
			[gebruiker]
			)
			values
			($voorwerp,
			$bedrag,
			'$gebruiker')";
	
    $result = sqlsrv_query($conn, $sql, null);
	
	if( ($errors = sqlsrv_errors() ) != null) {
		echo '<h3>Er is iets foutgegaan aan onze kant. Probeer het later opnieuw.</h3>';
		foreach( $errors as $error ) {
            echo "SQLSTATE: ".$error[ 'SQLSTATE']."<br />";
            echo "code: ".$error[ 'code']."<br />";
            echo "message: ".$error[ 'message']."<br />";
        }
	}
    header('refresh:5; url= artikel.php?id='.$voorwerp.'&rub_nr='.$rubriek);
}
?>