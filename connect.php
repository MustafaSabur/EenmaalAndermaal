<?php
	$serverName = "(local)\sqlexpress";
	$connectionInfo = array("Database"=>"EenmaalAnderMaal", "UID"=>"sa", "PWD"=>"mekkelew");
	$conn = sqlsrv_connect( $serverName, $connectionInfo);
?>