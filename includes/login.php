<?php
session_start();
if (!isset($_SESSION['loginnaam'])) {
	echo '<div class="form-group">
            <form method="post" action="query_login.php">
				<label> Gebruikersnaam </label>
					<input type="text" class="form-control" name="gebruikersnaam" value="" placeholder="Gebruikersnaam">
				<label> Password </label>				
					<input type="password" class="form-control" name="password" value="" placeholder="Password">
					<div class="login-tekst">
						<a href="vergeten.php" class="login-tekst">Vergeten?</a>
						<a href="register.php" class="login-tekst">Registreren</a>
						<input type="submit" name="sumbit" value="Login">
					</div>
            </form>
        </div>';
}
else {
	echo '	Ingelogd als:<br><br><strong>'.$_SESSION['loginnaam'].'</strong><br>
			<a href="logout.php">Log uit</a>';
}
?>
