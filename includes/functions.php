<!-- alle functies-->
<?php

//globals
$rubrieklijst;
$root = -1;
// apc_store('rubrieklijst',$rubrieklijst,300);
// $tmp = apc_fetch('rubrieklijst'); 
// if (!empty(apc_fetch('rubrieklijst'))) {
//     $rubrieklijst = apc_fetch('rubrieklijst'); 
// }




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


function printRubrieken($rubrieknummer = -1, $weergave = null){

    global $rubrieklijst;
    global $root;

    if (empty($rubrieklijst[$rubrieknummer])) {
        getSubrubrieken($rubrieknummer);
    }


    if ($weergave == 'options') {
        echo '<select name="Rubriek" id="zoekInRubriek" class="rub-select">';
        echo '<option value="'.$root.'">Alle caterorieën</option>';
        foreach ($rubrieklijst[$rubrieknummer] as $k => $v) {
            echo '<option value="'.$k.'">'.$v.'</option>';
        }
        echo '</select>';
    }
    else{
        $rubriek = getRubriekRow($rubrieknummer);

        if (!empty($rubrieklijst[$rubrieknummer])) {
            if ($rubrieknummer == $root) {
                echo '<li class="active"><a href="rubriek.php&#63;rub_nr='.$rubriek['rubrieknummer'].'">Alle Caterorieën</a></li>';
            }else echo '<li class="active"><a>'.$rubriek['rubrieknaam'].'</a></li>';
            foreach ($rubrieklijst[$rubrieknummer] as $k => $v) {
<<<<<<< HEAD
                echo '<li id="rubrieknummer'.$k.'"><a href="index.php&#63;rub_nr='.$k.'">'. $v . '</a>';
        
=======
                 if (empty($rubrieklijst[$k])) {
                    getSubrubrieken($k);
                }

                if (empty($rubrieklijst[$k])) {
                    echo '<li id="rubrieknummer'.$k.'"><a href="rubriek.php&#63;rub_nr='.$k.'">'. $v . '</a>';
                }else {
                    echo '<li id="rubrieknummer'.$k.'"><a href="index.php&#63;rub_nr='.$k.'">'. $v . '</a>';
                }
                
>>>>>>> f0b0c977e3402a04316a2c02a4be14cfb2f191da
            }
        }else{
            
            echo '<li class="active"><a>'.$rubriek['rubrieknaam'].'</a></li>';
        }
    }
}


function getSubrubrieken($rubrieknummer){
    global $rubrieklijst;

    $conn = dbConnected();
    if($conn){

        $sql = "SELECT * 
                FROM Rubriek 
                WHERE rubriek = $rubrieknummer";

        $result = sqlsrv_query( $conn, $sql, array(), array("Scrollable"=>"buffered"));
        if ($result === false) die(print_r(sqlsrv_errors()));


        while( $row = sqlsrv_fetch_array( $result, SQLSRV_FETCH_ASSOC)) {
            $rubrieklijst[$rubrieknummer][$row['rubrieknummer']] = $row['rubrieknaam'];
        }
        
        sqlsrv_free_stmt($result);
        dbClose($conn);
    }
    else{
        echo "Kan geen verbinding maken met de database.<br>";
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
        echo "Kan geen verbinding maken met de database.<br>";
        die( print_r(sqlsrv_errors(), true));
    }

}

function getRubriekArtikelen($rubrieknummer, $nArtikelen = 10){
    $conn = dbConnected();
    if($conn){
        $sql = "SELECT v.*, g.voornaam, g.gebruikersnaam, g.achternaam, g.mailbox, t.telefoon
                FROM Voorwerp v INNER JOIN VoorwerpInRubriek vir ON v.voorwerpnummer = vir.voorwerp
                INNER JOIN Gebruiker g ON g.gebruikersnaam = v.verkoper
                LEFT JOIN Gebruikerstelefoon t ON g.gebruikersnaam = t.gebruiker
                WHERE rubriek_op_laagste_niveau = $rubrieknummer
                                    AND (v.looptijdeindeDag > GETDATE() 
                                    AND v.looptijdbeginTijdstip > CONVERT(TIME,GETDATE()))
                ORDER BY looptijdbeginDag, looptijdbeginTijdstip, looptijd";


        $result = sqlsrv_query( $conn, $sql, array(), array("Scrollable"=>"buffered"));
        if ( $result === false) { die( print_r( sqlsrv_errors() ) ); }
        $row_count = sqlsrv_num_rows($result); 
        //echo "<h1>".$row_count."</h1>";

        if ($row_count == 0) {
            echo '<div class="center-box"><h3>Sorry niets gevonden.</h3></div>';
        }else {
            while( $row = sqlsrv_fetch_array( $result, SQLSRV_FETCH_ASSOC)) {
                $d = $row['looptijdeindeDag'];
                $t =  $row['looptijdbeginTijdstip'];
                $date = "'".$d->format('Y-m-d')." ".$t->format('h:m:s')."'";
                $biedingen = getArtikelBod($row['voorwerpnummer']);
                $prijs = $row['startprijs'];
                if ($biedingen[0]['bodbedrag'] != null) {
                    $prijs = $biedingen[0]['bodbedrag'];
                }

                $voorwerpID = "'time".$row['voorwerpnummer']."'";
                
              echo '<section class="rub-artikel center-box">
                        <div class="col-xs-3 box-img">
                            <img src="upload/'.$row['gebruikersnaam'].'/'.$row['voorwerpnummer'].'-01.jpg" alt="'.$row['titel'].'">
                        </div>
                        <div class="col-xs-9 box-text">
                            <h3>'.$row['titel'].'</h3>
                            <p class="beschrijving"><strong>Beschrijving:</strong><br>'.$row['beschrijving'].'<br>
                            <a href="artikel.php&#63;id='.$row['voorwerpnummer'].'">Lees verder</a></p>
                            <div class="bottom-bar">    
                                <div class="col-xs-7">
                                    <h5 id="time'.$row['voorwerpnummer'].'">
                                    </h5>
                                    <script>
                                        CountDownTimer('.$date.', '.$voorwerpID.');
                                    </script>
                                    
                                </div>
                                <div class="col-xs-2">
                                    <h5>€ '.$prijs.'</h5>
                                </div>
                                <div class="col-xs-3 right">
                                    <a href="artikel.php&#63;id='.$row['voorwerpnummer'].'" class="btn btn-success">Bied mee</a>
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
        echo "Kan geen verbinding maken met de database.<br>";
        die( print_r( sqlsrv_errors(), true));
    }
}


<<<<<<< HEAD
function getbreadcrumb($rubrieknummer){
=======
function getbreadcrumb($rubrieknummer = -1){
>>>>>>> f0b0c977e3402a04316a2c02a4be14cfb2f191da
    global $root;
    $data = getRubriekRow($rubrieknummer);
    $active = $data['rubrieknaam'];
    $list = array();

    echo '<ol class="breadcrumb">
                  <li><a href="index.php">Home</a></li>';

    while ( ($data['inRubriek'] != $root) AND ($rubrieknummer != $root)) {
        $data = getRubriekRow($data['inRubriek']);
         $list[] = $data;
    }

    if ($rubrieknummer != $root) {
        echo '<li><a href="rubriek.php&#63;rub_nr='.$root.'">Alle Caterorieën</a></li>';
    }

    foreach (array_reverse($list) as $l) {
        echo '<li><a href="rubriek.php&#63;rub_nr='.$l['rubrieknummer'].'">'.$l['rubrieknaam'].'</a></li>';
    }

    if ($rubrieknummer != $root) {
        echo '<li class="active">'.$active.'</li>';
    }
    else echo '<li class="active">Alle Caterorieën</li>';

    echo '</ol>';
    
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

        
        sqlsrv_free_stmt($result);
        dbClose($conn);
    }
    else{
        echo "Kan geen verbinding maken met de database.<br>";
        die( print_r( sqlsrv_errors(), true));
    }
    return $rubriek;

}

function getArtikelBod($voorwerpnummer){
    $conn = dbConnected();
    $biedingen = array();
    if($conn){

        $sql = "SELECT TOP 10 b.voorwerp, b.gebruiker, b.bod_dag, b.bod_tijdstip, b.bodbedrag
                FROM Voorwerp v LEFT JOIN bod b ON b.voorwerp = v.voorwerpnummer 
                WHERE v.voorwerpnummer = $voorwerpnummer ORDER BY b.bodbedrag DESC"; 
        
        $result = sqlsrv_query($conn, $sql, array(), array("Scrollable"=>"buffered"));

        if ( $result === false){die( print_r( sqlsrv_errors()));}

        if(sqlsrv_num_rows($result) == 0){

            sqlsrv_free_stmt($result);
            dbClose($conn);
            return null;
        }else {
            while( $row = sqlsrv_fetch_array($result, SQLSRV_FETCH_ASSOC)) {

                $biedingen[] = $row;
            }
            sqlsrv_free_stmt($result);
            dbClose($conn);
            
        }
    }
    else{
        echo "Kan geen verbinding maken met de database.<br>";
        die( print_r( sqlsrv_errors(), true));
    }
    return $biedingen;
}


if (isset($_POST['zoekterm'])) {
    getZoekSuggesties($_POST['zoekterm'], $_POST['inRubriek']);
}

function getZoekSuggesties($zoekterm, $inRubriek){
    $conn = dbConnected();
    if($conn){

        $sql = "SELECT TOP 10 titel 
                FROM Voorwerp v LEFT JOIN VoorwerpInRubriek vir ON v.voorwerpnummer = vir.voorwerp

                WHERE titel LIKE '%$zoekterm%' AND rubriek_op_laagste_niveau = '$inRubriek'
                    
                ORDER BY titel";

        $result = sqlsrv_query($conn, $sql, null);

        if ( $result === false){die( print_r( sqlsrv_errors()));}

        while($row = sqlsrv_fetch_array($result, SQLSRV_FETCH_ASSOC)){
            // maak zoekterm vetgedrukt
            $v_titel = str_ireplace($zoekterm, '<b>'.$zoekterm.'</b>', $row['titel']);
            // voeg nieuwe gevonden resultaat
            echo '<li onclick="set_item(\''.str_replace("'", "\'", $row['titel']).'\')">'.$v_titel.'</li>';
            echo $inRubriek;
        }

        sqlsrv_free_stmt($result);
        dbClose($conn); 
    }
    else{
        echo "Kan geen verbinding maken met de database.<br>";
        die( print_r( sqlsrv_errors(), true));
    }
}








// apc_store('rubrieklijst',$rubrieklijst,300);


?>

























