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
require 'includes/header.php';
?>

<div class="container-fluid">
	<div class="row content content-register">
			<div class="col-xs-6 col-xs-offset-3">

<?php    
	unset($_SESSION['loginnaam']);
	session_destroy();
	echo '<h1><small>U bent uitgelogd.</small></h1>';
	header("refresh:2;url=index.php");
?> 

</div>
</div>
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