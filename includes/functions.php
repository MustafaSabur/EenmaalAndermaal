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
function getRubrieken($hoofdrubriek){
	$rubrieklijst = array();

    $conn = dbConnected();
    if($conn){

    	if ($hoofdrubriek == 0) {
    		$sql = "SELECT * FROM Rubriek WHERE rubriek IS NULL";
    	}else {
    		$sql = "SELECT * FROM Rubriek WHERE rubriek = '$hoofdrubriek'";
    	}

        $result = sqlsrv_query( $conn, $sql, array(), array("Scrollable"=>"buffered"));

        if ( $result === false)
        {
            die( print_r( sqlsrv_errors() ) );
        }

        while( $row = sqlsrv_fetch_array( $result, SQLSRV_FETCH_ASSOC)) {
            $rubrieklijst[$row['rubrieknummer']] = $row['rubrieknaam'];
        }
     
        foreach ($rubrieklijst as $key => $value) {

            echo '<li id="rubrieknummmer'.$key.'" ';
            if (getnumrows($key) != 0) {
                echo 'class="dropdown-submenu"';
                //echo '<span class"badge">'.getnumrows($key).'</span';
            }
            echo '><a href="#">'. $value . '</a>';
            echo '<ul class="nav nav-tabs nav-stacked dropdown-menu">';
            getRubrieken($key);       
            echo '</ul>';
            echo '</li>';
        } 
        unset($rubrieklijst);        
        sqlsrv_free_stmt($result);
        dbClose($conn);
    }
    else{
        echo "Kan geen verbinding maken met de database .<br />";
        die( print_r( sqlsrv_errors(), true));
    }
}

function getnumrows($rubrieknummer){
    $conn = dbConnected();
    if($conn){
        $sql = "SELECT * FROM Rubriek WHERE rubriek = '$rubrieknummer'";
        $result = sqlsrv_query( $conn, $sql, array(), array("Scrollable"=>"buffered"));
        if ( $result === false) { die( print_r( sqlsrv_errors() ) ); }
        $row_count = sqlsrv_num_rows($result); 

        sqlsrv_free_stmt($result);
        dbClose($conn);

        return $row_count;
    }
    else{
        echo "Kan geen verbinding maken met de database .<br />";
        die( print_r( sqlsrv_errors(), true));
    }



}



?>