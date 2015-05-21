<?php
	$serverName = "(local)\sqlexpress";
	$connectionInfo = array("Database"=>"EenmaalAnderMaal", "UID"=>"sa", "PWD"=>"");
	$conn = sqlsrv_connect( $serverName, $connectionInfo);
?>