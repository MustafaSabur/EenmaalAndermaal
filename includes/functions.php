<!-- alle functies-->
<?php

//globals
$rubrieklijst;
$root = -1;


require 'conn.php';



function printRubrieken($rubrieknummer = -1, $weergave = null){

    global $rubrieklijst;
    global $root;

    if (empty($rubrieklijst[$rubrieknummer])) {
        getSubrubrieken($rubrieknummer);
    }


    if ($weergave == 'options') {
        echo '<select name="Rubriek" id="zoekInRubriek'.$rubrieknummer.'" class="rub-select">';
        echo '<option value="'.$root.'">Kies rubriek</option>';
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
                //echo '<li id="rubrieknummer'.$k.'"><a href="index.php&#63;rub_nr='.$k.'">'. $v . '</a>';

                //  if (empty($rubrieklijst[$k])) {
                //     getSubrubrieken($k);
                // }

                //if (empty($rubrieklijst[$k])) {
                    echo '<li id="rubrieknummer'.$k.'"><a href="rubriek.php&#63;rub_nr='.$k.'">'. $v . '</a>';
                // }else {
                //     echo '<li id="rubrieknummer'.$k.'"><a href="index.php&#63;rub_nr='.$k.'">'. $v . '</a>';
                // }
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

function sqlPartAllSubRubrieken($rubrieknummer){
    global $rubrieklijst;
    global $root;

    if ($rubrieknummer == $root) {
        return null;
    }

    

    $allSubRubs = array();
    $allSubRubs[] = $rubrieknummer;


    if (empty($rubrieklijst[$rubrieknummer])) {
        getSubrubrieken($rubrieknummer);
    }
    if (!empty($rubrieklijst[$rubrieknummer])) {
        foreach ($rubrieklijst[$rubrieknummer] as $k => $v) {
            $allSubRubs[] = $k;
            getSubrubrieken($k);
            if (!empty($rubrieklijst[$k])){
                foreach ($rubrieklijst[$k] as $_k => $_v){
                    $allSubRubs[] = $_k;
                    getSubrubrieken($_k);
                    if (!empty($rubrieklijst[$_k])) {
                        foreach ($rubrieklijst[$_k] as $__k => $__v){
                            $allSubRubs[] = $__k;
                            getSubrubrieken($__k);
                            if (!empty($rubrieklijst[$__k])) {
                                foreach ($rubrieklijst[$__k] as $___k => $___v){
                                $allSubRubs[] = $___k;  
                                }

                            }
                        }
                    }
                }
            }
        }
    }

    $sql_part = "(".implode(',',$allSubRubs).')';

    return $sql_part;
}


function getNumOfSubrubrieken($rubrieknummer){
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

function testgetRubriekArtikelen($rubrieknummer, $page = 0, $nArtikelen = 10){
    $start = $page * $nArtikelen;
}


function getRubriekArtikelen($rubrieknummer, $page = 0, $nArtikelen = 10){

    global $root;
    $conn = dbConnected();
    $start = $page * $nArtikelen;
    
    

    if($conn){
        $sql = "SELECT v.*, g.voornaam, g.gebruikersnaam, g.achternaam, g.mailbox, t.telefoon
                FROM Voorwerp v INNER JOIN VoorwerpInRubriek vir ON v.voorwerpnummer = vir.voorwerp
                                INNER JOIN Gebruiker g ON g.gebruikersnaam = v.verkoper
                                LEFT JOIN Gebruikerstelefoon t ON g.gebruikersnaam = t.gebruiker ";
        $sql.= "WHERE   (v.looptijdeindeDag > GETDATE() 
                        OR  (v.looptijdbeginTijdstip < CONVERT(TIME,GETDATE()) AND v.looptijdeindeDag = GETDATE())
                        ) ";

        if ($rubrieknummer != $root) {
            $query_SubRub = sqlPartAllSubRubrieken($rubrieknummer);
            $sql.= "AND rubriek_op_laagste_niveau IN $query_SubRub ";
        }
        
        $sql.= "ORDER BY looptijdbeginDag, looptijdbeginTijdstip, looptijd
                OFFSET $start ROWS
                FETCH NEXT $nArtikelen ROWS ONLY";


        $result = sqlsrv_query( $conn, $sql, array(), array("Scrollable"=>"buffered"));
        if ( $result === false) { die( print_r( sqlsrv_errors() ) ); }
        $row_count = sqlsrv_num_rows($result); 
        //echo "<h1>".$row_count."</h1>";

        if ($row_count == 0) {
            echo '<div class="center-box"><h3>Sorry niets gevonden.</h3></div>';
        }else {
            while( $row = sqlsrv_fetch_array( $result, SQLSRV_FETCH_ASSOC)) {

                $voorwerpnummer = $row['voorwerpnummer'];

                $images = getArtikelImages($voorwerpnummer);
                $src_first_img = trim($images[0]);

                $d =  $row['looptijdeindeDag'];
                $t =  $row['looptijdbeginTijdstip'];
                $date = "'".$d->format('Y-m-d')." ".$t->format('h:m:s')."'";
                $biedingen = getArtikelBod($row['voorwerpnummer']);
                $titel = strip_tags($row['titel']);

                $beschrijving = $row['beschrijving'];

                $beschrijving = preg_replace("|<style\b[^>]*>(.*?)</style>|s", "", $beschrijving);
                $beschrijving = strip_tags($beschrijving);

                $beschrijving = trim($beschrijving);

                $prijs = $row['startprijs'];

                if ($biedingen[0]['bodbedrag'] != null) {
                    $prijs = $biedingen[0]['bodbedrag'];
                }

                
                
              echo '<section class="rub-artikel center-box">
                        <div class="col-xs-3 box-img">
                            <img src="'.$src_first_img.'" alt="'.$titel.'">
                        </div>
                        <div class="col-xs-9 box-text">
                            <h3>'.$titel.'</h3>
                            <p class="beschrijving"><strong>Beschrijving:</strong><br>'.$beschrijving.'<br>
                            <a href="artikel.php&#63;id='.$voorwerpnummer.'">Lees verder</a></p>
                            <div class="bottom-bar">    
                                <div class="col-xs-7">
                                    <h5 id="time'.$voorwerpnummer.'">
                                    </h5>
                                    <script>
                                        CountDownTimer('.$date.', '."'time".$voorwerpnummer."'".');
                                    </script>
                                    
                                </div>
                                <div class="col-xs-2">
                                    <h5>€ '.$prijs.'</h5>
                                </div>
                                <div class="col-xs-3 right">
                                    <a href="artikel.php&#63;id='.$voorwerpnummer.'" class="btn btn-success">Bied mee</a>
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

function getArtikelImages($voorwerpnummer){
    $conn = dbConnected();
    $img_paths = array();
    if($conn){
        $sql = "SELECT TOP 4 filenaam ";

        $sql.= "FROM Bestand b INNER JOIN Voorwerp v ON b.voorwerp = v.voorwerpnummer
                WHERE b.voorwerp = $voorwerpnummer
                ORDER BY filenaam";

        $result = sqlsrv_query($conn, $sql, null);

        if ( $result === false){die( print_r( sqlsrv_errors()));}

        while( $row = sqlsrv_fetch_array($result, SQLSRV_FETCH_ASSOC)) {
            //$img_paths[] = $row['filenaam'];
            $img_paths[] =  $row['filenaam'];
        }
        
        sqlsrv_free_stmt($result);
        dbClose($conn);
    }
    else{
        echo "Kan geen verbinding maken met de database.<br>";
        die( print_r( sqlsrv_errors(), true));
    }

    return $img_paths;
}


// maak breadcrumb navigatie aan
function getbreadcrumb($rubrieknummer = -1){
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
    global $root;
    $conn = dbConnected();
    if($conn){

        $sql = "SELECT TOP 10 titel 
                FROM Voorwerp v LEFT JOIN VoorwerpInRubriek vir ON v.voorwerpnummer = vir.voorwerp
                WHERE titel LIKE '%$zoekterm%' ";


        if ($inRubriek != $root) {
            $query_SubRub = sqlPartAllSubRubrieken($inRubriek);
            $sql.= "AND rubriek_op_laagste_niveau IN $query_SubRub ";
        }

                    
        $sql.= "ORDER BY titel";

        $result = sqlsrv_query($conn, $sql, null);

        if ( $result === false){die( print_r( sqlsrv_errors()));}

        while($row = sqlsrv_fetch_array($result, SQLSRV_FETCH_ASSOC)){
            // maak zoekterm vetgedrukt
            $v_titel = str_ireplace($zoekterm, '<b>'.$zoekterm.'</b>', $row['titel']);
            // voeg nieuwe gevonden resultaat
            echo '<li onclick="set_item(\''.str_replace("'", "\'", $row['titel']).'\')">'.$v_titel.'</li>';
            //echo $inRubriek;
        }

        sqlsrv_free_stmt($result);
        dbClose($conn); 
    }
    else{
        echo "Kan geen verbinding maken met de database.<br>";
        die( print_r( sqlsrv_errors(), true));
    }
}

function genRandomString($length = 15) {
    $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
    $charactersLength = strlen($characters);
    $randomString = '';
    for ($i = 0; $i < $length; $i++) {
        $randomString .= $characters[rand(0, $charactersLength - 1)];
    }
    return $randomString;
}


function fillProductPagina($voorwerpnummer){
    $conn = dbConnected();
    $inhoudPagina = array();

    if($conn){

        $sql = "SELECT vw.titel, vw.land, vw.beschrijving, vw.betalingsinstructie, vw.plaatsnaam, 
                vw.startprijs, vw.verzendinstructies, vw.verzendkosten, vk.gebruiker, vk.bank, vk.bankrekening,
                vk.creditcard, b.gebruiker, b.bodbedrag, b.bod_tijdstip, b.bod_dag,
                f.commentaar, f.dag, f.rating, f.soort_gebruiker, f.tijdstip, vw.voorwerpnummer
                from Voorwerp vw 
                    left outer join Verkoper vk 
                        on vw.verkoper = vk.gebruiker
                    left join bod b
                        on vw.voorwerpnummer = b.voorwerp
                    left outer join Feedback f
                        on vw.voorwerpnummer = f.voorwerp
                where vw.voorwerpnummer = $voorwerpnummer"; 

        $result = sqlsrv_query($conn, $sql, array(), array("Scrollable"=>"buffered"));
        if ( $result === false){die( print_r( sqlsrv_errors()));}

        if(sqlsrv_num_rows($result) == 0){

            sqlsrv_free_stmt($result);
            dbClose($conn);
            echo 'Artikel bestaat niet of is verlopen';
        }
        else {
            while( $row = sqlsrv_fetch_array($result, SQLSRV_FETCH_ASSOC)) {

                //$inhoudPagina['titel'] = $row['titel'];
                var_dump($row);
            }
        
            sqlsrv_free_stmt($result);
            dbClose($conn);

            foreach ($inhoudPagina as $key => $value) {
                echo $key." ".$value;
            }


        }
    }
}
?>
