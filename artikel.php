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
			$i = array();
			$i = (fillProductPagina($_GET['id']));
			?>
			<div class="row">
				<h1 class="titel"> <?=$i['titel'];?></h1>
			</div>
			<div class="row">
				<div class="col-xs-5 big-image">
                    <?php 
                    $images = getArtikelImages($i['nr']);
                    //$img_thumbs = getArtitkelImages($i['nr'], 'thumbnail');
					echo '<img src="http://iproject27.icasites.nl/'.$images[0].'" alt="Afbeelding kan niet worden geladen">';
                   ?>

                </div>
                <div class="col-xs-7"></div>

            </div>
            <div class="row">
				<?php  loadthumbs($images); ?>
			</div>
				<div class="col-xs-7">

					<div class="timer">
						<div class="text">
							<h3><strong>Veiling eindigt in:</strong></h3>
							<?php
							$d = $i['eindedag'];
							$t = $i['begintijdstip'];
							$date = "'".$d->format('Y/m/d')." ".$t->format('H:i:s')."'";
							echo '<p class="time" id="time">';
							echo'<script>CountDownTimer('.$date.', "time") </script>';
							echo '</p>';
							?>
							<br><br><h3><strong>Huidige Bod:</strong></h3>
                            <div class="productbod"><p>
                                <?php
                                //echo ($i);
                                ?>
                            </p></div>
						</div>
					</div>
					<div class="info">
						<div class="text">
							<h3><strong>Verkoper:</strong></h3>
							<?php 
							echo '<p>'.$i['gebruiker'].'</p>';
							?>
							<h3><strong>Plaats:</strong></h3>
							<?php 
							echo '<p>'.$i['plaatsnaam'].'</p>';
							?>
							<h3><strong>Land:</strong></h3>
							<?php
							echo '<p>'.$i['land'].'</p>';
							?>
						</div>
					</div>
				</div>
			</div>
				<div class="row">
				<div class="col-xs-6">
					<br><br><h2>Bied Mee!</h2>
						<form class="form-inline" method="POST" action="query_bieding.php">
							<div class="form-group">
					   			<label class="sr-only" for="InputBedrag">Bedrag (in Euros)</label>
					    			<div class="input-group">
					     				<div class="input-group-addon">€</div>
					      					<input type="text" class="form-control" name="InputBedrag" placeholder="Bedrag" maxlength="9">
					      					<input type="hidden" name="voorwerpID" value="<?= $_GET['id'];?>">
					      					<input type="hidden" name="rubriekID" value="<?= $_GET['rub_nr'];?>">
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
					    	$beschrijving = $i['beschrijving'];
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
							echo	'<td>'.$i['commentaar'].'</td>';
							echo	'<td>'.$i['rating'].'</td>';
							echo	'<td>'.$i['dag'].'</td>';
							echo	'<td>'.$i['soort_gebruiker'].'</td>';
							echo	'<td>'.$i['tijdstip'].'</td>';
							echo '</tr>';
							}
							?>
						</table>
					    </div>
					    <div role="tabpanel" class="tab-pane fade" id="info-verkoper">
					    <?php 
					    	echo'<td>Bank:'.$i['bank'].'</td><br><br>';
					    	echo'<td>Bankrekening:'.$i['bankrekening'].'</td><br><br>';
					    	echo'<td>Creditcard:'.$i['creditcard'].'</td><br><br>';
					    	echo'<td>Verzendkosten:'.$i['verzendkosten'].'</td><br><br>';
					    	echo'<td>Verzendinstructies:'.$i['verzendinstructies'].'</td><br><br>';
					    ?>
					    </div>
					  </div>
					</div>
				</div>
			</div>
			<br><br><br><br>

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