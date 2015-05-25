<div class="loginblok">
<?php
session_start();
if (!isset($_SESSION['loginnaam'])) {
?>
        <form class="form-horizontal" method="post" action="query_login.php">
        	<div class="col-sm-9">
		        <div class="form-group" id="name">	
					<input type="text" class="form-control" name="gebruikersnaam" placeholder="Gebruikersnaam">
				</div>
				<div class="form-group" id="password">
					<input type="password" class="form-control" name="password" placeholder="Wachtwoord">
				</div>
			</div>
			<div class="col-sm-3">
				<div class="form-group login-tekst" id="login-links">
					<a href="vergeten.php" class="login-tekst">Vergeten?</a>
					<a href="register.php" class="login-tekst">Registreren</a>
				</div>
				<div class="form-group" id="login-submit">
					<button type="submit" class="btn btn-success" name="sumbit">Log In</button>
				</div>
			</div>	
			
        </form>
<?php    
}
else {
	echo '
		Ingelogd als: <strong>'.$_SESSION['loginnaam'].'</strong><br>
		<a href="toevoegen-artikel.php">Veiling toevoegen</a><br>
		<a href="account.php">Mijn account</a><br>
		<a href="logout.php">Log uit</a>';
	}
?>
</div>
