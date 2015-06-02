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
		echo '<nav id="nav">
					<ul class="nav nav-pills nav-stacked  main-menu">
						<li class="active"><a href="#">Account</a></li>
						<li><a href="verkoper_worden.php">Verkoper worden</a></li>
					</ul>
				</nav>';
}
else {
	while ($row = sqlsrv_fetch_array($result, SQLSRV_FETCH_ASSOC)) {
		if ($row['is_verkoper'] == 'wel' && $row['actief'] == 1) {
			echo '<nav id="nav">
						<ul class="nav nav-pills nav-stacked  main-menu">
							<li class="active"><a href="#">Account</a></li>
							<li><a href="mijnveilingen.php">Mijn veilingen</a></li>
							<li><a href="toevoegen-artikel.php">Veiling toevoegen</a></li>
						</ul>
					</nav>';
		}
	}
}
?>