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
            echo '><a href="rubriek.php&#63;rub_nr='.$key.'">'. $value . '</a>';
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
        die( print_r(sqlsrv_errors(), true));
    }

}

function getRubriekArtikelen($rubrieknummer, $nArtikelen = 10){
    $conn = dbConnected();
    if($conn){
        $sql = "SELECT TOP $nArtikelen v.*, g.voornaam, g.achternaam, g.mailbox, t.telefoon
                FROM Voorwerp v INNER JOIN VoorwerpInRubriek vir ON v.voorwerpnummer = vir.voorwerp
                INNER JOIN Gebruiker g ON g.gebruikersnaam = v.verkoper
                INNER JOIN Gebruikerstelefoon t ON g.gebruikersnaam = t.gebruiker
                WHERE rubriek_op_laagste_niveau = $rubrieknummer AND v.veilingGesloten = 'niet'
                ORDER BY looptijdbeginDag, looptijdbeginTijdstip, looptijd";


        $result = sqlsrv_query( $conn, $sql, array(), array("Scrollable"=>"buffered"));
        if ( $result === false) { die( print_r( sqlsrv_errors() ) ); }
        $row_count = sqlsrv_num_rows($result); 
        //echo "<h1>".$row_count."</h1>";

        if ($row_count == 0) {
            echo '<div class="center-box"><h3>Sorry niets gevonden.</h3></div>';
        }else {
            while( $row = sqlsrv_fetch_array( $result, SQLSRV_FETCH_ASSOC)) {
              echo '<section class="rub-artikel center-box">
                        <div class="col-xs-3 box-img">
                            <img src="images/artikelen/product1-01.jpg" alt="'.$row['titel'].'">
                        </div>
                        <div class="col-xs-9 box-text">
                            <h3>'.$row['titel'].'</h3>
                            <p class="beschrijving"><strong>Beschrijving:</strong><br>'.$row['beschrijving'].'
                            <a href="#">Lees verder</a></p>
                            <div class="bottom-bar">    
                                <div class="col-xs-7">
                                    <h5>22uur 22min 50sec</h5>
                                </div>
                                <div class="col-xs-2">
                                    <h5>€ '.$row['startprijs'].'</h5>
                                </div>
                                <div class="col-xs-3 right">
                                    <a href="#" class="btn btn-success">Bied mee</a>
                                </div>
                            </div>
                        </div>
                    </section>';
            }
        }




        sqlsrv_free_stmt($result);
        dbClose($conn);

        return $row_count;
    }
    else{
        echo "Kan geen verbinding maken met de database .<br />";
        die( print_r( sqlsrv_errors(), true));
    }
}


function getbreadcrumb($rubrieknummer){
    $data = getRubriekRow($rubrieknummer);

    if ($data['inRubriek'] != null) {
        $_data = getRubriekRow($data['inRubriek']);
        if ($_data['inRubriek'] != null) {
            $__data = getRubriekRow($_data['inRubriek']);
            echo '<li><a href="rubriek.php&#63;rub_nr='.$__data['rubrieknummer'].'">'.$__data['rubrieknaam'].'</a></li>';
        }
        echo '<li><a href="rubriek.php&#63;rub_nr='.$_data['rubrieknummer'].'">'.$_data['rubrieknaam'].'</a></li>';
    }
    echo '<li class="active">'.$data['rubrieknaam'].'</li>';
}

function getRubriekRow($rubrieknummer){
    $conn = dbConnected();
    $rubriek = array();
    if($conn){
        $sql = "SELECT * FROM Rubriek WHERE rubrieknummer = $rubrieknummer";

        $result = sqlsrv_query($conn, $sql, null);

        if ( $result === false){die( print_r( sqlsrv_errors()));}

        while( $row = sqlsrv_fetch_array($result, SQLSRV_FETCH_ASSOC)) {
            $rubriek['rubrieknummer'] = $row['rubrieknummer'];
            $rubriek['rubrieknaam'] = $row['rubrieknaam'];
            $rubriek['inRubriek'] = $row['rubriek'];
        }

        return $rubriek;

        unset($rubriek);
        sqlsrv_free_stmt($result);
        dbClose($conn);
    }
    else{
        echo "Kan geen verbinding maken met de database .<br />";
        die( print_r( sqlsrv_errors(), true));
    }

}










































?>