<!DOCTYPE html>
<html lang="nl">
<head>
	<title>Muis</title>
	<meta charset="utf-8">
  	<meta name="viewport" content="width=device-width, initial-scale=1">
  	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.4/css/bootstrap.min.css">
 	<link rel="stylesheet" href="css/custom.css">
 	<link rel="stylesheet" href="css/product-box.css">
 	<link rel="stylesheet" href="css/artikel.css">
 	<?php require 'includes/functions.php'; ?>
</head>
<body>
<?php require 'includes/header.php';?>
<?php require 'includes/zoekbalk.php';?>
<div class="container-fluid">
	<div class="row">
		<?php require 'includes/nav-rubriek.php';?>
		<div class="content">
			<div class="row">
				<ol class="breadcrumb">
				  <li><a href="index.php">Home</a></li>
				  <li><a href="index.php">Alle categorieën</a></li>
				  <?php //getbreadcrumb($_GET['rub_nr']) ;?>			  
				</ol>
			</div>

			<div class="row">
				<div class="col-xs-12">
					<h1 class="titel left">Grijs USE 3.0 Muis</h1>
				</div>
			</div>
			<div class="row">
				<div class="col-xs-6 big-image">
                    <a href="#" class="thumbnail">
					    <img src="images/artikelen/product1-01.jpg" alt="foto muis">
                    </a>
				</div>
				<div class="col-xs-6 center">
					
					<div class="timer">
						<div class="text">
							<h3>Veiling eindigt in:</h3>
							<p class="time" id="time">0<span>d </span>0<span>h </span> 0<span>m </span> 0<span>s</span></p>
							<h3>Huidige Bod:</h3>
							<p>€6,00</p>
						</div>
					</div>
					<div class="info">
						<div class="text">
							<h3>Verkoper:</h3>
							<p>Kees Jansen</p>
							<h3>Actief sinds:</h3>
							<p>2 jaren</p>
							<h3>Plaats:</h3>
							<p>Arnhem</p>
						</div>
					</div>
				</div>
			</div>
			<div class="row thumb-row">
				<div class="col-xs-2">
					<a href="#" class="thumbnail">
						<img src="images/artikelen/product1-02.jpg" alt="foto muis">
					</a>
				</div>
				<div class="col-xs-2">
					<a href="#" class="thumbnail">
						<img src="images/artikelen/product1-03.jpg" alt="foto muis">
					</a>
				</div>
				<div class="col-xs-2">
					<a href="#" class="thumbnail">
						<img src="images/artikelen/product1-04.jpg" alt="foto muis">
					</a>
				</div>
			</div>
			<div class="row">
				<div class="col-xs-6">
					<h2>Bied Mee!</h2>
					<form class="form-inline">
					  <div class="form-group">
					    <label class="sr-only" for="InputBedrag">Bedrag (in Euro's)</label>
					    <div class="input-group">
					      <div class="input-group-addon">€</div>
					      <input type="text" class="form-control" id="InputBedrag" placeholder="Bedrag">
					      <!-- <div class="input-group-addon">.00</div> -->
					    </div>
					  </div>
					  <button type="submit" class="btn btn-success">Plaats een bod</button>
					</form>
				</div>
				<div class="col-xs-5">
					<h2>Biedgeschiedenis</h2>
					<div class="bid-history">
						<table class="table table-striped">
							<tr>
								<td>Volkan</td>
								<td>€ 6,00</td>
								<td>26 april '15</td>
							</tr>
							<tr>
								<td>Tom</td>
								<td>€ 5,00</td>
								<td>26 april '15</td>
							</tr>
							<tr>
								<td>Volkan</td>
								<td>€ 4,00</td>
								<td>26 april '15</td>
							</tr>
							<tr>
								<td>Sven</td>
								<td>€ 3,00</td>
								<td>26 april '15</td>
							</tr>
							<tr>
								<td>Mustafa</td>
								<td>€ 2,00</td>
								<td>26 april '15</td>
							</tr>
							<tr>
								<td>Tom</td>
								<td>€ 1,00</td>
								<td>26 april '15</td>
							</tr>
						</table>
					</div>
				</div>
			</div>
			<div class="row">
				<div class="col-xs-6">
					<h2>Informatie</h2>
				</div>
			</div>
			<div class="row">
				<div class="col-xs-10 col-xs-offset-1">
					<div role="tabpanel">
					  <!-- Nav tabs -->
					  <ul class="nav nav-tabs" role="tablist">
					    <li role="presentation" class="active"><a href="#beschrijving" aria-controls="beschrijving" role="tab" data-toggle="tab">Beschrijving</a></li>
					    <li role="presentation"><a href="#feedback" aria-controls="feedback" role="tab" data-toggle="tab">Feedback</a></li>
					    <li role="presentation"><a href="#info-verkoper" aria-controls="info-verkoper" role="tab" data-toggle="tab">Info Verkoper</a></li>
					  </ul>
					  <!-- Tab panes -->
					  <div class="tab-content">
					    <div role="tabpanel" class="tab-pane fade in active" id="beschrijving">
					    	Wie van toeters en bellen houdt kan beter een ander model kiezen, maar wie een snel werkende en betrouwbare muis zoekt kan met dit model direct uit de voeten. Het enige minpuntje is misschien de aan/uit schakelaar (om de batterij te besparen) die wat knullig en breekbaar overkomt. Hij ligt prima in de hand, is licht en voor de prijs hoef je het ook niet te laten.
					    </div>
					    <div role="tabpanel" class="tab-pane fade" id="feedback">
					    	<table class="table table-striped">
					    	<tr>
				    			<th>Naam</th>
				    			<th>Waardering</th>
				    			<th>Commentaar</th>
					    	</tr>
							<tr>
								<td>Volkan</td>
								<td>8/10</td>
								<td>Je krijgt wat je ziet!</td>
							</tr>
							<tr>
								<td>Mustafa</td>
								<td>7/10</td>
								<td>Snelle Levering en werkt prima!</td>
							</tr>
							<tr>
								<td>Tom</td>
								<td>8/10</td>
								<td>Betrouwbare verkoper</td>
							</tr>
							<tr>
								<td>Tom</td>
								<td>6/10</td>
								<td>Niet slecht</td>
							</tr>
						</table>
					    </div>
					    <div role="tabpanel" class="tab-pane fade" id="info-verkoper">.	3..</div>
					  </div>
					</div>
				</div>
			</div>
			<div class="row">
				<div class="col-xs-6">
					<h2></h2>
				</div>
			</div>
			<div class="row">
				<div class="col-xs-12">
					<div class="product-box">
						<h1>Vergelijkbare artikelen</h1>
						<div class="product-row" id="l-minute">
							<a href="artikel.php" class="product">
								<div class="product-img ">
									<img src="images/artikelen/product1-01.jpg" alt="iphone">
								</div>
		                        <h5>Grijs USB 3.0 Muis</h5>
		                        <h5>Computer Accessoires</h5>
								<h5>Huidige bod</h5>
		                        <h4>€3,00</h4>
								<p class="time" id="time"></p>
							</a>
							<a href="artikel.php" class="product">
								<div class="product-img ">
									<img src="images/artikelen/product2-01.jpg" alt="iphone">
								</div>
								<h5 title="Zwarte Logitech Luidsprekers">Zwarte Logitech Luidsprekers</h5>
		                        <h5>Luidsprekers</h5>
		                        <h5>Huidige bod</h5>
								<h4>€80,00</h4>
								<p class="time" id="time2"></p>
							</a>
							<a href="artikel.php" class="product">
								<div class="product-img ">
									<img src="images/artikelen/product3-01.jpg" alt="iphone">
								</div>
								<h5>Batavus herenfiets</h5>
		                        <h5>Fietsen</h5>
		                        <h5>Huidige bod</h5>
								<h4>€120,00</h4>
								<p class="time" id="time2"></p>
							</a>
							<a href="artikel.php" class="product">
								<div class="product-img ">
									<img src="images/artikelen/product4-01.jpg" alt="iphone">
								</div>
		                        <h5>Macbook Air</h5>
								<h5>Laptops</h5>
		                        <h5>Huidige bod</h5>
								<h4>€450,00</h4>
								<p class="time" id="time2"></p>
							</a>
							<a href="artikel.php" class="product">
								<div class="product-img ">
									<img src="images/artikelen/product5-01.jpg" alt="iphone">
								</div>
		                        <h5>Electronische transporter</h5>
								<h5>Diversen</h5>
		                        <h5>Huidige bod</h5>
								<h4>€995,00</h4>
								<p class="time" id="time2"></p>
							</a>
							<a href="artikel.php" class="product">
								<div class="product-img ">
									<img src="images/artikelen/product11-01.jpg" alt="iphone">
								</div>
		                        <h5>Beats by Dre</h5>
		                        <h5>Koptelefoons</h5>
		                        <h5>Huidige bod</h5>
								<h4>€3,00</h4>
								<p class="time" id="time"></p>
							</a>
							<a href="artikel.php" class="product">
								<div class="product-img ">
									<img src="images/artikelen/product12-01.jpg" alt="iphone">
								</div>
		                        <h5>iPhone 6</h5>
		                        <h5>Telefoons</h5>
		                        <h5>Huidige bod</h5>
								<h4>€80,00</h4>
								<p class="time" id="time2"></p>
							</a>
							<a href="artikel.php" class="product">
								<div class="product-img ">
									<img src="images/artikelen/product13-01.jpg" alt="iphone">
								</div>
		                        <h5>Filling Pieces</h5>
		                        <h5>Schoenen</h5>
		                        <h5>Huidige bod</h5>
								<h4>€120,00</h4>
								<p class="time" id="time2"></p>
							</a>
							<a href="artikel.php" class="product">
								<div class="product-img ">
									<img src="images/artikelen/product14-01.jpg" alt="iphone">
								</div>
		                        <h5>Mercedes</h5>
		                        <h5>Auto's</h5>
		                        <h5>Huidige bod</h5>
								<h4>€94.500,00</h4>
								<p class="time" id="time2"></p>
							</a>
							<a href="artikel.php" class="product">
								<div class="product-img ">
									<img src="images/artikelen/product15-01.jpg" alt="iphone">
								</div>
		                        <h5>Richard Mille</h5>
		                        <h5>Horloges</h5>
		                        <h5>Huidige bod</h5>
								<h4>€995,00</h4>
								<p class="time" id="time2"></p>
							</a>
							<a href="artikel.php" class="product">
								<div class="product-img ">
									<img src="images/artikelen/product16-01.jpg" alt="iphone">
								</div>
		                        <h5>Stüssy T-Shirt</h5>
		                        <h5>Kleding</h5>
		                        <h5>Huidige bod</h5>
								<h4>€3,00</h4>
								<p class="time" id="time"></p>
							</a>
							<a href="artikel.php" class="product">
								<div class="product-img ">
									<img src="images/artikelen/product17-01.jpg" alt="iphone">
								</div>
		                        <h5>Heesen Yachts</h5>
		                        <h5>Jachten</h5>
		                        <h5>Huidige bod</h5>
								<h4>€16.000.000</h4>
								<p class="time" id="time2"></p>
							</a>
							<a href="artikel.php" class="product">
								<div class="product-img ">
									<img src="images/artikelen/product18-01.jpg" alt="iphone">
								</div>
		                        <h5>PlayStation 4</h5>
								<h5>Spelcomputers</h5>
		                        <h5>Huidige bod</h5>
								<h4>€320,00</h4>
								<p class="time" id="time2"></p>
							</a>
							<a href="artikel.php" class="product">
								<div class="product-img ">
									<img src="images/artikelen/product19-01.jpg" alt="iphone">
								</div>
		                        <h5>Mechanical Dummy</h5>
								<h5>Kleding</h5>
		                        <h5>Huidige bod</h5>
								<h4>€20,00</h4>
								<p class="time" id="time2"></p>
							</a>
						</div>
						<div class="arrow-left" onclick="scrollL('l-minute')">
							<img src="images/r_arrow.png" alt="leftarrow">
							<img src="images/r_arrow_trans.png" alt="leftarrow">
							
						</div>
						<div class="arrow-right" onclick="scrollR('l-minute')">
							<img src="images/r_arrow.png" alt="rightarrow">
							<img src="images/r_arrow_trans.png" alt="rightarrow">
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
<?php require 'includes/footer.php';?>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.2/jquery.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.4/js/bootstrap.min.js"></script>
<script src="js/main.js"></script>

</body>