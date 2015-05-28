<?php

//connectie met de database
function dbConnected(){
	$serverName = "(local)\sqlexpress";
	$connectionInfo = array( "Database"=>"EenmaalAndermaal",  "UID"=>"sa", "PWD"=>"P@ssw0rd");
	$conn = sqlsrv_connect ($serverName, $connectionInfo);
	return $conn;
}

//verbreek connectie met de database
function dbClose($conn){
	sqlsrv_close($conn);
}



?>