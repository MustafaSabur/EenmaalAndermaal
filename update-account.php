<!DOCTYPE html>
<html lang="nl">		
<head>
	<title>Mijn account</title>
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.4/css/bootstrap.min.css">
	<link rel="stylesheet" href="css/custom.css">
	<link rel="stylesheet" href="css/query-register.css">
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

<?php
$input_check = true;

// Variabelen
$adresregel1       	= $_POST['ADRESREGEL1'];
$adresregel2       	= $_POST['ADRESREGEL2'];
$postcode       	= $_POST['POSTCODE'];
$plaatsnaam       	= $_POST['PLAATSNAAM'];
$land       		= $_POST['LAND'];
$email       		= $_POST['MAILBOX'];
$telefoon 			= $_POST['TELEFOON'];


$required = array (
	'ADRESREGEL1',
	'POSTCODE',
	'PLAATSNAAM',
	'LAND',
	'MAILBOX',
	'TELEFOON'
);

// Controleren of er verplichte velden leeggelaten zijn
foreach ($required as $input)
{
    if (empty($_POST[$input]))
    {
		var_dump($_POST[$input]);
		echo '<h3><small>Er zijn een of meerdere verplichte velden leeggelaten.</small></h3><br>';
		header("refresh:2;url=account.php");
		exit();
    }
}

// preg_match adresregels, voor regel 2 alleen indien deze is ingevuld
if (preg_match("/^([1-9][e][\s])*([a-zA-Z]+(([\.][\s])|([\s]))?)+[1-9][0-9]*(([-][1-9][0-9]*)|([\s]?[a-zA-Z]+))?$/i", $adresregel1) == 0) {
	echo '<h3><small>Adres 1 is niet valide.</h3></small><br>';
	$input_check = false;
}

if (!empty($_POST[$adresregel2])) { // hier zit nog een bug, indien adres 1 correct is en 2 niet, wordt deze alsnog geaccepteerd
	if (preg_match("/^([1-9][e][\s])*([a-zA-Z]+(([\.][\s])|([\s]))?)+[1-9][0-9]*(([-][1-9][0-9]*)|([\s]?[a-zA-Z]+))?$/i", $adresregel2) == 0) {
		echo '<h3><small>Adres 2 is niet valide.</h3></small><br>';
		$input_check = false;
	}
}

if (empty($_POST[$adresregel2])) {
	$adresregel2 = '-';
}

// postcode controleren
// strippen van whitespace en hyphen uit postcode
$postcode = preg_replace('/\s+/', '', $postcode);
$postcode = str_replace('-', '', $postcode);
if (preg_match("/^[1-9][0-9]{3}?[A-Za-z]{2}$/i", $postcode) == 0) {
	echo '<h3><small>Postcode is niet valide.</h3></small><br>';
	$input_check = false;
}

// plaatsnaam controleren
if (preg_match("/^(([2][e][[:space:]]|['][ts][-[:space:]]))?[ëéÉËa-zA-Z]{2,}((\s|[-](\s)?)[ëéÉËa-zA-Z]{2,})*$/i", $plaatsnaam) == 0) {
	echo '<h3><small>Plaatsnaam is niet valide.</h3></small><br>';
	$input_check = false;
}


// telefoonnummer controleren, whitespace en hyphens strippen
$telefoon = preg_replace('/\s+/', '', $telefoon);
$telefoon = str_replace('-', '', $telefoon);
if (!ctype_digit($telefoon)) {
	echo '<h3><small>Telefoonnummer klopt niet.</h3></small><br>';
	$input_check = false;
}


// Controleren of het opgegeven email adres klopt
if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
	echo '<h3><small>Email adres is niet valide.</h3></small><br>';
	$input_check = false;
}


if ($input_check === true) {
	// SQL query 
	$session = $_SESSION['loginnaam'];
	
	$tsql = "UPDATE [dbo].[GEBRUIKER] SET
			[ADRESREGEL1] = '$adresregel1',
			[ADRESREGEL2] = '$adresregel2',
			[POSTCODE] = '$postcode',
			[PLAATSNAAM] = '$plaatsnaam',
			[LAND] = '$land',
			[MAILBOX] = '$email'
			WHERE GEBRUIKERSNAAM = '$session'";

	// SQL query uitvoeren
	$result = sqlsrv_query($conn, $tsql, null);
	
	// SQL query
	$sql_tel = "UPDATE [dbo].[GEBRUIKERSTELEFOON] SET
				[VOLGNR] = '1',
				[GEBRUIKER] = '$session',
				[TELEFOON] = '$telefoon'
				WHERE GEBRUIKER = '$session'";
	
	$tel_result = sqlsrv_query($conn, $sql_tel, null);

	// Indien query niet werkt, toon errors
	// Indien query niet werkt, toon errors
	if( ($errors = sqlsrv_errors() ) != null) {
		echo '<h3>Er is iets foutgegaan aan onze kant. Probeer het later opnieuw.</h3>';
		foreach( $errors as $error ) {
            echo "SQLSTATE: ".$error[ 'SQLSTATE']."<br />";
            echo "code: ".$error[ 'code']."<br />";
            echo "message: ".$error[ 'message']."<br />";
		}
	}
	else {
		echo '<h1><small>Uw accountgegevens zijn geupdate!</small><h1>';
		header("refresh:2;url=account.php");	
	}	
}

else {
	header("refresh:2;url=account.php");
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

<?php
exit();
?>