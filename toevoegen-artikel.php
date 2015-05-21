<!DOCTYPE html>
<html lang="nl">		
<head>
	<title>Toevoegen artikel</title>
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.4/css/bootstrap.min.css">
	<link rel="stylesheet" href="//maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css">
	<link rel="stylesheet" href="css/custom.css">
</head>
<body>
<?php
	require 'includes/connect.php';
	require 'includes/header.php';
	require 'includes/zoekbalk.php';
?>
<div class="container-fluid">
<?php
	require 'includes/nav-account.php';
?>
	<div class="center-box">
		<h1>Artikel toevoegen <small>Vul hier de details in.</small></h1>

			<form action="query_toevoegen-artikel.php" method="post" enctype="multipart/form-data">
			<div class="form-group">
				<label> Naam artikel: </label>
				<input type="text" class="form-control" name="naam_artikel" placeholder="Naam van het artikel dat u wilt verkopen" />
			</div>
			
			<div class="form-group">
				<label> Beschrijving: </label>
				<input type="text" class="form-control" name="beschrijving" placeholder="Beschrijving van uw artikel" /> 
			</div>
			
			<div class="form-group">
				<label> Rubriek: </label>
				<select name="rubriek" class="form-control">
				<?php
					$sql = "SELECT RUBRIEKNUMMER, RUBRIEKNAAM FROM RUBRIEK";
					$result = sqlsrv_query($conn,$sql,null);
					
					$i = 1;
					
					while ($row = sqlsrv_fetch_array($result,SQLSRV_FETCH_ASSOC)) {
						echo '<option value="'.$row['RUBRIEKNUMMER'].'">'.$i.'. '.$row['RUBRIEKNAAM'].'</option>';
						$i++;
					}
				?>
				</select>
			</div>
			
			<div class="form-group">
				<label> Selecteer foto's: </label>
					<input type="file" name="fileToUpload" accept="image/*">
			</div>
			
			<div class="form-group">			
				<label for="startprijs"> Startprijs (in euro): </label>
				<div class="input-group">
					<div class="input-group-addon">&euro;</div>
						<input type="text" class="form-control" id="startprijs" name="startprijs" placeholder="Bedrag">
					<div class="input-group-addon">.00</div>
				</div>
			</div>
			
			 <div class="form-group">   
				<label> Betalingswijze: </label>
				<select name="betalingswijze" class="form-control">
					<option value="Creditcard">Creditcard</option>
					<option value="paypal">PayPal</option>
					<option value="ideal">iDeal</option>
					<option value="contant">Contant</option>
				</select>
			</div>
			
			<div class="form-group">
				<label> Betalingsinstructie: </label>
					<textarea class="form-control" rows="3" name="betalingsinstructie"></textarea>
			</div>
			
			<div class="form-group">
				<label> Plaatsnaam van waar het artikel zich bevind: </label>
				<input type="text" class="form-control" name="plaatsnaam" placeholder="Locatie artikel" /> 
			</div>
			
			<div class="form-group">
				<label> Land van waar het artikel zich bevind: </label>
				<input type="text" class="form-control" name="land" placeholder="Land artikel" /> 
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
				<select name="verzendkosten" class="form-control">
					<option value="0.00">Afhalen (&euro;0,00)</option>
					<option value="6.95">PostNL 0-10kg (&euro;6,95)</option>
					<option value="13.25">PostNL 10-30kg (&euro;13,25)</option>
				</select>
			</div>
			
			<div class="form-group">
				<label> Verzendinstructie: </label>
				<textarea class="form-control" rows="3" name="verzendinstructie"></textarea>
			</div>
				<button type="submit" name="toevoegen-artikel" class="btn btn-primary">Voeg toe</button><br><br>
			</form>
		</div>
	</div>
<?php
	require 'includes/footer.php'
?>
</body>
</html>
