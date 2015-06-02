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
 	<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.2/jquery.min.js"></script>
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.4/js/bootstrap.min.js"></script>
	<script src="js/main.js"></script>
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
				<?php getbreadcrumb($_GET['rub_nr']) ;?>			  	
			</div>
			<?php  
			$inhoudPagina = array();
			$inhoudPagina = (fillProductPagina($_GET['id']));
			?>
			<div class="row">
				<div class="col-xs-12">
					<?php 
					echo '<h1 class="titel left">'.$inhoudPagina['titel'].'</h1>';
					?>
				</div>
			</div>
			<div class="row">
				<div class="col-xs-5 big-image">
                    <a href="#" class="big-img">
                    <?php 
                    $images = getArtikelImages($_GET['id']);
					echo '<img src="'.$images[0].'" alt="Afbeelding kan niet worden geladen">';
                   ?>
                    </a>
                    <div class="row thumb-row">
                    <?php  loadImgDetailsPage($images)?>
                    </div>
				</div>
				<div class="col-xs-6 center">

					<div class="timer">
						<div class="text">
							<h3>Veiling eindigt in:</h3>
							<?php
							$d = $inhoudPagina['eindedag'];
							$t = $inhoudPagina['begintijdstip'];
							$date = "'".$d->format('Y-m-d')." ".$t->format('H:i:s')."'";
							echo '<p class="time" id="time">';
							echo'<script>CountDownTimer('.$date.', "time") </script>';
							echo '</p>';
							?>
							<br><br><h3>Huidige Bod:</h3>
                            <div class="productbod"><p>
                                <?php
                                echo getHoogsteBod($inhoudPagina);
                                ?>
                            </p></div>
						</div>
					</div>
					<div class="info">
						<div class="text">
							<h3>Verkoper:</h3>
							<?php 
							echo '<p>'.$inhoudPagina['gebruiker'].'</p>';
							?>
							<h3>Plaats:</h3>
							<?php 
							echo '<p>'.$inhoudPagina['plaatsnaam'].'</p>';
							?>
							<h3>land:</h3>
							<?php
							echo '<p>'.$inhoudPagina['land'].'</p>';
							?>
						</div>
					</div>
				</div>
			</div>
			<div class="row">
				<div class="col-xs-6">
					<br><br><h2>Bied Mee!</h2>
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
					<br><br><h2>Biedgeschiedenis</h2>
					<div class="bid-history">
						<table class="table table-striped">
						<?php
							$biedingen = getArtikelBod($_GET['id']); 
						if(!empty($biedingen))
						{
							foreach ($biedingen as $key => $value) 
							{
								$d = $value['bod_dag'];
								$t = $value['bod_tijdstip'];
								$date = "'".$d->format('Y-m-d')." ".$t->format('H:i:s')."'";
								echo '<tr>';
								echo	'<td>'.$value['gebruiker'].'</td>';
								echo	'<td> &euro;'.$value['bodbedrag'].'</td>';
								echo	'<td>'.$date.'</td>';
								echo '</tr>';
							}
						}
						?>
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
					    	<?php
					    	$beschrijving = $inhoudPagina['beschrijving'];
                			$beschrijving = preg_replace("|<script\b[^>]*>(.*?)</script>|s", "", $beschrijving);
                			$beschrijving = preg_replace("|<style\b[^>]*>(.*?)</style>|s", "", $beschrijving);
                			$beschrijving = strip_tags($beschrijving);
                			$beschrijving = trim($beschrijving);
					    	echo '<td>'.$beschrijving. '</td>';
					    	?>
					    </div>
					    <div role="tabpanel" class="tab-pane fade" id="feedback">
					    	<table class="table table-striped">
					    	<tr>
				    			<th>Naam</th>
				    			<th>Waardering</th>
				    			<th>Commentaar</th>
					    	</tr>
					    	<?php  
							for($i =0; $i < 6; $i++)
							{
							echo '<tr>';
							echo	'<td>'.$inhoudPagina['commentaar'].'</td>';
							echo	'<td>'.$inhoudPagina['rating'].'</td>';
							echo	'<td>'.$inhoudPagina['dag'].'</td>';
							echo	'<td>'.$inhoudPagina['soort_gebruiker'].'</td>';
							echo	'<td>'.$inhoudPagina['tijdstip'].'</td>';
							echo '</tr>';
							}
							?>
						</table>
					    </div>
					    <div role="tabpanel" class="tab-pane fade" id="info-verkoper">
					    <?php 
					    	echo'<td>Bank:'.$inhoudPagina['bank'].'</td><br><br>';
					    	echo'<td>Bankrekening:'.$inhoudPagina['bankrekening'].'</td><br><br>';
					    	echo'<td>Creditcard:'.$inhoudPagina['creditcard'].'</td><br><br>';
					    	echo'<td>Verzendkosten:'.$inhoudPagina['verzendkosten'].'</td><br><br>';
					    	echo'<td>Verzendinstructies:'.$inhoudPagina['verzendinstructies'].'</td><br><br>';
					    ?>
					    </div>
					  </div>
					</div>
				</div>
			</div>
			<div class="row">
				<div class="col-xs-12">
					<?php 
						printProductRow('vergelijkbaar', 15, $_GET['rub_nr']); 
					?>
				</div>
			</div>
		</div>
	</div>
</div>
<?php require 'includes/footer.php';?>

</body>