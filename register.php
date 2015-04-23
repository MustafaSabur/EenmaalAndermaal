<?php
require 'connect.php';
?>		
		<!doctype html>
		
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.4/css/bootstrap.min.css">
		
		<div class="col-xs-6">
            <form action="query_register.php" method="post">
			<div class="form-group">
				<label> Gebruikersnaam: </label>
				<input type="text" class="form-control" name="gebruikersnaam" placeholder="gebruikersnaam" />
			</div>
			
			<div class="form-group">
				<label> Naam: </label>
                <input type="text" class="form-control" name="voornaam" placeholder="voornaam" /> 
			</div>	
			
			<div class="form-group">			
				<label> Achternaam: </label>
				<input type="text" class="form-control" name="achternaam" placeholder="achternaam" />
            </div>
			
             <div class="form-group">   
				<label> Adresregel 1: </label>
                <input type="text" class="form-control" name="adresregel1" placeholder="Adres 1" /> 
			</div>
			
			<div class="form-group">
				<label> Adresregel 2: </label>
                <input type="text" class="form-control" name="adresregel2" placeholder="Adres 2" />
			</div>
			
			<div class="form-group">
				<label> Postcode: </label>
				<input type="text" class="form-control" name="postcode" placeholder="postcode" /> 
			</div>
			
			<div class="form-group">	
				<label> Plaatsnaam: </label>
				<input type="text" class="form-control" name="plaatsnaam" placeholder="plaatsnaam" />
			</div>	
				
			<div class="form-group">	
				<label> Land: </label>
				<input type="text" class="form-control" name="land" placeholder="land" />
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
				
				<div class="form-group">
				<label> Telefoon: </label>
                <input type="text" class="form-control" name="telefoon" placeholder="telefoon" />
				</div>
				
				<div class="form-group">
				<label> Email: </label>
                <input type="text" name="email" class="form-control" placeholder="email" /> 				
				</div>
				
				<div class="form-group">
				<label> Password: </label>
                <input type="password" name="password" class="form-control" placeholder="password" /> 
				</div>
				
				<div class="form-group">
				<label> Vraag: </label>
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
                <input type="text" name="antwoordtekst" class="form-control" placeholder="antwoordtekst" /> 
				</div>
				
				<div class="checkbox">
				<label><input type="checkbox" name="is_verkoper" value="wel">Ik wil verkoper worden</label>
				</div>
				
                <button type="submit" name="register" class="btn btn-default">Register</button>
            </form>
			</div>