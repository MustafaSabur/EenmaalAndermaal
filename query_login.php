<!DOCTYPE html>
<html lang="nl">		
<head>
	<title>Login</title>
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.4/css/bootstrap.min.css">
	<link rel="stylesheet" href="css/custom.css">
	<link rel="stylesheet" href="css/query-register.css">
</head>
<body>

<?php
$loginVisibility = 'not_visible';
require 'includes/connect.php';
require 'includes/functions.php';
require 'includes/header.php';
?>

<div class="container-fluid">
	<div class="row content content-register">
			<div class="col-xs-6 col-xs-offset-3">

<?php
$required = array (
	'gebruikersnaam',
	'password'
);

$gebruikersnaam = $_POST['gebruikersnaam'];
$password       = $_POST['password'];

function cleanString($string) {
	$string = str_replace(' ', '', $string);
	return preg_replace('/[^A-Za-z0-9\-]/', '', $string); 
}

cleanString($gebruikersnaam);
cleanString($password);

// Controleren of er verplichte velden leeggelaten zijn
foreach ($required as $input)
{
    if (empty($_POST[$input]))
    {
		echo '<h3>De door u ingevulde combinatie komt niet voor in de database. Probeer het opnieuw.</h3>';
		header("refresh:2;url=index.php");
		exit();
    }
}

// controleren of gebruikersnaam in gebruik is
$sql = "SELECT GEBRUIKERSNAAM FROM GEBRUIKER WHERE GEBRUIKERSNAAM = '$gebruikersnaam'";
$result = sqlsrv_query($conn, $sql, array(), array("Scrollable"=>"buffered"));
$rowCount = sqlsrv_num_rows($result);

if (empty($rowCount)) {
	echo '<h3>De door u ingevulde combinatie komt niet voor in de database. Probeer het opnieuw.</h3>';
	header("refresh:3;url=index.php");
}
	
	// SQL query
	$tsql = "SELECT GEBRUIKERSNAAM, WACHTWOORD, ACTIEF FROM GEBRUIKER WHERE GEBRUIKERSNAAM = '$gebruikersnaam'";
	$tresult = sqlsrv_query($conn, $tsql, null);
	if ( $tresult === false){die( print_r( sqlsrv_errors()));}
	while($row = sqlsrv_fetch_array( $tresult, SQLSRV_FETCH_ASSOC) ) {
		if ($row['GEBRUIKERSNAAM'] == $gebruikersnaam && crypt($password,$row['WACHTWOORD']) == $row['WACHTWOORD']) {
			if ($row['ACTIEF'] == 0) {
				echo '<h3>Uw account is nog niet geactiveerd.</h3>';
				header("refresh:1;url=activate.php");
			}
			else {
				echo '<h3>U bent ingelogd!</h3>';
				$_SESSION['loginnaam'] = $gebruikersnaam;
				header("refresh:1;url=index.php");
			}
		}
		else {
			echo '<h3>De door u ingevulde combinatie komt niet voor in de database. Probeer het opnieuw.</h3>';
			header("refresh:2;url=index.php");
		}
	}
?>

</div>
</div>
</div>
</div>

<?php	
require 'includes/closedb.php';
require 'includes/footer.php';
 ?>
 
 </body>
 </html>
 
 <?php
 exit();
 ?>