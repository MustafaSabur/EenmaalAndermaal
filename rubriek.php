<!DOCTYPE html>
<html lang="nl">
<head>
	<title>Eenmaal Andermaal</title>
	<meta charset="utf-8">
  	<meta name="viewport" content="width=device-width, initial-scale=1">
  	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.4/css/bootstrap.min.css">
 	<link rel="stylesheet" href="css/custom.css">
	<link rel="stylesheet" href="css/rubriek.css">

	<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.2/jquery.min.js"></script>
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.4/js/bootstrap.min.js"></script>
	<script src="js/main.js"></script>
	<?php require 'includes/functions.php'; ?>
</head>


<body>
<?php require 'includes/header.php';?>
<?php require 'includes/zoekbalk.php';?>
<div class="container-fluid">
	<main class= "row">
		
		<div class="content">
			<div class="row">
				<?php getbreadcrumb($_GET['rub_nr']) ;?>
			</div>
			<div class="stroke-view">
			<?php 
				if (isset($_GET['page'])) {
					getRubriekArtikelen($_GET['rub_nr'], $_GET['page']);
				}
				else getRubriekArtikelen($_GET['rub_nr']); 

				//echo sqlPartAllSubRubrieken($_GET['rub_nr']);

			?>
			</div>
			<div>
			<?php 
			  	if (isset($_GET['page'])) {
					getPager($_GET['rub_nr'], $_GET['page']);
				}else getPager($_GET['rub_nr']); 

			?>
			</div>

		</div>	
	</main>
</div>
<?php include 'includes/footer.php';?>
<?php require 'includes/nav-rubriek.php';?>

</body>
</html>