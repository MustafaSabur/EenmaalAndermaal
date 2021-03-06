<!DOCTYPE html>
<html lang="nl">		
<head>
	<title>Registreren</title>
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.4/css/bootstrap.min.css">
	<link rel="stylesheet" href="css/custom.css">
	<link rel="stylesheet" type="text/css" href="css/register.css">
</head>
<body>
<?php
	include 'includes/connect.php';
	include 'includes/functions.php';
	include 'includes/header.php';
?>
<div class="container-fluid">
		<?php include'includes/query_register.php'; ?>
	<div class="center-box">
		<h1>Registreren <small>Vul hier uw gegevens in.</small></h1>
	
		<form action="<?=$current_page?>" method="post">
			<div class="form-group">
				<label> Gebruikersnaam: </label>
				<input type="text" class="form-control" maxlength="24" name="gebruikersnaam" placeholder="Uw gebruikersnaam mag bestaan uit letters en cijfers zonder spaties" value="<?=$gebruikersnaam;?>"/>
			</div>
			
			<div class="form-group">
				<label> Naam: </label>
				<input type="text" class="form-control" maxlength="24" name="voornaam" placeholder="Vul uw voornaam in" value="<?= $voornaam;?>"/> 
			</div>	
			
			<div class="form-group">			
				<label> Achternaam: </label>
				<input type="text" class="form-control" maxlength="24" name="achternaam" placeholder="Vul uw achternaam in" value="<?= $achternaam;?>"/>
			</div>
			
			 <div class="form-group">   
				<label> Adresregel 1: </label>
				<input type="text" class="form-control" maxlength="24" name="adresregel1" placeholder="Adres 1" value="<?= $adresregel1;?>"/> 
			</div>
			
			<div class="form-group">
				<label> Adresregel 2 (optioneel): </label>
				<input type="text" class="form-control" maxlength="24" name="adresregel2" placeholder="Adres 2 (optioneel)" value="<?= $adresregel2;?>"/>
			</div>
			
			<div class="form-group">
				<label> Postcode: </label>
				<input type="text" class="form-control" maxlength="6" name="postcode" placeholder="Vul uw postcode in" value="<?= $postcode;?>"/> 
			</div>
			
			<div class="form-group">	
				<label> Plaatsnaam: </label>
				<input type="text" class="form-control" maxlength="24" name="plaatsnaam" placeholder="Vul uw plaatsnaam in" value="<?= $plaatsnaam;?>"/>
			</div>	
				
			<div class="form-group">	
				<label> Land: </label>
				<select name="land" class="form-control" maxlength="13">
				<?php	
					$landcodes = array (
					'Nederland',
					'Belgie',
					'Duitsland'
					);
					
					foreach ($landcodes as $input){
						if($input == $land){
							echo '<option value="'.$input.'" selected="selected">'.$input.'</option>';
						}else{
							echo '<option value="'.$input.'">'.$input.'</option>';
						}
					}
				?>
				</select>
			</div>
			
			<div class="form-inline">
				<label> Geboortedatum: </label>
				<select name="dag" class="form-control">
				<?php
					for ($i = 1; $i < 32; $i++) {
						if ($i < 10) {
							$i = '0'.$i;
						}
						$option = ($i == $dag) ? '<option value="'.$i.'" selected="selected">'.$i.'</option>' : '<option value="'.$i.'">'.$i.'</option>' ;
						echo $option;
					}
				?>
				</select>
				
				<select name="maand" class="form-control">
				<?php
					for ($i = 1; $i < 13; $i++) {
						if ($i < 10) {
							$i = '0'.$i;
						}
						$option = ($i == $maand) ? '<option value="'.$i.'" selected="selected">'.$i.'</option>' : '<option value="'.$i.'">'.$i.'</option>' ;
						echo $option;
					}
				?>
				</select>
				
				<select name="jaar" class="form-control">
				<?php
					for ($i = 1900; $i < 2016; $i++) {
						if ($i == $jaar) {
							echo '<option value="'.$i.'" selected="selected">'.$i.'</option>';
						} else {
							echo '<option value="'.$i.'">'.$i.'</option>';						}
						
					  
					}
				?>
				</select>
			</div>
				<br>
				
			<div class="form-inline">
				<label> Telefoon: </label>
				<select name="landcode" class="form-control" maxlength="13">
				<?php	
					$landcodes = array (
					'+31',
					'+32',
					'+49'
					);
					
					foreach ($landcodes as $input) {
						if ($input == $landcode) {
							echo '<option value="'.$input.'" selected="selected">'.$input.'</option>';
						} else {
							echo '<option value="'.$input.'">'.$input.'</option>';
						}
						
							
					}
				?>
				</select>
				<input type="text" class="form-control" name="telefoon" maxlength="10" placeholder="Vul uw telefoonnummer in, inclusief netnummer indien van toepassing" value="<?= $telefoon;?>"/>
			</div>
				<br>
				
			<div class="form-group">
				<label> Email: </label>
				<input type="text" name="email" class="form-control" maxlength="255" placeholder="Vul uw e-mail adres in" value="<?= $email;?>" /> 				
			</div>
				
				
			<div class="form-inline">
				<label> Password: </label>
				<input type="password" name="password" class="form-control" maxlength="24" placeholder="Vul uw wachtwoord in" /> 
				&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
				<label> Password confirmatie: </label>
				<input type="password" name="password_confirm" class="form-control" maxlength="24" placeholder="Wachtwoord nogmaals	" /> 
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
				<input type="text" name="antwoordtekst" class="form-control" maxlength="255" placeholder="Vul het antwoord op uw beveiligingsvraag in"/> 
			</div>
						
			<div class="checkbox">
				<label><input type="checkbox" name="algemene_voorwaarden" value="akkoord">Ik ga akkoord met de <a href="ThuiswinkelVoorwaarden.pdf">algemene voorwaarden</a></label>
			</div>
				
				<button type="submit" name="register" class="btn btn-primary">Register</button><br><br>
		</form>
	</div>
</div>
<?php include 'includes/footer.php' ?>
</body>
</html>
