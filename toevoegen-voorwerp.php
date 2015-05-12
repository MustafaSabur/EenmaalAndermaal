<!DOCTYPE html>
<html lang="nl">		
<head>
	<title>Toevoegen voorwerp</title>
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.4/css/bootstrap.min.css">
	<link rel="stylesheet" href="//maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css">
	<link rel="stylesheet" href="css/custom.css">
</head>
<body>
<?php
	require 'includes/connect.php';
	require 'includes/header.php';
?>
<div class="container-fluid">
	<div class="center-box">
		<h1>Voorwerp toevoegen <small>Vul hier de details in.</small></h1>

			<form action="query_voorwerp_toevoegen.php" method="post">
			<div class="form-group">
				<label> Naam voorwerp: </label>
				<input type="text" class="form-control" name="naam_voorwerp" placeholder="Naam van het voorwerp dat u wilt verkopen" />
			</div>
			
			<div class="form-group">
				<label> Beschrijving: </label>
				<input type="text" class="form-control" name="beschrijving" placeholder="Beschrijving van uw voorwerp" /> 
			</div>
			
			<div class="form-group">
				<label> Selecteer foto's: </label>
					<input type="file" name="fotos" accept="image/*" multiple>
			</div>
			
			<div class="form-group">			
				<label for="startprijs"> Startprijs (in euro): </label>
				<div class="input-group">
					<div class="input-group-addon">&euro;</div>
						<input type="text" class="form-control" id="startprijs" placeholder="Bedrag">
					<div class="input-group-addon">.00</div>
				</div>
			</div>
			
			 <div class="form-group">   
				<label> Betalingswijze: </label>
				<select name="betalingswijze" class="form-control">
					<option value="creditcard">Creditcard</option>
					<option value="paypal">PayPal</option>
					<option value="ideal">iDeal</option>
					<option value="contant">Contant</option>
				</select>
			</div>
			
			<div class="form-group">
				<label> Betalingsinstructie: </label>
					<textarea class="form-control" rows="3" name="verzendinstructie"></textarea>
			</div>
			
			<div class="form-group">
				<label> Plaatsnaam van waar het voorwerp zich bevind: </label>
				<input type="text" class="form-control" name="plaatsnaam" placeholder="Locatie voorwerp" /> 
			</div>
			
			<div class="form-group">	
				<label> Looptijd veiling in dagen: </label>
				<select name="looptijd" class="form-control">
				<?php
					for ($i = 1; $i < 31; $i++) {
						if ($i < 10) {
							$i = '0'.$i;
							echo '<option value="'.$i.'">'.$i.'</option>';
						}
						else {
							echo '<option value="'.$i.'">'.$i.'</option>';
						}
					}
				?>
				</select>
			</div>	
				
			<div class="form-group">	
				<label> Verzendkosten: </label>
				<select name="betalingswijze" class="form-control">
					<option value="ideal">Afhalen (&euro;0,00)</option>
					<option value="creditcard">PostNL 0-10kg (&euro;6,95)</option>
					<option value="paypal">PostNL 10-30kg (&euro;13,25)</option>
				</select>
			</div>
			
			<div class="form-group">
				<label> Verzendinstructie: </label>
				<textarea class="form-control" rows="3" name="verzendinstructie"></textarea>
			</div>
				<button type="submit" name="register" class="btn btn-primary">Toevoegen</button><br><br>
			</form>
		</div>
	</div>
<?php
	require 'includes/footer.php'
?>
</body>
</html>
