<?php
require 'includes/connect.php';

session_start();
$required = array (
	'gebruikersnaam',
	'password'
);

$gebruikersnaam = $_POST['gebruikersnaam'];
$password       = $_POST['password'];

// Controleren of er verplichte velden leeggelaten zijn
foreach ($required as $input)
{
    if (empty($_POST[$input]))
    {
		echo 'De door u ingevulde combinatie komt niet voor in de database. Probeer het opnieuw.';
		header("refresh:2;url=index.php");
        exit();
    }
}

// controleren of gebruikersnaam in gebruik is
$sql = "SELECT GEBRUIKERSNAAM FROM GEBRUIKER WHERE GEBRUIKERSNAAM = '$gebruikersnaam'";
$result = sqlsrv_query($conn, $sql, array(), array("Scrollable"=>"buffered"));
$rowCount = sqlsrv_num_rows($result);

if (empty($rowCount)) {
	echo 'De door u ingevulde combinatie komt niet voor in de database. Probeer het opnieuw.';
	header("refresh:2;url=index.php");
	exit();
}
	
	// SQL query
	$tsql = "SELECT GEBRUIKERSNAAM, WACHTWOORD FROM GEBRUIKER WHERE GEBRUIKERSNAAM = '$gebruikersnaam'";
	$tresult = sqlsrv_query($conn, $tsql, null);
	
	// Controleren van gegevens dmv password_verify
	// http://php.net/manual/en/function.password-verify.php
	while($row = sqlsrv_fetch_array( $tresult, SQLSRV_FETCH_ASSOC) ) {
		if ($row['GEBRUIKERSNAAM'] == $gebruikersnaam && password_verify($password,$row['WACHTWOORD'])) {
			echo 'U bent ingelogd!';
			$_SESSION['loginnaam'] = $gebruikersnaam;
			header("refresh:2;url=index.php");
		}
		else {
			echo 'De door u ingevulde combinatie komt niet voor in de database. Probeer het opnieuw.';
			header("refresh:2;url=index.php");
		}
	}
require 'includes/closedb.php';
 ?>