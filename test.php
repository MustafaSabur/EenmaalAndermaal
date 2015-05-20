<?php
// $looptijd = 15;

// $vandaag = date("Y-m-d", time());
// echo $vandaag;
// echo '<br>';

// $tijdvandaag = date("H:i:s.u", time());
// echo $tijdvandaag;
// echo '<br>';

// $doeldag = date("Y-m-d", strtotime("+".$looptijd." days"));
// echo $doeldag;
// echo '<br>';

// $doeltijd = $tijdvandaag;
// echo $doeltijd;

require 'includes/connect.php';

	$sql_vandaag = "select convert(date, sysdatetime()) as date";
	$result = sqlsrv_query($conn, $sql_vandaag, null);
	while ($row = sqlsrv_fetch_array($result, SQLSRV_FETCH_ASSOC)) {
		$vandaag = $row['date'];
	}
var_dump ($vandaag);
echo $vandaag;
?>