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
		<div class="content artikel-view">
			<?php
			$data = getProductInfo($_GET['id']);
		
			$biedingen = getArtikelBod($data['nr']);
            $hoogsteBod = $biedingen[0]['bodbedrag'];
            $data['prijs']  = ($hoogsteBod > $data['startprijs']) ? $hoogsteBod : $data['startprijs'];
			$images = getArtikelImages($data['nr']);
			?>
			<div class="row">	
				<?php getbreadcrumb($data['rubrieknummer']) ;?>			  	
			</div>
			<div class="row">
				<h1 class="titel"> <?=$data['titel'];?></h1>
			</div>
			<!-- active plaatje en info blokjes -->
			<div class="row">
				<!-- blokje links van de grote foto -->
				<div class="col-xs-3">
					<div class="info">
						<h5>Resterende tijd</h5>
						<?php
						$d = $data['eindedag'];
						$t = $data['begintijdstip'];
						$date = "'".$d->format('Y m d')." ".$t->format('H:i:s')."'";
						echo '<h3 class="time" id="time">00:00:00</h3>';
						echo'<script>CountDownTimer('.$date.', "time") </script>';
						?>
						<h5><?= ($hoogsteBod > $data['startprijs']) ? 'Huidige Bod' : 'Startprijs' ;?></h5>
                    	<h3>&euro; <?=$data['prijs'];?></h3>
                    </div>
				</div>
				<!-- de grote foto -->
				<div class="col-xs-6 big-image-box">
					<?php 
					foreach ($images as $k => $v) {
						echo 	'<div id="image'.$k.'" class="big-image">
								 <img src="http://iproject27.icasites.nl/'.$v.'" alt="Afbeelding kan niet worden geladen">
	                  			 </div>';
	                }
                 	?>
                </div>
                <!-- blokje rechts van de grote foto -->
				<div class="col-xs-3">
					<div class="info"> 					
						<h5>Verkoper</h5>
						<h3><?=$data['gebruiker'];?></h3>
						<h5>Plaats</h5>
						<h3><?=$data['plaatsnaam'];?>, <?=$data['land'];?></h3>
					</div>
				</div>
            </div>
            <!-- rij met de thumbnails -->
            <div class="row">
            	<div class="col-xs-12">
            		<div class="thumbs-box">
            			<?php
            			for($i = 0; $i < 4; $i++){
					        echo '<div class="thumb">';
					        echo (!empty($images[$i])) 
					                ? '<img id="thumbnail'.$i.'" src="http://iproject27.icasites.nl/'.$images[$i].'" alt="Afbeelding kan niet worden gelanden.">' 
					                : '<img src="images/no-image.jpg">';
					        echo '</div>';
    					}
            			?>
            		</div>
            	</div>
            </div>
            <!-- knopje om te bieden -->
            <div class="row">
        		<div class="call-to-action">
					<form class="form-inline" method="POST" action="query_bieding.php">
						<div class="form-group">
				   			<label class="sr-only" for="InputBedrag">Bedrag (in Euros)</label>
				    			<div class="input-group">
				     				<div class="input-group-addon">&euro;</div>
				      					<input type="text" class="form-control" name="InputBedrag" placeholder="Bedrag" maxlength="9">
				      					<input type="hidden" name="voorwerpID" value="<?= $data['nr'];?>">
				      					<input type="hidden" name="rubriekID" value="<?= $data['rubrieknummer'];?>">
				      					<input type="hidden" name="hoogsteBod" value="<?= $hoogsteBod;?>">
				    			</div>
				  		</div>
				  		<button type="submit" class="btn btn-success">Plaats een bod</button>
					</form>
        		</div>
            </div>
            <!-- Bied geschiedenis -->
            <div class="row">
 				<div class="col-xs-6 col-xs-offset-3">
					<div class="bid-history">
						<table class="table table-striped">
							<?php
							if(!empty($biedingen)){
								foreach ($biedingen as $key => $value) {
									$d = $value['bod_dag'];
									$t = $value['bod_tijdstip'];
									$date = "'".$d->format('Y m d')." ".$t->format('H:i:s')."'";
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
			<!-- Gedeelte met de tabjes-->
			<div class="row ">
				<div class="col-xs-10 col-xs-offset-1">
					<div role="tabpanel" class="tabpanel">
					  <!-- Nav tabs -->
					  <ul class="nav nav-tabs" role="tablist">
					    <li role="presentation" class="active"><a href="#beschrijving" aria-controls="beschrijving" role="tab" data-toggle="tab">Beschrijving</a></li>
					    <li role="presentation"><a href="#feedback" aria-controls="feedback" role="tab" data-toggle="tab">Feedback</a></li>
					    <li role="presentation"><a href="#info-verkoper" aria-controls="info-verkoper" role="tab" data-toggle="tab">Info Verkoper</a></li>
					  </ul>
					  <!-- Tab panes -->
					  <div class="tab-content">
					  	<!-- tab beschrijving -->
					    <div role="tabpanel" class="tab-pane fade in active" id="beschrijving">
					    	<?=$data['beschrijving'];?>
					    </div>
					    <!-- tab feedback -->
					    <div role="tabpanel" class="tab-pane fade" id="feedback">
					    	<table class="table table-striped">
					    	<tr>
				    			<th class="cols1 col">Soort gebruiker</th>
				    			<th class="cols1 col">Waardering</th>
				    			<th class="cols1 col">Commentaar</th>
					    	</tr>
					    	<?php  
					    	$conn = dbConnected();
					    	$sql =  "SELECT soort_gebruiker, rating, commentaar FROM feedback WHERE voorwerp = ".$_GET['id']."";
					    	$result = sqlsrv_query($conn, $sql, array(), array("Scrollable"=>"buffered"));
	
							$rowCount = sqlsrv_num_rows($result);

							while ($row = sqlsrv_fetch_array($result,SQLSRV_FETCH_ASSOC))
							{
							echo '<tr>';
							echo	'<td>'.$row['soort_gebruiker'].'</td>';
							echo	'<td>'.$row['rating'].'</td>';
							//echo	'<td>'.$data['dag'].'</td>';
							echo	'<td>'.$row['commentaar'].'</td>';
							//echo	'<td>'.$data['tijdstip'].'</td>';
							echo '</tr>';
							}
							?>
						</table>
								<form action="feedback_geven.php" method="GET">
									<div>
										<button type ="submit" class="btn btn-success" name="submit">Feedback geven</button>
										<input type="hidden" name="voorwerpID" value="<?= $data['nr'];?>">
					      				<input type="hidden" name="rubriekID" value="<?= $data['rubrieknummer'];?>">
									</div>
								</form>
					    </div>
					    <!-- tab verkoper informatie -->
					    <div role="tabpanel" class="tab-pane fade" id="info-verkoper">
					    	<table class="table table-striped">
					    <?php
					    	echo'<tr>
					    			<th>Naam</th><td>'.$data['gebruiker'].'</td>
					    		</tr>';
					    	echo'<tr>
					    			<th>Bank</th><td>'.$data['bank'].'</td>
					    		</tr>';
					    	echo'<tr>
					    			<th>Bankrekening</th><td>'.$data['bankrekening'].'</td>
					    		</tr>';
					    	echo'<tr>
					    			<th>Creditcard</th><td>'.$data['creditcard'].'</td>
					    		</tr>';
					    	echo'<tr>
					    			<th>Verzendkosten</th><td>&euro; '.$data['verzendkosten'].'</td>
					    		</tr>';
					    	echo'<tr>
					    			<th>Verzendinstructies</th><td>'.$data['verzendinstructies'].'</td>
					    		</tr>';
					    ?>
					    	</table>
					    		<form action="extra_info.php" method="GET">
									<div>
										<button type ="submit" class="btn btn-success" name="submit">Extra info</button>
										<input type="hidden" name="voorwerpID" value="<?= $data['nr'];?>">
					      				<input type="hidden" name="rubriekID" value="<?= $data['rubrieknummer'];?>">
					      			</div>
								</form>
					    </div>
					  </div>
					</div>
				</div>
			</div>

			<!-- laat vergelijkbare producten zien -->
			<div class="row">
				<div class="col-xs-12">
					<?php 
						printProductRow('vergelijkbaar', 15, $data['rubrieknummer']); 
					?>
				</div>
			</div>
		</div>
	</div>
</div>
<?php require 'includes/footer.php';?>
</body>