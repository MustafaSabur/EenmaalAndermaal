<?php
require 'connect.php';
?>		
		<!doctype html>
            <form action="query_register.php" method="post">
				
				<br> Gebruikersnaam:
				<input type="text" name="gebruikersnaam" placeholder="gebruikersnaam" />
                <br>
			
				<br> Naam:
                <input type="text" name="voornaam" placeholder="voornaam" /> 
				Achternaam:
				<input type="text" name="achternaam" placeholder="achternaam" />
                <br>
                
				<br> Adresregel 1:
                <input type="text" name="adresregel1" placeholder="Adres 1" /> Adresregel 2:
                <input type="text" name="adresregel2" placeholder="Adres 2" /> <br>
				
				<br> Postcode:
				<input type="text" name="postcode" placeholder="postcode" /> 
				<br>
				
				<br> Plaatsnaam:
				<input type="text" name="plaatsnaam" placeholder="plaatsnaam" />
				<br> 
				
				<br> Land:
				<input type="text" name="land" placeholder="land" />
				<br> 
				
				<br> Geboortedatum:
				<select name="dag">
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
				
				<select name="maand">
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
				
				<select name="jaar">
				<?php
				for ($i = 1900; $i < 2016; $i++) {
				  echo '<option value="'.$i.'">'.$i.'</option>';
				}
				?>
				</select>
				<br> 
				
				<br> Telefoon:
                <input type="text" name="telefoon" placeholder="telefoon" />
				<br>
				
				<br> Email:
                <input type="text" name="email" placeholder="email" /> 
				<br>				
				
				<br> Password:
                <input type="password" name="password" placeholder="password" /> 
                <br>
				
				<br> Vraag:
				<select name="vraag">
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
				
				 Antwoordtekst:
                <input type="text" name="antwoordtekst" placeholder="antwoordtekst" /> 
                <br>
				
				<br> Ik wil verkoper worden
				<input type="checkbox" name="is_verkoper" value="wel">
				<br><br>
				
                <input type="submit" name="register" value="Register">
            </form>