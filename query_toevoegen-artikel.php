<!DOCTYPE html>
<html lang="nl">		
<head>
	<title>Toevoegen artikel</title>
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
$input_check = true;

// Variabelen
$naam_artikel			= $_POST['naam_artikel'];
$beschrijving			= $_POST['beschrijving'];
$rubriek				= $_POST['rubriek'];
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
	'betalingsinstructie',
	'plaatsnaam',
	'land',
	'looptijd',
	'verzendkosten',
	'verzendinstructie'
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
	echo '<h3><small>U moet een bedrag invullen bij startprijs.</h3></small><br>';
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
	  var_dump($voorwerpnr);
}

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
	
	$session = $_SESSION['loginnaam'];
	if(!file_exists('upload/'.$session.'/')){
		mkdir('upload/'.$session.'/', 0777, true);
	}

	$target_dir = "upload/".$session."/";
	$prefix_image = $voorwerpnr;
	$target_file = $target_dir . $voorwerpnr. '_' . basename($_FILES["fileToUpload"]["name"]);
	var_dump($target_file);
	$uploadOk = 1;
	$imageFileType = pathinfo($target_file,PATHINFO_EXTENSION);
	// Check if image file is a actual image or fake image
	if(isset($_POST["submit"])) {
		$check = getimagesize($_FILES["fileToUpload"]["tmp_name"]);
		if($check !== false) {
			echo "File is an image - " . $check["mime"] . ".";
			$uploadOk = 1;
		} else {
			echo "File is not an image.";
			$uploadOk = 0;
		}
	}

	// Check if file already exists
	// if (file_exists($target_file)) {
		// echo "U heeft dit bestand al eerder geupload.";
		// $uploadOk = 0;
	// }
	// Check file size
	if ($_FILES["fileToUpload"]["size"] > 5000000) {
		echo "Uw bestand is te groot. Max 5MB.";
		$uploadOk = 0;
	}
	// Allow certain file formats
	if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
	&& $imageFileType != "gif" ) {
		echo "U kunt alleen foto's uploaden.";
		$uploadOk = 0;
	}
	// Check if $uploadOk is set to 0 by an error
	if ($uploadOk == 0) {
		echo "Uw bestand is niet geupload.";
	// if everything is ok, try to upload file
	} else {
		if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file)) {
			echo "The file ". basename( $_FILES["fileToUpload"]["name"]). " has been uploaded.";
		} else {
			echo "Er is een probleem opgetreden bij het uploaden van uw foto('s).";
			$input_check = false;
		}
	}
	
	
	$sql = "INSERT INTO [dbo].[BESTAND] 
			([FILENAAM],
			[VOORWERP]
			) 
			VALUES 
			('$target_file',
			'$voorwerpnr'
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
}

else {
	header("refresh:2;url=toevoegen-artikel.php");
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