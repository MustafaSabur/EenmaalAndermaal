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
require 'includes/zoekbalk.php';

echo '
<div class="container-fluid">
<div class="row content">';

require 'includes/nav-rubriek.php';

echo '
<div class="col-xs-6 col-xs-offset-2"><br><br>
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
		
		$session = $_SESSION['loginnaam'];
		$sql = "SELECT GEBRUIKERSNAAM, VOORNAAM, ACHTERNAAM, ADRESREGEL1, ADRESREGEL2, POSTCODE, LAND, MAILBOX, IS_VERKOPER from GEBRUIKER where GEBRUIKERSNAAM = '$session'";
		$result = sqlsrv_query($conn, $sql, null);
			
			if( (sqlsrv_errors()) != null) {
				echo '<h3><small>Er is iets foutgegaan aan onze kant. Probeer het later opnieuw.</small></h3>';
			}
		
		while ($row = sqlsrv_fetch_array($result, SQLSRV_FETCH_ASSOC)) {
			for ($i = 0; $i < 9; $i++) {
					echo '<tr><td>'.$display[$i].':</td> <td>'.$row[$info[$i]].'</td></tr>';
			}
		}
		echo '</table>';
		echo '<button type="button" class="btn btn-primary">Wijzigen</button>';
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