<!DOCTYPE html>
<html lang="nl">		
<head>
	<title>Registreren</title>
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.4/css/bootstrap.min.css">
	<link rel="stylesheet" href="css/custom.css">
</head>
<body>
<?php
	require 'includes/connect.php';
	require 'includes/header.php';
?>
<div class="container-fluid">
	<div class="center-box">
		<h1>Registreren <small>Vul hier uw gegevens in.</small></h1>

		<form action="query_register.php" method="post">
			<div class="form-group">
				<label> Gebruikersnaam: </label>
				<input type="text" class="form-control" name="gebruikersnaam" placeholder="Uw gebruikersnaam mag bestaan uit letters en cijfers zonder spaties" />
			</div>
			
			<div class="form-group">
				<label> Naam: </label>
				<input type="text" class="form-control" name="voornaam" placeholder="Vul uw voornaam in" /> 
			</div>	
			
			<div class="form-group">			
				<label> Achternaam: </label>
				<input type="text" class="form-control" name="achternaam" placeholder="Vul uw achternaam in" />
			</div>
			
			 <div class="form-group">   
				<label> Adresregel 1: </label>
				<input type="text" class="form-control" name="adresregel1" placeholder="Adres 1" /> 
			</div>
			
			<div class="form-group">
				<label> Adresregel 2 (optioneel): </label>
				<input type="text" class="form-control" name="adresregel2" placeholder="Adres 2 (optioneel)" />
			</div>
			
			<div class="form-group">
				<label> Postcode: </label>
				<input type="text" class="form-control" name="postcode" placeholder="Vul uw postcode in" /> 
			</div>
			
			<div class="form-group">	
				<label> Plaatsnaam: </label>
				<input type="text" class="form-control" name="plaatsnaam" placeholder="Vul uw plaatsnaam in" />
			</div>	
				
			<div class="form-group">	
				<label> Land: </label>
				<input type="text" class="form-control" name="land" placeholder="Vul in in welk land u woont" />
			</div>
			
			<div class="form-inline">
				<label> Geboortedatum: </label>
				<select name="dag" class="form-control">
				<?php
					for ($i = 1; $i < 32; $i++) {
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
				
				<select name="maand" class="form-control">
				<?php
					for ($i = 1; $i < 13; $i++) {
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
				
				<select name="jaar" class="form-control">
				<?php
					for ($i = 1900; $i < 2016; $i++) {
					  echo '<option value="'.$i.'">'.$i.'</option>';
					}
				?>
				</select>
			</div>
				<br>
				
			<div class="form-inline">
				<label> Telefoon: </label>
				<select name="landcode" class="form-control">
				<?php	
					$landcodes = array(
					'+31 (NL)',
					'+32 (BE)',
					'+352 (LU)'
					);
					
					foreach ($landcodes as $input) {	
							echo '<option value="'.$input.'">'.$input.'</option>';
					}
				?>
				</select>
				<input type="text" class="form-control" name="telefoon" placeholder="Vul uw telefoonnummer in, inclusief netnummer indien van toepassing" />
			</div>
				<br>
				
			<div class="form-group">
				<label> Email: </label>
				<input type="text" name="email" class="form-control" placeholder="Vul uw e-mail adres in" /> 				
			</div>
				
				
			<div class="form-inline">
				<label> Password: </label>
				<input type="password" name="password" class="form-control" placeholder="Vul uw wachtwoord in" /> 
				&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
				<label> Password confirmatie: </label>
				<input type="password" name="password_confirm" class="form-control" placeholder="Wachtwoord nogmaals	" /> 
			</div>
				<br>
				
			<div class="form-group">
				<label> Beveiligingsvraag: </label>
				<select name="vraag" class="form-control">
				<?php
					$tsql = "SELECT TEKST_VRAAG FROM VRAAG";
					$result = sqlsrv_query($conn,$tsql,null);
					
					$i = 1;
					
					while ($row = sqlsrv_fetch_array($result,SQLSRV_FETCH_ASSOC)) {
						echo '<option value="'.$i.'">'.$i.'. '.$row['TEKST_VRAAG'].'</option>';
						$i++;
					}
				?>
				
				</select>
			</div>
				
			<div class="form-group">
				<label> Antwoordtekst: </label>
				<input type="text" name="antwoordtekst" class="form-control" placeholder="Vul het antwoord op uw beveiligingsvraag in" /> 
			</div>
						
			<div class="checkbox">
				<label><input type="checkbox" name="algemene_voorwaarden" value="akkoord">Ik ga akkoord met de <a href="ThuiswinkelVoorwaarden.pdf">algemene voorwaarden</a></label>
			</div>
				
				<button type="submit" name="register" class="btn btn-primary">Register</button><br><br>
		</form>
	</div>
</div>
<?php require 'includes/footer.php' ?>
</body>
</html>
