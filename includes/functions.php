<!-- alle functies-->
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

//retourneer array met rubrieken
function getRubriek($rubrieknummer){
	$rubrieklijst = array();

    $conn = dbConnected();
    if($conn){

    	if ($rubrieknummer == 0) {
    		$sql = "SELECT rubrieknaam FROM Rubriek WHERE rubriek IS NULL";
    	}else {
    		$sql = "SELECT rubrieknaam FROM Rubriek WHERE rubriek = '$rubrieknummer'";
    	}

        $result = sqlsrv_query( $conn, $sql, null);


        if ( $result === false)
        {
            die( print_r( sqlsrv_errors() ) );
        }
        while( $row = sqlsrv_fetch_array( $result, SQLSRV_FETCH_ASSOC)) {
            $rubrieklijst[] = $row['rubrieknaam'];

        }

        foreach ($rubrieklijst as $key => $value) {
        	echo '<a href="#">'. $value . '</a>';
        	
        }
        
        sqlsrv_free_stmt($result);
        dbClose($conn);
    }
    else{
        echo "Kan geen verbinding maken met de database .<br />";
        die( print_r( sqlsrv_errors(), true));
    }
}

?>