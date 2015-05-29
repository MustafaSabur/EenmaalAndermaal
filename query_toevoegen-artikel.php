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

$session = $_SESSION['loginnaam'];

if(isset($_FILES['files'])){
	foreach($_FILES['files']['tmp_name'] as $key => $tmp_name ){
		$file_name = $key.$_FILES['files']['name'][$key];
		$file_size =$_FILES['files']['size'][$key];
		$file_tmp =$_FILES['files']['tmp_name'][$key];
		$file_type=$_FILES['files']['type'][$key];
		$desired_dir='upload/'.$session.'/';
		$pad = $desired_dir . $voorwerpnr . '_' . $file_name;
        if($file_size > 1048576){
			$errors='Uw afbeeldingen mogen maximaal 1MB zijn';
			$input_check = false;
        }
        $query="INSERT into bestand (FILENAAM, VOORWERP) VALUES('$pad','$voorwerpnr'); ";
        if(empty($errors)==true){
            if(is_dir($desired_dir)==false){
                mkdir("$desired_dir", 0700);		// Create directory if it does not exist
            }
            if(is_dir("$desired_dir/".$file_name)==false){
                move_uploaded_file($file_tmp, $pad);
            }else{									//rename the file if another one exist
                $new_dir = $pad.time();
                 rename($file_tmp, $new_dir) ;				
            }
            sqlsrv_query($conn, $query, null);			
        }
		else{
            print_r($errors);
        }
    }
	if(empty($errors)){
		echo "<h3><small>Uw bestanden zijn geupload en uw veiling staat in onze database.</small></h3>";
	}
}

if ($input_check === true) {	
	$niet = "niet";
	
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
	

	// Indien query niet werkt, toon errors
	if( ($errors = sqlsrv_errors() ) != null) {
		echo '<h3>Er is iets foutgegaan aan onze kant. Probeer het later opnieuw.</h3>';
		foreach( $errors as $error ) {
            echo "SQLSTATE: ".$error[ 'SQLSTATE']."<br />";
            echo "code: ".$error[ 'code']."<br />";
            echo "message: ".$error[ 'message']."<br />";
		}
	}
	header("refresh:5;url=mijnveilingen.php");
}

else {
	echo 'Uw afbeeldingen mogen maximaal 1MB zijn.';
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