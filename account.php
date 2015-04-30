<!DOCTYPE html>
<html lang="nl">		
<head>
	<title>Registreren</title>
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
<table class="table table-hover table-responsive">';

if ($conn) {
	$session = $_SESSION['loginnaam'];
	$info = array (
	'GEBRUIKERSNAAM',
	'VOORNAAM',
	'ACHTERNAAM',
	'ADRESREGEL1',
	'ADRESREGEL2',
	'POSTCODE',
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
	'Land',
	'E-mail',
	'Ik ben verkoper'
	);
	
	$sql = "SELECT GEBRUIKERSNAAM, VOORNAAM, ACHTERNAAM, ADRESREGEL1, ADRESREGEL2, POSTCODE, LAND, MAILBOX, IS_VERKOPER from GEBRUIKER where GEBRUIKERSNAAM = '$session'";
	$result = sqlsrv_query($conn, $sql, null);
		
		if( (sqlsrv_errors()) != null) {
			echo '<h1><small>Er is iets foutgegaan aan onze kant. Probeer het later opnieuw.</small></h1>';
		}
	
	while ($row = sqlsrv_fetch_array($result, SQLSRV_FETCH_ASSOC)) {
		for ($i = 0; $i < 9; $i++) {
				echo '<tr><td>'.$display[$i].':</td> <td>'.$row[$info[$i]].'</td></tr>';
		}
	}
}
?>

</table>
<button type="button" class="btn btn-primary">Wijzigen</button>
</div>
</div>
</div>

<?php
require 'includes/footer.php';
?>

</body>
</html>