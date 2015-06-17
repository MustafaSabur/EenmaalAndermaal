<!DOCTYPE html>
<html lang="nl">		
<head>
	<title>Toevoegen artikel</title>
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.4/css/bootstrap.min.css">
	<link rel="stylesheet" href="css/custom.css">
	<link rel="stylesheet" href="css/toevoegen.css">
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
?>
<div class="content"><div class="center-box">
<?php
	if (isset($_SESSION['loginnaam'])) {
		$session = $_SESSION['loginnaam'];
		require 'includes/nav-account.php';
	}
	else {
		$session = NULL;
	}

	$sql = "SELECT g.is_verkoper, v.actief
		FROM Gebruiker g inner join Verkoper v
		on g.gebruikersnaam = v.gebruiker
		WHERE GEBRUIKERSNAAM = '$session'";
	$result = sqlsrv_query($conn, $sql, null);
	$result1 = sqlsrv_query($conn, $sql, array(), array("Scrollable"=>"buffered"));
	$rowCount = sqlsrv_num_rows($result1);

	if ($rowCount == 0) {
		echo 'U moet ingelogd zijn om een veiling te starten.';
	}
	else {
		echo '<h1>Artikel toevoegen <small>Vul hier de details in.</small></h1>

			<form action="query_toevoegen-artikel.php" method="post" enctype="multipart/form-data">
			<div class="form-group">
				<label> Naam artikel: </label>
				<input type="text" class="form-control" name="naam_artikel" maxlength="24" placeholder="Naam van het artikel dat u wilt verkopen" />
			</div>
			
			<div class="form-group">
				<label> Beschrijving: </label>
				<textarea type="text" class="form-control" name="beschrijving" rows="3" maxlength="255" placeholder="Beschrijving van uw artikel"></textarea>
			</div>
			
			<div class="form-group">
				<label> Rubriek: </label>';
				 printRubrieken(-1, 'options');
			echo '</div>';
 			if(isset($_POST['rub_nr'])){
					echo
					'<div class="form-group" id="sub-rubriek">
					<label> Rubriek: </label>';
				 	printRubrieken($_POST['rub_nr'], 'options');
				 	echo '</div>';
				 }

			echo '<div class="form-group">';
				for ($i = 1; $i < 5; $i++) {
				echo '<label> Selecteer foto '.$i.': </label>
						<input class="toevoegen" type="file" name="fileToUpload'.$i.'" id="fileToUpload'.$i.'" accept="image/*"><br>';
				}
			echo '</div>
			
			<div class="form-group">			
				<label for="startprijs"> Startprijs (in euro): </label>
				<div class="input-group">
					<div class="input-group-addon">&euro;</div>
						<input class="form-control" id="startprijs" maxlength="10" name="startprijs" placeholder="Bedrag in hele euros" />
					<div class="input-group-addon">.00</div>
				</div>
			</div>
			
			 <div class="form-group">   
				<label> Betalingswijze: </label>
				<select name="betalingswijze" class="form-control">
					<option value="Creditcard">Creditcard</option>
					<option value="Paypal">PayPal</option>
					<option value="iDeal">iDeal</option>
					<option value="Contant">Contant</option>
				</select>
			</div>
			
			<div class="form-group">
				<label> Betalingsinstructie: </label>
					<textarea class="form-control" rows="3" maxlength="24" name="betalingsinstructie"></textarea>
			</div>
			
			<div class="form-group">
				<label> Plaatsnaam van waar het artikel zich bevind: </label>
				<input type="text" class="form-control" name="plaatsnaam" maxlength="24"  placeholder="Locatie artikel" /> 
			</div>
			
			<div class="form-group">
				<label> Land van waar het artikel zich bevind: </label>
				<input type="text" class="form-control" name="land" maxlength="24" placeholder="Land artikel" /> 
			</div>
			
			<div class="form-group">	
				<label> Looptijd veiling in dagen: </label>
				<select name="looptijd" class="form-control">';
					for ($i = 1; $i < 31; $i++) {
						if ($i < 10) {
							$i = '0'.$i;
							echo '<option value="'.$i.'">'.$i.'</option>';
						}
						else {
							echo '<option value="'.$i.'">'.$i.'</option>';
						}
					}
				echo '</select>
			</div>	
				
			<div class="form-group">	
				<label> Verzendkosten: </label>
				<select name="verzendkosten" class="form-control">
					<option value="0.00">Afhalen (&euro;0,00)</option>
					<option value="6.95">PostNL 0-10kg (&euro;6,95)</option>
					<option value="13.25">PostNL 10-30kg (&euro;13,25)</option>
				</select>
			</div>
			
			<div class="form-group">
				<label> Verzendinstructie: </label>
				<textarea class="form-control" rows="3" maxlength="255" name="verzendinstructie"></textarea>
			</div>
				<button type="submit" name="toevoegen-artikel" class="btn btn-primary">Voeg toe</button><br><br>
		</form>
<br><br><br>';
} ?>
	
</div>
</div>
<?php
require 'includes/footer.php'
?>
</body>
</html>
