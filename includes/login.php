<div class="loginblok">
<?php
session_start();
if (!isset($_SESSION['loginnaam'])) {
?>
        <form class="form-horizontal" method="post" action="query_login.php">
	        <div class="form-group col-xs-5 col-sm-9" id="name">	
				<input type="text" class="form-control" name="gebruikersnaam" placeholder="Gebruikersnaam">
			</div>
			<div class="form-group login-tekst col-xs-12 col-sm-3 " id="login-links">
				
				<a href="vergeten.php" class="login-tekst">Vergeten?</a>
				<a href="register.php" class="login-tekst">Registreren</a>
			</div>
			<div class="form-group col-xs-5 col-sm-9" id="password">
				<input type="password" class="form-control" name="password" placeholder="Wachtwoord">
			</div>
			<div class="form-group col-xs-2 col-sm-3" id="login-submit">
				<button type="submit" class="btn btn-success" name="sumbit">Log In</button>
			</div>
			
			
        </form>
<?php    
}
else {
	echo '
		<br>
		Ingelogd als: <strong>'.$_SESSION['loginnaam'].'</strong><br><br>
		<a href="toevoegen-artikel.php">Veiling toevoegen</a><br>
		<a href="account.php">Mijn account</a><br>
		<a href="logout.php">Log uit</a>';
	}
?>
</div>
