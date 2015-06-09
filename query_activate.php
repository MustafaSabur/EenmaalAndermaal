<!DOCTYPE html>
<html lang="nl">		
<head>
	<title>Activatie</title>
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
	<div class="content no-nav">
		<div class="center-box">
			
<?php
$input_check = true;

// Variabelen
$gebruikersnaam		= $_POST['gebruikersnaam'];
$activatiecode      = $_POST['activatiecode'];

$required = array (
	'gebruikersnaam',
	'activatiecode'
);

// Controleren of er verplichte velden leeggelaten zijn
foreach ($required as $input)
{
    if (empty($_POST[$input]))
    {
		echo '<h3><small>Er zijn een of meerdere verplichte velden leeggelaten.</small></h3><br>';
		header("refresh:2;url=register.php");
		exit();
    }
}

// checken gebruikersnaam
if (!ctype_alnum($gebruikersnaam)) {
	echo '<h3><small>Gebruikersnaam bevat karakters die niet toegestaan zijn</h3></small><br>';
	$input_check = false;
}

if ($input_check === true) {
	// SQL query tabel ''Gebruiker''
	$sql = "SELECT GEBRUIKERSNAAM, ACTIVATIECODE, ACTIEF FROM GEBRUIKER WHERE GEBRUIKERSNAAM = '$gebruikersnaam'";

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
		if ($gebruikersnaam == $row['GEBRUIKERSNAAM'] && $activatiecode == $row['ACTIVATIECODE']) {
			$sql = "UPDATE [dbo].[GEBRUIKER] SET 
					[ACTIEF] = '1' 
					WHERE GEBRUIKERSNAAM = '$gebruikersnaam'";
			
			$result = sqlsrv_query($conn, $sql, null);
			
			echo '<h3>Uw account is geactiveerd.</h3>';
			$_SESSION['loginnaam'] = $gebruikersnaam;
			header("refresh:2;url=index.php");
		}
		else {
			echo 'De door u ingevoerde combinatie komt niet voor in onze database.';
		}
	}
}	
?>

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