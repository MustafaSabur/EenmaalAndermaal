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
	require 'includes/zoekbalk.php';
	$sql = "SELECT titel FROM voorwerp WHERE voorwerpnummer = $_GET['voorwerpID']"
	$result = 

	$titel = $_GET['titel']; 
?>
<div class="container-fluid">
	<div class="content no-nav">
		<div class="center-box">
			<h1>Feedback geven</h1>
			<h2>U wilt feedback geven op het voorwerp</h2>
			<h3><?php  ?> </h3>
			<form action="query_feedback.php" method="POST">
				feedback
				<textarea name="feedback" class="feedbackveld" cols="20"></textarea>
				rating(0-100)	
				<input name="rating" class="ratingveld" >
				<button type="submit" class="btn btn-success btn-feedback">Plaats feedback</button>
			</form>
		</div>
	</div>
</div>
<?php require 'includes/footer.php'?>
</body>