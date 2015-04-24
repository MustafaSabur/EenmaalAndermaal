<?php
require 'includes/connect.php';

$input_check = true;

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

$required = array (
	'gebruikersnaam',
	'voornaam',
	'achternaam',
	'adresregel1',
	'postcode',
	'plaatsnaam',
	'land',
	'telefoon',
	'email',
	'password',
	'antwoordtekst'
);

// Controleren of er verplichte velden leeggelaten zijn
foreach ($required as $input)
{
    if (empty($_POST[$input]))
    {
		echo 'Er zijn een of meerdere verplichte velden leeggelaten. <br>';
        exit();
    }
}

// checken gebruikersnaam
if (!ctype_alnum($gebruikersnaam)) {
	echo 'Gebruikersnaam bevat karakters die niet toegestaan zijn <br>';
	$input_check = false;
}

// preg_match voornaam
if (preg_match("/^[a-z ,.'-]+$/i", $voornaam) == 0) {
	echo 'Voornaam bevat karakters die niet toegestaan zijn. <br>';
	$input_check = false;
}

// preg_match achternaam
if (preg_match("/^[a-z ,.'-]+$/i", $achternaam) == 0) {
	echo 'Achternaam bevat karakters die niet toegestaan zijn. <br>';
	$input_check = false;
}

// preg_match adresregels, voor regel 2 alleen indien deze is ingevuld
if (preg_match("/^([1-9][e][\s])*([a-zA-Z]+(([\.][\s])|([\s]))?)+[1-9][0-9]*(([-][1-9][0-9]*)|([\s]?[a-zA-Z]+))?$/i", $adresregel1) == 0) {
	echo 'Adres 1 is niet valide. <br>';
	$input_check = false;
}

if (!empty($_POST[$adresregel2])) { // hier zit nog een bug, indien adres 1 correct is en 2 niet, wordt deze alsnog geaccepteerd
	if (preg_match("/^([1-9][e][\s])*([a-zA-Z]+(([\.][\s])|([\s]))?)+[1-9][0-9]*(([-][1-9][0-9]*)|([\s]?[a-zA-Z]+))?$/i", $adresregel2) == 0) {
		echo 'Adres 2 is niet valide. <br>';
		$input_check = false;
	}
}

// postcode controleren
// strippen van whitespace en hyphen uit postcode
$postcode = preg_replace('/\s+/', '', $postcode);
$postcode = str_replace('-', '', $postcode);
if (preg_match("/^[1-9][0-9]{3}?[A-Za-z]{2}$/i", $postcode) == 0) {
	echo 'Postcode is niet valide. <br>';
	$input_check = false;
}

// plaatsnaam controleren
if (preg_match("/^(([2][e][[:space:]]|['][ts][-[:space:]]))?[ëéÉËa-zA-Z]{2,}((\s|[-](\s)?)[ëéÉËa-zA-Z]{2,})*$/i", $plaatsnaam) == 0) {
	echo 'Plaatsnaam is niet valide. <br>';
	$input_check = false;
}

// telefoonnummer controleren
$telefoon = preg_replace('/\s+/', '', $telefoon);
$telefoon = str_replace('-', '', $telefoon);
if (!ctype_digit($telefoon)) {
	echo 'Telefoonnummer klopt niet. <br>';
	$input_check = false;
}


// Controleren of het opgegeven email adres klopt
if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
	echo 'Email adres is niet valide. <br>';
	$input_check = false;
}

// antwoordtekst controleren
if (preg_match("/^[a-zA-Z][a-zA-Z ]*$/", $antwoordtekst) == 0) {
	echo 'Antwoordtekst mag alleen letters en spaties bevatten. <br>';
	$input_check = false;
}

// geboortedatum naar het "DATE" datatype converteren
$geboortedatum = $jaar.'-'.$maand.'-'.$dag;

// controleren of gebruikersnaam in gebruik is
$sql = "SELECT GEBRUIKERSNAAM FROM GEBRUIKER WHERE GEBRUIKERSNAAM = '$gebruikersnaam'";
$result = sqlsrv_query($conn, $sql, array(), array("Scrollable"=>"buffered"));
$rowCount = sqlsrv_num_rows($result);

if (!empty($rowCount)) {
	echo 'Uw gebruikersnaam is al in gebruik.<br>';
	exit();
}

// controleren of email adres in gebruik is
$sql = "SELECT MAILBOX FROM GEBRUIKER WHERE MAILBOX = '$email'";
$result = sqlsrv_query($conn, $sql, array(), array("Scrollable"=>"buffered"));
$rowCount = sqlsrv_num_rows($result);

if (!empty($rowCount)) {
	echo 'Uw email adres is al in gebruik.<br>';
	exit();
}

if ($input_check === true) {
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
	echo 'Bedankt voor uw registratie!';
	header("refresh:2;url=index.php");	
}

else {
	header("refresh:2;url=register.php");
	exit();
}

// Sluit connectie naar database
require 'includes/closedb.php';
exit();
 ?>