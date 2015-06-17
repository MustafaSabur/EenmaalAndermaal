<div>
<?php
session_start();
if (!isset($_SESSION['loginnaam']) && !isset($loginVisibility)) {
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
				<div class="form-group login-btn" id="login-submit">
					<button type="submit" class="btn btn-success" name="sumbit">Log In</button>
				</div>
			</div>	
			
        </form>
<?php    
}
elseif (!isset($loginVisibility)){
?>	
	<div class="col-xs-5">
<?php
$session = $_SESSION['loginnaam'];
$conn = dbConnected();

$sql = "SELECT g.is_verkoper, v.actief
		FROM Gebruiker g inner join Verkoper v
		on g.gebruikersnaam = v.gebruiker
		WHERE GEBRUIKERSNAAM = '$session'";
$result = sqlsrv_query($conn, $sql, null);
$result1 = sqlsrv_query($conn, $sql, array(), array("Scrollable"=>"buffered"));
$rowCount = sqlsrv_num_rows($result1);


if ($rowCount == 0) {
		echo 	'<a href="verkoper_worden.php" class="btn btn-success btn-lg plaats-ad">Verkoper worden!</a>';
}
else {
	while ($row = sqlsrv_fetch_array($result, SQLSRV_FETCH_ASSOC)) 
	{
		if ($row['is_verkoper'] == 'wel' && $row['actief'] == 1) 
		{
			echo '<a href="toevoegen-artikel.php" class="btn btn-success btn-lg plaats-ad">Plaats Advertentie</a>';
		}
	}
}
?>
	</div>




</div>
	<div class="col-xs-7">
		<div class="btn-group account-dropdown">
		  <button type="button" class="btn btn-lg">Hi <?= $_SESSION['loginnaam'];?>! </button>
		  <button type="button" class="btn btn-lg dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
		    <span class="caret"></span>
		    <span class="sr-only">Toggle Dropdown</span>
		  </button>
		  <ul class="dropdown-menu" role="menu">
		    <li><a href="account.php">Mijn account</a></li>
		    <li><a href="mijnveilingen.php">Mijn veilingen</a></li>
		    <li class="divider"></li>
		    <li><a href="logout.php">Log uit</a></li>
		  </ul>
		</div>
	</div>
</div>

<?php } ?>
