<?php
$session = $_SESSION['loginnaam'];

$sql = "SELECT ACTIEF FROM VERKOPER WHERE gebruiker = '$session'";
$result = sqlsrv_query($conn, $sql, null);

while ($row = sqlsrv_fetch_array($result, SQLSRV_FETCH_ASSOC)) {
	if ($row['ACTIEF'] == 1) {
		echo '<nav id="nav">
					<ul class="nav nav-pills nav-stacked  main-menu">
						<li class="active"><a href="#">Account</a></li>
						<li><a href="mijnveilingen.php">Mijn veilingen</a></li>
						<li><a href="toevoegen-artikel.php">Veiling toevoegen</a></li>
					</ul>
				</nav>';
		}
		else {
			echo '<nav id="nav">
						<ul class="nav nav-pills nav-stacked  main-menu">
							<li class="active"><a href="#">Account</a></li>
							<li><a href="verkoper_worden.php">Verkoper worden</a></li>
						</ul>
					</nav>';
		}
}
?>