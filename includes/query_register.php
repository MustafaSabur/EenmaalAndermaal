<?php

//Alle variablen aanmaken en gelijkstellen aan null
$gebruikersnaam = $voornaam = $achternaam = $adresregel1 = $adresregel2 = $postcode = $plaatsnaam = $land = $dag = $maand = $jaar = $telefoon = $email = $vraag = $antwoordtekst = "";


if ($_SERVER["REQUEST_METHOD"] == "POST") {
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
	$landcode			= $_POST['landcode'];
	$telefoon			= $_POST['telefoon'];
	$email       		= $_POST['email'];
	$password       	= $_POST['password'];
	$password_confirm	= $_POST['password_confirm'];
	$vraag       		= $_POST['vraag'];
	$antwoordtekst      = $_POST['antwoordtekst'];
	$is_verkoper = 'niet';


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
		'password_confirm',
		'antwoordtekst'
	);

	echo '<div class=center-box>
			<h1><small>Onderstaande velden dienen aangepast te worden!</small></h1>';

	// Controleren of er verplichte velden leeggelaten zijn
	foreach ($required as $input)
	{
	    if (empty($_POST[$input]))
	    {
			echo '<h3><small>Er zijn een of meerdere verplichte velden leeggelaten.</small></h3><br>';
			break;
	    }
	}

	// checken gebruikersnaam
	if (!ctype_alnum($gebruikersnaam)) {
		echo '<h3><small>Gebruikersnaam bevat karakters die niet toegestaan zijn.</h3></small><br>';
		$input_check = false;
	}

	// preg_match voornaam
	if (preg_match("/^[a-z ,.'-]+$/i", $voornaam) == 0) {
		echo '<h3><small>Voornaam bevat karakters die niet toegestaan zijn.</h3></small><br>';
		$input_check = false;
	}

	// preg_match achternaam
	if (preg_match("/^[a-z ,.'-]+$/i", $achternaam) == 0) {
		echo '<h3><small>Achternaam bevat karakters die niet toegestaan zijn.</h3></small><br>';
		$input_check = false;
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

	// matchen wachtwoorden
	if ($password != $password_confirm) {
		echo '<h3><small>Ingevoerde wachtwoorden matchen niet.</h3></small><br>';
		$input_check = false;
	}

	// antwoordtekst controleren
	if (preg_match("/^[a-zA-Z][a-zA-Z ]*$/", $antwoordtekst) == 0) {
		echo '<h3><small>Antwoordtekst mag alleen letters en spaties bevatten.</h3></small><br>';
		$input_check = false;
	}

	// algemene voorwaarden controleren
	if (!isset($_POST['algemene_voorwaarden'])) {
		echo '<h3><small>U gaat niet akkoord met de algemene voorwaarden. U moet akkoord gaan om te registreren.</h3></small><br>';
		$input_check = false;
	}

	// geboortedatum naar het "DATE" datatype converteren
	$geboortedatum = $jaar.'-'.$maand.'-'.$dag;

	// controleren of gebruikersnaam in gebruik is
	$sql = "SELECT GEBRUIKERSNAAM FROM GEBRUIKER WHERE GEBRUIKERSNAAM = '$gebruikersnaam'";
	$result = sqlsrv_query($conn, $sql, array(), array("Scrollable"=>"buffered"));
	$rowCount = sqlsrv_num_rows($result);

	if (!empty($rowCount)) {
		echo '<h3><small>Uw gebruikersnaam is al in gebruik.</h3></small><br>';
		$input_check = false;
		//header("refresh:2;url=$current_page");
		//exit();
	}

	// controleren of email adres in gebruik is
	$sql = "SELECT MAILBOX FROM GEBRUIKER WHERE MAILBOX = '$email'";
	$result = sqlsrv_query($conn, $sql, array(), array("Scrollable"=>"buffered"));
	$rowCount = sqlsrv_num_rows($result);

	if (!empty($rowCount)) {
		echo '<h3><small>Uw email adres is al in gebruik.</h3></small><br>';
		$input_check = false;

	}
	echo '</div>';

	if ($input_check === true) {
		$salt = '$2a$07$l8sZPQilHWZ7hjVr88G3YGVCSR44iTXHMhHWIQ8kF9e9NNW4';
		$password_hash = crypt($password, $salt);
		
		
		$activatiecode = genRandomString();
		$activatiecode_definitief = $activatiecode;

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
				[IS_VERKOPER],
				[ACTIVATIECODE]
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
				'$is_verkoper',
				'$activatiecode_definitief'
				)";

		// SQL query uitvoeren
		$result = sqlsrv_query($conn, $tsql, null);
		
		$sql_tel = "INSERT INTO [dbo].[GEBRUIKERSTELEFOON] 
				([VOLGNR],
				[GEBRUIKER],
				[TELEFOON]
				) 
				VALUES 
				('1',
				'$gebruikersnaam',
				'$telefoon')";
		
		$tel_result = sqlsrv_query($conn, $sql_tel, null);
		
		$from = "info.27creations@gmail.com";
	    $to = $email;
	    $subject = "Activatiecode voor uw account op veilingsite EenmaalAndermaal";
	    $message = "Welkom bij veilingsite EenmaalAndermaal! Uw activatiecode is als volgt: ".$activatiecode_definitief.". Deze kunt u hier invullen:  http://iproject27.icasites.nl/activate.php";
	    $headers = "From:" . $from;
	    mail($to,$subject,$message, $headers);
		
		header("refresh:0;url=activate.php?mail=".$email);
		exit();
	}
}
?>