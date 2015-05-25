<!DOCTYPE html>
<html lang="nl">
<head>
	<title>Eenmaal Andermaal</title>
	<meta charset="utf-8">
  	<meta name="viewport" content="width=device-width, initial-scale=1">
  	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.4/css/bootstrap.min.css">
  	<link rel="stylesheet" href="//maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css">
 	<link rel="stylesheet" href="css/custom.css">
	<link rel="stylesheet" href="css/rubriek.css">
	<script src="js/main.js"></script>
	<?php require 'includes/functions.php'; ?>
</head>


<body>
<?php require 'includes/header.php';?>
<?php require 'includes/zoekbalk.php';?>
<div class="container-fluid">
	<main class= "row">
		<?php require 'includes/nav-rubriek.php';?>
		<div class="content">
			<div class="row">
				<div class="col-xs-12 left">
					<ol class="breadcrumb">
					  <li><a href="index.php">Home</a></li>
					  <li><a href="index.php">Alle categorieën</a></li>
					  <?php getbreadcrumb($_GET['rub_nr']) ;?>
					  
					</ol>
				</div>
			</div>

			
			<?php getRubriekArtikelen($_GET['rub_nr']); ?>
			<!-- <section class="product-box center-box">
					<div class="col-xs-3 box-img">
						<img class="plaatje" src="images/artikelen/product1-01.jpg" alt="Muis">
					</div>
					<div class="col-xs-9 box-text">
						<h3>USB Muis Logitech</h3>
						<p><strong>Beschrijving:</strong><br> Wie van toeters en bellen houdt kan beter een ander model kiezen, maar wie een snel werkende en betrouwbare...<a href="#">Lees verder</a></p>
						<div class="bottom-bar">	
							<div class="col-xs-7">
								<h5>22uur 22min 50sec</h5>
							</div>
							<div class="col-xs-2">
								<h5>€ 1,50</h5>
							</div>
							<div class="col-xs-3 right">
								<button type="submit" class="btn btn-success">Bied mee</button>
							</div>
						</div>
					</div>
			</section>
			<section class="product-box center-box">
					<div class="col-xs-3 box-img">
						<img class="plaatje" src="images/artikelen/product1-02.jpg" alt="Muis">
					</div>
					<div class="col-xs-9 box-text">
						<h3>Mooie zwarte muis</h3>
						<p><strong>Beschrijving:</strong><br> Wie van toeters en bellen houdt kan beter een ander model kiezen, maar wie een snel werkende en betrouwbare...<a href="#">Lees verder</a></p>
						<div class="bottom-bar">	
							<div class="col-xs-7">
								<h5>22uur 22min 50sec</h5>
							</div>
							<div class="col-xs-2">
								<h5>€ 6,00</h5>
							</div>
							<div class="col-xs-3 right">
								<button type="submit" class="btn btn-success">Bied mee</button>
							</div>
						</div>
					</div>
			</section>
			<section class="product-box center-box">
					<div class="col-xs-3 box-img">
						<img class="plaatje" src="images/artikelen/product1-03.jpg" alt="Muis">
					</div>
					<div class="col-xs-9 box-text">
						<h3>Draadloos muis</h3>
						<p><strong>Beschrijving:</strong><br> Wie van toeters en bellen houdt kan beter een ander model kiezen, maar wie een snel werkende en betrouwbare...<a href="#">Lees verder</a></p>
						<div class="bottom-bar">	
							<div class="col-xs-7">
								<h5>22uur 22min 50sec</h5>
							</div>
							<div class="col-xs-2">
								<h5>€ 4,50</h5>
							</div>
							<div class="col-xs-3 right">
								<button type="submit" class="btn btn-success">Bied mee</button>
							</div>
						</div>
					</div>
			</section>
			<section class="product-box center-box">
					<div class="col-xs-3 box-img">
						<img class="plaatje" src="images/artikelen/product1-04.jpg" alt="Muis">
					</div>
					<div class="col-xs-9 box-text">
						<h3>Gloednieuw met doos</h3>
						<p><strong>Beschrijving:</strong><br> Wie van toeters en bellen houdt kan beter een ander model kiezen, maar wie een snel werkende en betrouwbare...<a href="#">Lees verder</a></p>
						<div class="bottom-bar">	
							<div class="col-xs-7">
								<h5>22uur 22min 50sec</h5>
							</div>
							<div class="col-xs-2">
								<h5>€ 3,50</h5>
							</div>
							<div class="col-xs-3 right">
								<button type="submit" class="btn btn-success">Bied mee</button>
							</div>
						</div>
					</div>
			</section>
			<section class="product-box center-box">
					<div class="col-xs-3 box-img">
						<img class="plaatje" src="images/artikelen/product1-01.jpg" alt="Muis">
					</div>
					<div class="col-xs-9 box-text">
						<h3>USB Muis</h3>
						<p><strong>Beschrijving:</strong><br> Wie van toeters en bellen houdt kan beter een ander model kiezen, maar wie een snel werkende en betrouwbare...<a href="#">Lees verder</a></p>
						<div class="bottom-bar">	
							<div class="col-xs-7">
								<h5>22uur 22min 50sec</h5>
							</div>
							<div class="col-xs-2">
								<h5>€ 1,50</h5>
							</div>
							<div class="col-xs-3 right">
								<button type="submit" class="btn btn-success">Bied mee</button>
							</div>
						</div>
					</div>
			</section> -->
		</div>	
	</main>
</div>
<?php include 'includes/footer.php';?>

	<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.2/jquery.min.js"></script>
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.4/js/bootstrap.min.js"></script>
	<script src="js/main.js"></script>
</body>
</html>