<!DOCTYPE html>
<html lang="nl">		
<head>
	<title>Activatie verkoper</title>
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
	<div class="row content content-register">
			<div class="col-xs-6 col-xs-offset-3">
			<div class="center-box">
			
<?php
$input_check = true;

// Variabelen
$gebruikersnaam		= $_POST['gebruikersnaam'];
$activatiecode      = $_POST['activatiecode_verkoper'];

$session = $_SESSION['loginnaam'];

$required = array (
	'gebruikersnaam',
	'activatiecode_verkoper'
);

// Controleren of er verplichte velden leeggelaten zijn
foreach ($required as $input)
{
    if (empty($_POST[$input]))
    {
		echo '<h3><small>Er zijn een of meerdere verplichte velden leeggelaten.</small></h3><br>';
		header("refresh:2;url=activate_verkoper.php");
		exit();
    }
}

// checken gebruikersnaam
if (!ctype_alnum($gebruikersnaam)) {
	echo '<h3><small>Gebruikersnaam bevat karakters die niet toegestaan zijn</h3></small><br>';
	$input_check = false;
	header("refresh:2;url=activate_verkoper.php");
	exit();
}

if ($input_check === true) {
	// SQL query tabel ''Gebruiker''
	$sql = "SELECT GEBRUIKERSNAAM, ACTIVATIECODE_VERKOPER, V.ACTIEF
			FROM GEBRUIKER G inner join VERKOPER V
				on G.GEBRUIKERSNAAM = V.GEBRUIKER
			WHERE G.GEBRUIKERSNAAM = '$session'";

	// SQL query uitvoeren
	$result = sqlsrv_query($conn, $sql, null);

	// Indien query niet werkt, toon errors
	if( ($errors = sqlsrv_errors() ) != null) {
		echo '<h3>Er is iets foutgegaan aan onze kant. Probeer het later opnieuw.</h3>';
	}
	
	while ($row = sqlsrv_fetch_array($result,SQLSRV_FETCH_ASSOC)) {
		if ($gebruikersnaam == $row['GEBRUIKERSNAAM'] && $row['ACTIEF'] == 1) {
			echo '<h3>Uw account is al eerder geactiveerd.</h3>';
			header("refresh:2;url=index.php");
		}
		if ($gebruikersnaam == $row['GEBRUIKERSNAAM'] && $activatiecode == $row['ACTIVATIECODE_VERKOPER']) {
			$sql = "UPDATE VERKOPER SET ACTIEF = 1 WHERE GEBRUIKER = '$session'";
			$result = sqlsrv_query($conn, $sql, null);
			
			echo '<h3>Uw verkoopaccount is geactiveerd.</h3>';
			header("refresh:2;url=toevoegen-artikel.php");
		}
		else {
			echo 'De door u ingevoerde combinatie komt niet voor in onze database.';
			header("refresh:2;url=activate_verkoper.php");
		}
	}
}	
?>

</div>
</div>
</div>
</div>

<?php
// Sluit connectie naar database
require 'includes/closedb.php';
require 'includes/footer.php';
?>

</body>
</html>