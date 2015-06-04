<!DOCTYPE html>
<html lang="nl">		
<head>
	<title>Registreren</title>
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.4/css/bootstrap.min.css">
	<link rel="stylesheet" href="css/custom.css">
	<link rel="stylesheet" href="css/query-register.css">
</head>
<body>

<?php
require 'includes/functions.php';
require 'includes/header.php';
?>

<div class="container-fluid">
	<div class="center-box">

<?php    
	unset($_SESSION['loginnaam']);
	session_destroy();
	echo '<h3>U bent uitgelogd.</h3>';
	header("refresh:1;url=index.php");
?> 

</div>
</div>

<?php
require 'includes/footer.php';
?>

 </body>
 </html>
 
 <?php
 exit();
 ?>