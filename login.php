<?php
session_start();
if (!isset($_SESSION['loginnaam'])) {
	echo '<div id="login">
            <div id="logintext">Login</div>
            <br>
            <form method="post" action="query_login.php">
                <p>
                    <input type="text" name="gebruikersnaam" value="" placeholder="Gebruikersnaam">
                </p>
                <br>
                <p>
                    <input type="password" name="password" value="" placeholder="Password">
                </p>
                <a href="vergeten.php" id="vergeten">Vergeten?</a>
                <a href="register.php" id="register">Registreren</a>
                <p id="submit">
                    <input type="submit" name="sumbit" value="Login">
                </p>
            </form>
        </div>';
}
else {
	echo '<div id="login">
            <div id="logintext">Login</div>
            <br><br>
            Ingelogd als:<br><br><strong>'.$_SESSION['loginnaam'].'</strong><br><br>
			<a href="logout.php">Log uit</a>
        </div>';
}
?>
