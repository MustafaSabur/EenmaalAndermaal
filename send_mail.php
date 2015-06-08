<!DOCTYPE html>
<html lang="nl">
<head>
	<title>Productpagina</title>
	<meta charset="utf-8">
  	<meta name="viewport" content="width=device-width, initial-scale=1">
  	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.4/css/bootstrap.min.css">
 	<link rel="stylesheet" href="css/custom.css">
 	<link rel="stylesheet" href="css/product-box.css">
 	<link rel="stylesheet" href="css/artikel.css">
 	<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.2/jquery.min.js"></script>
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.4/js/bootstrap.min.js"></script>
	<script src="js/main.js"></script>
</head>
<body>
<?php 
	require 'includes/connect.php';
	require 'includes/functions.php';
	require 'includes/header.php'; 
?>
<?php

$msg = $_POST['vraag'];
$message = $msg;
$verkoper = $_POST['verkoper'];
$sql = "SELECT mailbox FROM gebruiker WHERE gebruikersnaam = $verkoper";
$result = sqlsrv_query($conn, $sql, null);
while ($row = sqlsrv_fetch_array($result, SQLSRV_FETCH_ASSOC)) 
		{
			$mail = $row['mailbox'];
		}

$session = $_SESSION['loginnaam'];

$sql = "SELECT gebruikersnaam, mailbox FROM gebruiker where gebruikersnaam = $session";
$result = sqlsrv_query($conn, $sql, null);
while ($row = sqlsrv_fetch_array($result, SQLSRV_FETCH_ASSOC)) 
		{
			$mail_vrager = $row['mailbox'];
			$naam_vrager = $row['gebruikersnaam']
		}


$from = "info.27creations@gmail.com";
    $to = $mail;
    $subject = "Extra vragen over een van uw Artikelen";
    $message = 'De gebruiker onder de naam '.$naam_vrager. 'zou graag meer informatie willen over uw artikel : '.$_POST['titel'] .$message;
    $headers = "From:" . $from;
    mail($to,$subject,$message, $headers);
require 'includes/footer.php';?>
</body>