<?php
session_start();
if (!isset($_SESSION['loginnaam'])) {
?>

        <form class="form-horizontal" method="post" action="query_login.php">
	        <div class="form-group col-xs-5 col-sm-12">	
				<input type="text" class="form-control" name="gebruikersnaam" placeholder="Gebruikersnaam">
			</div>
			<div class="form-group col-xs-5 col-sm-12">
				<input type="password" class="form-control" name="password" placeholder="Wachtwoord">
			</div>
			<div class="form-group col-xs-2 col-sm-4 col-sm-push-8">
				<button type="submit" class="btn btn-default" name="sumbit">Log In</button>
			</div>
			<div class="form-group login-tekst col-xs-12 col-sm-8 col-sm-pull-4">
				<a href="vergeten.php" class="login-tekst">Vergeten?</a>
				<a href="register.php" class="login-tekst">Registreren</a>
			</div>
			
        </form>


<?php    
}
else {
	echo '	Ingelogd als:<br><br><strong>'.$_SESSION['loginnaam'].'</strong><br>
			<a href="logout.php">Log uit</a>';
}
?>
