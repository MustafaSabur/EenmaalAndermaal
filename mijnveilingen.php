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

require 'includes/nav-account.php';

echo '
<div class="col-xs-6 col-xs-offset-2"><br><br>
<form method="POST" action="update-account.php">';

if ($conn) {
	if (!isset($_SESSION['loginnaam'])) {
		echo '<h3><small>U bent niet ingelogd. Log in om uw accountgegevens te bekijken.</h3></small></table>';
	}
	
	else {
		$display = array (
		'Titel',
		'Beschrijving',
		'Rubriek',
		'Startprijs',
		'Betalingswijze',
		'Betalingsinstructie',
		'Totale looptijd'
		);
		
		$session = $_SESSION['loginnaam'];
		// $sql = "SELECT titel, beschrijving, startprijs, betalingswijze, betalingsinstructie, looptijd FROM artikel WHERE verkoper = '$session' ORDER BY startprijs";
		$sql = "select v.titel, v.beschrijving, v.startprijs, v.betalingswijze, v.betalingsinstructie,v.artikelnummer, v.looptijd, r.rubrieknaam
					from artikel v
						inner join artikelInRubriek vir
							on v.artikelnummer = vir.artikel
						inner join Rubriek r
							on vir.rubriek_op_laagste_niveau = r.rubrieknummer
					WHERE verkoper = '$session' ORDER BY startprijs";
					
		$result = sqlsrv_query($conn, $sql, null);
		
		$rowResult = sqlsrv_query($conn, $sql, array(), array("Scrollable"=>"buffered"));
		$rowCount = sqlsrv_num_rows($rowResult);
		
		if (empty($rowCount)) {
			echo '<h3><small>U heeft nog geen veilingen aangemaakt.</h3></small>';
		}
			
		if	((sqlsrv_errors()) != null) {
			echo '<h1><small>Er is iets foutgegaan aan onze kant. Probeer het later opnieuw.</small></h1>';
		}
		
		while ($row = sqlsrv_fetch_array($result, SQLSRV_FETCH_ASSOC)) {
			echo '<table class="table table-hover table-consensed">';
			echo '<tr><td>'.$display[0].':</td> <td>'.$row['titel'].'</td></tr>';
			echo '<tr><td>'.$display[1].':</td> <td>'.$row['beschrijving'].'</td></tr>';
			echo '<tr><td>'.$display[2].':</td> <td>'.$row['rubrieknaam'].'</td></tr>';
			echo '<tr><td>'.$display[3].':</td> <td>&euro;'.$row['startprijs'].'</td></tr>';
			echo '<tr><td>'.$display[4].':</td> <td>'.$row['betalingswijze'].'</td></tr>';
			echo '<tr><td>'.$display[5].':</td> <td>'.$row['betalingsinstructie'].'</td></tr>';
			echo '<tr><td>'.$display[6].':</td> <td>'.$row['looptijd'].' dagen</td></tr>';
			echo '</table>';
			echo '<a href="artikel.php"><button type="button" class="btn btn-primary">Bekijk</button></a>';
			echo '<br><br><br><br>';
		}
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