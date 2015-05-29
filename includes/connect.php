<?php
	$serverName = "(local)\sqlexpress";
	$connectionInfo = array("Database"=>"EenmaalAnderMaal", "UID"=>"sa", "PWD"=>"P@ssw0rd");
	$conn = sqlsrv_connect( $serverName, $connectionInfo);

?>