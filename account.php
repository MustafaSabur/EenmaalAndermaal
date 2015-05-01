<!DOCTYPE html>
<html lang="nl">		
<head>
	<title>Mijn account</title>
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.4/css/bootstrap.min.css">
	<link rel="stylesheet" href="//maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css">
	<link rel="stylesheet" href="css/custom.css">
</head>
<body>

<?php
require 'includes/connect.php';
require 'includes/header.php';
require 'includes/zoekbalk.php';

echo '
<div class="container-fluid">
<div class="row content">';

require 'includes/nav-rubriek.php';

echo '
<div class="col-xs-6 col-xs-offset-2"><br><br>
<form method="POST" action="update-account.php">
<table class="table table-hover table-responsive">';

if ($conn) {
	if (!isset($_SESSION['loginnaam'])) {
		echo '<h3><small>U bent niet ingelogd. Log in om uw accountgegevens te bekijken.</h3></small></table>';
	}
	
	else {
		$info = array (
		'GEBRUIKERSNAAM',
		'VOORNAAM',
		'ACHTERNAAM',
		'ADRESREGEL1',
		'ADRESREGEL2',
		'POSTCODE',
		'PLAATSNAAM',
		'LAND',
		'MAILBOX',
		'IS_VERKOPER'
		);
		
		$display = array (
		'Gebruikersnaam',
		'Voornaam',
		'Achternaam',
		'Adres 1',
		'Adres 2',
		'Postcode',
		'Plaatsnaam',
		'Land',
		'E-mail',
		'Verkoper'
		);
		
		$editable = array (
		'3',
		'4',
		'5',
		'6',
		'7',
		'8'
		);
		
		$session = $_SESSION['loginnaam'];
		$sql = "SELECT GEBRUIKERSNAAM, VOORNAAM, ACHTERNAAM, ADRESREGEL1, ADRESREGEL2, POSTCODE, PLAATSNAAM, LAND, MAILBOX, IS_VERKOPER from GEBRUIKER where GEBRUIKERSNAAM = '$session'";
		$result = sqlsrv_query($conn, $sql, null);
			
			if( (sqlsrv_errors()) != null) {
				echo '<h1><small>Er is iets foutgegaan aan onze kant. Probeer het later opnieuw.</small></h1>';
			}
		
		while ($row = sqlsrv_fetch_array($result, SQLSRV_FETCH_ASSOC)) {
			for ($i = 0; $i < 10; $i++) {
				if ($row[$info[$i]] == 'wel') {
					echo '<tr><td>'.$display[$i].':</td> <td><input type="checkbox" name="'.$info[$i].'" disabled="disabled" checked="checked" value="'.$row[$info[$i]].'"></td></tr>';
				}
				else if ($row[$info[$i]] == 'niet') {
					echo '<tr><td>'.$display[$i].':</td> <td><input type="checkbox" name="'.$info[$i].'" disabled="disabled" value="'.$row[$info[$i]].'"></td></tr>';
				}
				else if (in_array($i, $editable) == true) {
					echo '<tr><td>'.$display[$i].':</td> <td><input type="text" name="'.$info[$i].'" value="'.$row[$info[$i]].'"></td></tr>';
				}
				else {
					echo '<tr><td>'.$display[$i].':</td> <td name="'.$info[$i].'">'.$row[$info[$i]].'</td></tr>';
					// echo '<tr><td>'.$display[$i].':</td> <td><input type="text" name="'.$info[$i].'" value="'.$row[$info[$i]].'" readonly></td></tr>';
				}
			}
		}
		echo '</table>';
		echo '<button type="submit" class="btn btn-primary">Opslaan</button>';
	}
}
?>
</div>
</div>
</div>

<?php
require 'includes/footer.php';
?>

</body>
</html>