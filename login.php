<?php
session_start();
if (!isset($_SESSION['loginnaam'])) {
	echo '<div class="form-group">
            <form method="post" action="query_login.php">
				<label> Gebruikersnaam </label>
					<input type="text" class="form-control" name="gebruikersnaam" value="" placeholder="Gebruikersnaam">
				<label> Password </label>				
					<input type="password" class="form-control" name="password" value="" placeholder="Password">
						<a href="vergeten.php" id="vergeten">Vergeten?</a>
						<a href="register.php" id="register">Registreren</a>
                    <input type="submit" name="sumbit" value="Login">
            </form>
        </div>';
}
else {
	echo '	Ingelogd als:<br><br><strong>'.$_SESSION['loginnaam'].'</strong><br>
			<a href="logout.php">Log uit</a>';
}
?>
