<!DOCTYPE html>
<html lang="nl">		
<head>
	<title>Toevoegen artikel</title>
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
$naam_artikel			= $_POST['naam_artikel'];
$beschrijving			= $_POST['beschrijving'];
$rubriek				= $_POST['Rubriek'];
$startprijs				= $_POST['startprijs'];
$betalingswijze			= $_POST['betalingswijze'];
$betalingsinstructie	= $_POST['betalingsinstructie'];
$plaatsnaam				= $_POST['plaatsnaam'];
$land 					= $_POST['land'];
$looptijd				= $_POST['looptijd'];
$verzendkosten 			= $_POST['verzendkosten'];
$verzendinstructie 		= $_POST['verzendinstructie'];



$required = array (
	'naam_artikel',
	'beschrijving',
	'startprijs',
	'betalingswijze',
	'plaatsnaam',
	'land',
	'looptijd'
);

// Controleren of er verplichte velden leeggelaten zijn
foreach ($required as $input)
{
    if (empty($_POST[$input]))
    {
		echo '<h3><small>Er zijn een of meerdere verplichte velden leeggelaten.</small></h3><br>';
		$input_check = false;
		header("refresh:2;url=toevoegen-artikel.php");
		exit();
    }
}


// checken startprijs
if (!ctype_digit($startprijs)) {
	echo '<h3><small>U moet een heel bedrag invullen bij startprijs.</h3></small><br>';
	$input_check = false;
}

if ($rubriek == '-1') {
	echo '<h3><small>U heeft geen rubriek gekozen. U moet een rubriek kiezen waar uw voorwerp onder valt.</h3></small><br>';
	$input_check = false;
}

if ($input_check === true) {	
	$niet = "niet";
	$session = $_SESSION['loginnaam'];
	
	// SQL query tabel
	$sql = "INSERT INTO [dbo].[VOORWERP] 
			([TITEL],
			[BESCHRIJVING],
			[STARTPRIJS],
			[BETALINGSWIJZE],
			[BETALINGSINSTRUCTIE],
			[PLAATSNAAM],
			[LAND],
			[LOOPTIJD],
			[VERZENDKOSTEN],
			[VERZENDINSTRUCTIES],
			[VERKOPER],
			[veilingGesloten]
			) 
			OUTPUT Inserted.voorwerpnummer
			VALUES 
			('$naam_artikel',
			'$beschrijving',
			'$startprijs',
			'$betalingswijze',
			'$betalingsinstructie',
			'$plaatsnaam',
			'$land',
			'$looptijd',
			'$verzendkosten',
			'$verzendinstructie',
			'$session',
			'$niet'
			)";
			
	// SQL query uitvoeren
	$result = sqlsrv_query($conn, $sql, null);
	
	// voorwerpnummer bepalen
	while( $row = sqlsrv_fetch_array( $result, SQLSRV_FETCH_ASSOC) ) {
		$voorwerpnr = $row['voorwerpnummer'];
	}
	
for ($i = 1; $i < 5; $i++) {
	if (isset($_FILES["fileToUpload{$i}"]["name"])) {
		$session = $_SESSION['loginnaam'];
		$target_dir = 'upload/'.$session.'/';
		$target_file = $target_dir . $voorwerpnr . '_' .  basename($_FILES["fileToUpload{$i}"]["name"]);
		$uploadOk = 1;
		$imageFileType = pathinfo($target_file,PATHINFO_EXTENSION);
		// Check if image file is a actual image or fake image
		if(isset($_POST["submit"])) {
			$check = getimagesize($_FILES["fileToUpload{$i}"]["tmp_name"]);
			if($check !== false) {
				$uploadOk = 1;
			} else {
				echo "Bestand is geen image.";
				$uploadOk = 0;
			}
		}

		// Check file size
		if ($_FILES["fileToUpload{$i}"]["size"] > 5000000) {
			echo "Sorry, your file is too large.";
			$uploadOk = 0;
		}
		 
			if (move_uploaded_file($_FILES["fileToUpload{$i}"]["tmp_name"], $target_file)) {
				echo "The file ". basename( $_FILES["fileToUpload{$i}"]["name"]). " has been uploaded.";
				$query = "INSERT into bestand (FILENAAM, VOORWERP) VALUES('$target_file','$voorwerpnr'); ";
				$result = sqlsrv_query($conn, $query, null);
			}
	}
}

$result = sqlsrv_query($conn, $query, null);
	
	$rubriek_op_laagste_niveau = $rubriek;
	
	// voorwerpinRubriek query
	$sql = "INSERT INTO [dbo].[VOORWERPINRUBRIEK] 
			([VOORWERP],
			[RUBRIEK_OP_LAAGSTE_NIVEAU]
			) 
			VALUES 
			('$voorwerpnr',
			'$rubriek_op_laagste_niveau'
			)";

	// SQL query uitvoeren
	$result = sqlsrv_query($conn, $sql, null);
	

	// Indien query niet werkt, toon errors
	if( ($errors = sqlsrv_errors() ) != null) {
		echo '<h3>Er is iets foutgegaan aan onze kant. Probeer het later opnieuw.</h3>';
		foreach( $errors as $error ) {
            echo "SQLSTATE: ".$error[ 'SQLSTATE']."<br />";
            echo "code: ".$error[ 'code']."<br />";
            echo "message: ".$error[ 'message']."<br />";
		}
	}
	header("refresh:2;url=mijnveilingen.php");
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