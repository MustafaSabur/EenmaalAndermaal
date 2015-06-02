<!DOCTYPE html>
<html lang="nl">		
<head>
	<title>Registreren</title>
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.4/css/bootstrap.min.css">
	<link rel="stylesheet" href="css/custom.css">
</head>
<body>
<?php
	require 'includes/connect.php';
	require 'includes/functions.php';
	require 'includes/header.php';
?>
<div class="container-fluid">
	<div class="center-box">
<?php
$session = $_SESSION['loginnaam'];
$sql = "SELECT g.is_verkoper, v.actief
		FROM Gebruiker g inner join Verkoper v
		on g.gebruikersnaam = v.gebruiker
		WHERE GEBRUIKERSNAAM = '$session'";
$result = sqlsrv_query($conn, $sql, null);
$result1 = sqlsrv_query($conn, $sql, array(), array("Scrollable"=>"buffered"));
$rowCount = sqlsrv_num_rows($result1);

if ($rowCount == 0) {
	echo '<h1>Verkoper worden <small>Vul hier uw gegevens in.</small></h1>
					<form action="query_verkoper_worden.php" method="post">
						<div class="form-group">	
							<label> Identificatiemethode: </label>
							<select name="identificatiemethode" class="form-control">';
								
								$id_methoden = array (
								'Post',
								'Email',
								'SMS'
								);
								
								foreach ($id_methoden as $input) {	
										echo '<option value="'.$input.'">'.$input.'</option>';
								}
								
							echo '</select>
						</div>
							
						<button type="submit" name="verkoper_worden" class="btn btn-primary">Verkoper worden</button><br><br>
					</form>
				</div>
			</div>';
}
else {
	while ($row = sqlsrv_fetch_array($result, SQLSRV_FETCH_ASSOC)) {
		if ($row['actief'] == 0 && $row['is_verkoper'] == 'wel') {
			echo '<h3><small>U moet uw verkoopaccount nog activeren.</small></h3>';
			header("refresh:2;url=activate_verkoper.php");
			exit();
		}
		if ($row['actief'] == 1 && $row['is_verkoper'] == 'wel') {
			echo '<h3><small>U bent al verkoper.</small></h3>';
			header("refresh:2;url=account.php");
			exit();
		}
	}
}
?>
</div>
</div>
<?php
require 'includes/footer.php' 
?>

</body>
</html>
