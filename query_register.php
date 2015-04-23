<?php
require 'connect.php';

// Variabelen
$gebruikersnaam		= $_POST['gebruikersnaam'];
$voornaam       	= $_POST['voornaam'];
$achternaam     	= $_POST['achternaam'];
$adresregel1       	= $_POST['adresregel1'];
$adresregel2       	= $_POST['adresregel2'];
$postcode       	= $_POST['postcode'];
$plaatsnaam       	= $_POST['plaatsnaam'];
$land       		= $_POST['land'];
$dag   				= $_POST['dag'];
$maand 				= $_POST['maand'];
$jaar  				= $_POST['jaar'];
$telefoon			= $_POST['telefoon'];
$email       		= $_POST['email'];
$password       	= $_POST['password'];
$vraag       		= $_POST['vraag'];
$antwoordtekst      = $_POST['antwoordtekst'];

if (!isset($_POST['is_verkoper'])) {
	$is_verkoper = 'niet';
	
}
else {
	$is_verkoper = 'wel';
}

$required = array(
    $gebruikersnaam,
    $voornaam,
    $achternaam,
    $adresregel1,
	$adresregel2,
    $postcode,
    $plaatsnaam,
    $land,
    $dag,
    $maand,
    $jaar,
    $email,
	$password,
	$vraag,
	$antwoordtekst,
	$is_verkoper
);

// Print ingevulde data (voor testen) 
// http://php.net/manual/en/function.empty.php
foreach ($required as $input)
{
	echo $input;
	echo '<br>';
}

// geboortedatum naar het "DATE" datatype converteren
$geboortedatum = $jaar.'-'.$maand.'-'.$dag;

// controleren of gebruikersnaam in gebruik is
$sql = "SELECT GEBRUIKERSNAAM FROM GEBRUIKER WHERE GEBRUIKERSNAAM = '$gebruikersnaam'";
$result = sqlsrv_query($conn, $sql, array(), array("Scrollable"=>"buffered"));
$rowCount = sqlsrv_num_rows($result);

if (!empty($rowCount)) {
	echo 'Uw gebruikersnaam is al in gebruik.';
	exit();
}

// controleren of email adres in gebruik is
$sql = "SELECT MAILBOX FROM GEBRUIKER WHERE MAILBOX = '$email'";
$result = sqlsrv_query($conn, $sql, array(), array("Scrollable"=>"buffered"));
$rowCount = sqlsrv_num_rows($result);

if (!empty($rowCount)) {
	echo 'Uw email adres is al in gebruik.';
	exit();
}

// Controleren of postcode valide is (4 cijfers, 2 letters)
if (!filter_var($postcode, FILTER_VALIDATE_REGEXP,
	array("options"=>array("regexp"=>"/^[1-9][0-9]{3}?[A-Za-z]{2}$/i")))) {
	exit();
}

// Controleren of het opgegeven email adres klopt
if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
	exit(); 
}


// opties voor hashen wachtwoord
// http://php.net/manual/en/function.mcrypt-create-iv.php
$options = [
	'cost' => 11,
	'salt' => mcrypt_create_iv(22, MCRYPT_DEV_URANDOM)
	,
];

// password hashen
// http://php.net/manual/en/function.password-hash.php
$password_hash = password_hash($password, PASSWORD_BCRYPT, $options);


// SQL query tabel ''Gebruiker''
$tsql = "INSERT INTO [dbo].[GEBRUIKER] 
		([GEBRUIKERSNAAM],
		[VOORNAAM],
		[ACHTERNAAM],
		[ADRESREGEL1],
		[ADRESREGEL2],
		[POSTCODE],
		[PLAATSNAAM],
		[LAND],
		[GEBOORTEDAG],
		[MAILBOX],
		[WACHTWOORD],
		[VRAAG],
		[ANTWOORDTEKST],
		[IS_VERKOPER]
		) 
		VALUES 
		('$gebruikersnaam',
		'$voornaam',
		'$achternaam',
		'$adresregel1',
		'$adresregel2',
		'$postcode',
		'$plaatsnaam',
		'$land',
		'$geboortedatum',
		'$email',
		'$password_hash',
		'$vraag',
		'$antwoordtekst',
		'$is_verkoper')";

// SQL query uitvoeren
$result = sqlsrv_query($conn, $tsql, null);

// Indien query niet werkt, toon errors
if( ($errors = sqlsrv_errors() ) != null) {
        foreach( $errors as $error ) {
            echo "SQLSTATE: ".$error[ 'SQLSTATE']."<br />";
            echo "code: ".$error[ 'code']."<br />";
            echo "message: ".$error[ 'message']."<br />";
        }
    }

// Sluit connectie naar database
require 'closedb.php';
exit();
 ?>