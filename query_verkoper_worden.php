<!DOCTYPE html>
<html lang="nl">		
<head>
	<title>Verkoper worden</title>
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.4/css/bootstrap.min.css">
	<link rel="stylesheet" href="//maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css">
	<link rel="stylesheet" href="css/custom.css">
</head>
<body>

<?php
require 'includes/connect.php';
require 'includes/header.php';
require 'includes/functions.php';
?>

<div class="container-fluid">
	<div class="row content content-register">
			<div class="col-xs-6 col-xs-offset-3">

<?php
// Variabelen
$identificatiemethode	= $_POST['identificatiemethode'];

$activatiecode = genRandomString();
$activatiecode_definitief = $activatiecode;

$session = $_SESSION['loginnaam'];

$sql = "SELECT mailbox FROM Gebruiker WHERE Gebruikersnaam = '$session'";
$result = sqlsrv_query($conn, $sql, null);

while ($row = sqlsrv_fetch_array($result, SQLSRV_FETCH_ASSOC)) {
	$email = $row['mailbox'];
}

if ($identificatiemethode == 'Post') {
	$bericht = 'Bedankt voor uw aanvraag. U ontvangt binnen 3 werkdagen een brief met daarin uw activatiecode. Deze kunt u invullen op http://irpoject27.icasites.nl/activate_verkoper.php';
}
else if ($identificatiemethode == 'Email') {
	$bericht = 'Bedankt voor uw aanvraag. U ontvangt binnen 5 minuten een email met daarin uw activatiecode. Deze kunt u invullen op http://irpoject27.icasites.nl/activate_verkoper.php';
}
	
else if ($identificatiemethode == 'SMS') {
	$bericht = 'Bedankt voor uw aanvraag. U ontvangt binnen 5 minuten een SMS met daarin uw activatiecode. Deze kunt u invullen op http://irpoject27.icasites.nl/activate_verkoper.php';
}

if ($identificatiemethode != NULL) {
	// sql query
	$sql = "INSERT INTO VERKOPER gebruiker, controle_optie VALUES
			'$session',
			'$identificatiemethode'";		
	$result = sqlsrv_query($conn, $sql, null);
	
	// email versturen
	$from = "info.27creations@gmail.com";
    $to = $email;
    $subject = "Activatiecode voor uw verkopersaccount op veilingsite EenmaalAndermaal";
    $message = "Uw activatiecode is als volgt: ".$activatiecode_definitief.". Deze kunt u hier invullen:  http://iproject27.icasites.nl/activate_verkoper.php";
    $headers = "From:" . $from;
    mail($to,$subject,$message, $headers);
	
	echo ($bericht);
	header("refresh:2;url=activate_verkoper.php");	
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