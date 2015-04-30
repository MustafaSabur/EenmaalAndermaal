<!DOCTYPE html>
<html lang="nl">		
<head>
	<title>Registreren</title>
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.4/css/bootstrap.min.css">
	<link rel="stylesheet" href="//maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css">
	<link rel="stylesheet" href="css/custom.css">
	<link rel="stylesheet" href="css/query-register.css">
</head>
<body>

<?php
require 'includes/connect.php';
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
	$filter = array('(',')','-','*','"',"'",'NULL');
	$string = str_replace($filter, '', $string);
	return preg_replace('/[^A-Za-z0-9\-]/', '', $string); 
}

cleanString($gebruikersnaam);
cleanString($password);

// Controleren of er verplichte velden leeggelaten zijn
foreach ($required as $input)
{
    if (empty($_POST[$input]))
    {
		echo '<h1><small>De door u ingevulde combinatie komt niet voor in de database. Probeer het opnieuw.</small></h1>';
		header("refresh:3;url=index.php");
		exit();
    }
}

// controleren of gebruikersnaam in gebruik is
$sql = "SELECT GEBRUIKERSNAAM FROM GEBRUIKER WHERE GEBRUIKERSNAAM = '$gebruikersnaam'";
$result = sqlsrv_query($conn, $sql, array(), array("Scrollable"=>"buffered"));
$rowCount = sqlsrv_num_rows($result);

if (empty($rowCount)) {
	echo '<h1><small>De door u ingevulde combinatie komt niet voor in de database. Probeer het opnieuw.</small></h1>';
	header("refresh:3;url=index.php");
}
	
	// SQL query
	$tsql = "SELECT GEBRUIKERSNAAM, WACHTWOORD FROM GEBRUIKER WHERE GEBRUIKERSNAAM = '$gebruikersnaam'";
	$tresult = sqlsrv_query($conn, $tsql, null);
	
	// Controleren van gegevens dmv password_verify
	// http://php.net/manual/en/function.password-verify.php
	while($row = sqlsrv_fetch_array( $tresult, SQLSRV_FETCH_ASSOC) ) {
		if ($row['GEBRUIKERSNAAM'] == $gebruikersnaam && password_verify($password,$row['WACHTWOORD'])) {
			echo '<h1><small>U bent ingelogd!</small></h1>';
			$_SESSION['loginnaam'] = $gebruikersnaam;
			header("refresh:1;url=index.php");
		}
		else {
			echo '<h1><small>De door u ingevulde combinatie komt niet voor in de database. Probeer het opnieuw.</h1></small>';
			header("refresh:3;url=index.php");
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