<!-- alle functies-->
<?php

//connection
require 'conn.php';


//globals
$root = -1;
$rubrieklijst = array();

$counterIds = array();
$dates = array();
$nArtikelenPerRij = 15;
$current_page =  basename($_SERVER['PHP_SELF']);


function printRubrieken($rubrieknummer = -1, $weergave = null){

    global $rubrieklijst;
    global $root;

    if (empty($rubrieklijst[$rubrieknummer])) {
        getSubrubrieken($rubrieknummer);
    }


    if ($weergave == 'options') {
        echo '<select name="rub_nr" id="zoekInRubriek" class="rub-select">';
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
                echo '<li id="rubrieknummer'.$k.'"><a href="rubriek.php&#63;rub_nr='.$k.'">'. $v . '</a>';

            }
        }else{
            echo '<li class="active"><a href="rubriek.php&#63;rub_nr='.$rubriek['rubrieknummer'].'">Alle Caterorieën</a></li>';
            foreach ($rubrieklijst[$root] as $k => $v) {
                echo '<li id="rubrieknummer'.$k.'"><a href="rubriek.php&#63;rub_nr='.$k.'">'. $v . '</a>';
            }
        }
    }
}


function getSubrubrieken($rubrieknummer){
    global $rubrieklijst;

    $conn = dbConnected();

    if($conn){

        $sql = "SELECT rubrieknummer, rubrieknaam 
                FROM Rubriek 
                WHERE rubriek = $rubrieknummer";

        $result = sqlsrv_query( $conn, $sql, null);
        if ($result === false) die(print_r(sqlsrv_errors()));


        while( $row = sqlsrv_fetch_array( $result, SQLSRV_FETCH_ASSOC)) {
            $rubrieklijst[$rubrieknummer][$row['rubrieknummer']] = $row['rubrieknaam'];
        }
        
        sqlsrv_free_stmt($result);
    }
    else{
        echo "Kan geen verbinding maken met de database.<br>";
        die( print_r( sqlsrv_errors(), true));
    }
}

function getAllSubRubrieken($rubrieknummer, $sort = false){
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

    if($sort)sort($allSubRubs);
    return $allSubRubs;
}

function getArtikelen($sort_by, $nArtikelen, $rubriek = null){
    $conn = dbConnected();
    if($conn){
        $artikelen = array();

            $sql = "SELECT TOP $nArtikelen voorwerpnummer, titel, startprijs, looptijdeindeDag, looptijdbeginTijdstip, rubriek_op_laagste_niveau, r.rubrieknaam
                    FROM Voorwerp v INNER JOIN VoorwerpInRubriek vir ON v.voorwerpnummer = vir.voorwerp 
                                    INNER JOIN Rubriek r ON vir.rubriek_op_laagste_niveau = r.rubrieknummer ";

        if ($sort_by == 'l-minute') {
            $sql.= "WHERE looptijdeindedag > CONVERT(DATE, GETDATE()) OR (looptijdeindedag = CONVERT(DATE, GETDATE()) AND looptijdbegintijdstip > CONVERT(TIME, GETDATE()))
                    ORDER BY looptijdeindeDag, looptijdbeginTijdstip";
        }
        elseif ($sort_by == 'populair') {
            $sql.=                  "LEFT JOIN ( SELECT voorwerp, COUNT(Voorwerp) AS Aantal_biedingen FROM Bod GROUP BY voorwerp) b ON b.voorwerp = v.voorwerpnummer
                    WHERE looptijdeindedag > CONVERT(DATE, GETDATE()) OR (looptijdeindedag = CONVERT(DATE, GETDATE()) AND looptijdbegintijdstip > CONVERT(TIME, GETDATE()))
                    ORDER BY Aantal_biedingen DESC";
        }
        elseif ($sort_by == 'recent') {
            $sql.= "WHERE looptijdeindedag > CONVERT(DATE, GETDATE()) OR (looptijdeindedag = CONVERT(DATE, GETDATE()) AND looptijdbegintijdstip > CONVERT(TIME, GETDATE()))
                    ORDER BY looptijdbeginDag DESC, looptijdbeginTijdstip";       
        }elseif ($sort_by == 'vergelijkbaar') {
            $sql.= "WHERE (looptijdeindedag > CONVERT(DATE, GETDATE()) OR (looptijdeindedag = CONVERT(DATE, GETDATE()) AND looptijdbegintijdstip > CONVERT(TIME, GETDATE())))
                    AND rubriek_op_laagste_niveau = $rubriek
                    ORDER BY NEWID()";
            
        }
        
        $result = sqlsrv_query($conn, $sql, null);

        if ($result === false){die( print_r( sqlsrv_errors()));}

        while( $row = sqlsrv_fetch_array($result, SQLSRV_FETCH_ASSOC)) {

            $titel = filter($row['titel']);


            $biedingen = getArtikelBod($row['voorwerpnummer']);

            if (!empty($biedingen) && $biedingen[0]['bodbedrag'] > $row['startprijs']) { 
                $row['prijs'] = $biedingen[0]['bodbedrag'];
            }else $row['prijs'] = $row['startprijs'];

            
            $artikelen[] = $row;
        }

        sqlsrv_free_stmt($result);
        dbClose($conn);
        return $artikelen;
    }
    else{
        echo "Kan geen verbinding maken met de database.<br>";
        die( print_r( sqlsrv_errors(), true));
    }
}


function printProductRow($sort_by, $nArtikelen = 15, $rubriek = null){
    global $counterIds;
    global $counterDates;
    $row_titel = $sort_by;
    $kleur = '';
    $artikelen = ($sort_by == 'vergelijkbaar') ? getArtikelen($sort_by, $nArtikelen, $rubriek) : getArtikelen($sort_by, $nArtikelen) ; 

    if ($sort_by == 'l-minute') {
        $row_titel = 'Last-Minutes';
        $kleur = '_orange';

    }elseif ($sort_by == 'populair') {
        $row_titel = 'Populair';
        $kleur = '_red';
    }elseif ($sort_by == 'recent') {
        $row_titel = 'Recent';
        $kleur = '_purple';
    }elseif ($sort_by == 'vergelijkbaar') {
        $row_titel = 'Vergelijkbare Artikelen';
    }

    echo '<div class="product-box '.$sort_by.'">';
    echo    '<h1>'.$row_titel.'</h1>';
    echo    '<div class="product-row" id="'.$sort_by.'">';

    foreach ($artikelen as $k => $v) {
        $nr =  $v['voorwerpnummer'];
        $rub_nr = $v['rubriek_op_laagste_niveau'];
        $rub_naam = $v['rubrieknaam'];
        $titel = $v['titel'];
        $prijs = $v['prijs'];
        $countID = "counter".$sort_by.$nr;
        $counterIds[] = $countID;

        $img_path = getArtikelImages($nr)[0];

        $d =  $v['looptijdeindeDag'];
        $t =  $v['looptijdbeginTijdstip'];
        $date = $d->format('Y m d')." ".$t->format('H:i:s');
        $counterDates[] = $date;

        echo    '<a href="artikel.php&#63;id='.$nr.'" class="product">
                    <div class="product-img">
                        <img src="http://iproject27.icasites.nl/'.$img_path.'" alt="'.$titel.'">
                    </div>
                    <h5 title="'.$titel.'">'.$titel.'</h5>
                    <h5>'.$rub_naam.'</h5>
                    <h4>&euro; '.$prijs.'</h4>
                    <p class="time" id="'.$countID.'"></p>
                </a>';

        //echo '<script> CountDownTimer('."'".$date."'".', '."'".$countID."'".') </script> ';


    }

    $sort_by = "'".$sort_by."'";          

    echo   '</div>
            <div class="arrow-left" onclick="scrollL('.$sort_by.')">
                <img src="images/r_arrow'.$kleur.'.png" alt="leftarrow">
                <img src="images/r_arrow_trans.png" alt="leftarrow">
                
            </div>
            <div class="arrow-right" onclick="scrollR('.$sort_by.')">
                <img src="images/r_arrow'.$kleur.'.png" alt="rightarrow">
                <img src="images/r_arrow_trans.png" alt="rightarrow">
            </div>
        </div>';



}


function getRubriekArtikelen($rubrieknummer, $page = 1, $nArtikelen = 8){

    global $root;
    $conn = dbConnected();
    $start = ($page -1) * $nArtikelen;

    if($conn){
        $sql = "SELECT v.*
                FROM Voorwerp v INNER JOIN VoorwerpInRubriek vir ON v.voorwerpnummer = vir.voorwerp ";
        $sql.= "WHERE (looptijdeindedag > CONVERT(DATE, GETDATE()) OR (looptijdeindedag = CONVERT(DATE, GETDATE()) AND looptijdbegintijdstip > CONVERT(TIME, GETDATE()))) ";

        if ($rubrieknummer != $root) {
            $allSubRubs = getAllSubRubrieken($rubrieknummer);
            $query_SubRub = "(".implode(',',$allSubRubs).")";
            $sql.= "AND rubriek_op_laagste_niveau IN $query_SubRub ";
        }
        
        $sql.= "ORDER BY looptijdeindeDag, looptijdbeginTijdstip
                OFFSET $start ROWS
                FETCH NEXT $nArtikelen ROWS ONLY";


        $result = sqlsrv_query( $conn, $sql, array(), array("Scrollable"=>"buffered"));
        if ( $result === false) { die( print_r( sqlsrv_errors() ) ); }

        $row_count = sqlsrv_num_rows($result); 
        if ($row_count == 0) {
            echo '<div class="center-box"><h3>Geen resultaten gevonden.</h3></div>';
        }else {
            while( $row = sqlsrv_fetch_array( $result, SQLSRV_FETCH_ASSOC)) {

                $voorwerpnummer = $row['voorwerpnummer'];

                $images = getArtikelImages($voorwerpnummer, 'thumbnail');
                $src_first_img = trim($images[0]);

                $d =  $row['looptijdeindeDag'];
                $t =  $row['looptijdbeginTijdstip'];
                $date = "'".$d->format('Y m d')." ".$t->format('H:i:s')."'";
                $biedingen = getArtikelBod($row['voorwerpnummer']);
                $titel = filter($row['titel']);
                $beschrijving = filter($row['beschrijving']);
                $prijs = $row['startprijs'];

                if ($biedingen[0]['bodbedrag'] != null) {
                    $prijs = $biedingen[0]['bodbedrag'];
                } 
                
                  echo '<section class="rub-artikel">
                            <div class="col-xs-3 box-img">
                                <a href="artikel.php&#63;id='.$voorwerpnummer.'">
                                    <img src="http://iproject27.icasites.nl/'.$src_first_img.'" alt="'.$titel.'">
                                </a>
                            </div>
                            <div class="col-xs-9 box-text">
                                <h3><a href="artikel.php&#63;id='.$voorwerpnummer.'">'.$titel.'</a></h3>
                                <p class="beschrijving"><strong>Beschrijving:</strong><br>'.$beschrijving.'<br>
                                <a href="artikel.php&#63;id='.$voorwerpnummer.'">Lees verder</a></p>
                                <div class="bottom-bar">    
                                    <div class="col-xs-6">
                                        <h5 id="time'.$voorwerpnummer.'">
                                        </h5>
                                        <script>
                                            CountDownTimer('.$date.', '."'time".$voorwerpnummer."'".');
                                        </script>
                                        
                                    </div>
                                    <div class="col-xs-3">
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


function getZoekResultaten($zoekterm, $rubrieknummer, $page, $nArtikelen = 10){

    $conn = dbConnected();
    if($conn){
        global $root;
        $zoekResultaten;
        $start = ($page -1) * $nArtikelen;

        $aantalArtikelen = 0;
        if ($rubrieknummer == null) $rubrieknummer = $root;
        
        $sql = "SELECT voorwerpnummer, titel, beschrijving, looptijdeindeDag, looptijdbeginTijdstip, startprijs, rubriek_op_laagste_niveau, rubrieknaam
                FROM Voorwerp v INNER JOIN VoorwerpInRubriek vir ON v.voorwerpnummer = vir.voorwerp 
                                INNER JOIN Rubriek r ON  vir.rubriek_op_laagste_niveau = r.rubrieknummer ";
        $sql.= "WHERE titel LIKE '%$zoekterm%'
                AND (looptijdeindedag > CONVERT(DATE, GETDATE()) OR (looptijdeindedag = CONVERT(DATE, GETDATE()) AND looptijdbegintijdstip > CONVERT(TIME, GETDATE()))) ";

        if ($rubrieknummer != $root) {
            $allSubRubs = getAllSubRubrieken($rubrieknummer);
            $query_SubRub = "(".implode(',',$allSubRubs).")";
            $sql.= "AND rubriek_op_laagste_niveau IN $query_SubRub ";
        }
        $sql.= "ORDER BY looptijdeindeDag, looptijdbeginTijdstip
                OFFSET $start ROWS
                FETCH NEXT $nArtikelen ROWS ONLY";
        
        $result = sqlsrv_query( $conn, $sql, array(), array("Scrollable"=>"buffered"));
        if ( $result === false) { die( print_r( sqlsrv_errors() ) ); }

        $row_count = sqlsrv_num_rows($result); 

        if ($row_count == 0) {
            return null;
        }

        while( $row = sqlsrv_fetch_array($result, SQLSRV_FETCH_ASSOC)) {
            $biedingen = getArtikelBod($row['voorwerpnummer']);

            if (!empty($biedingen) && $biedingen[0]['bodbedrag'] > $row['startprijs']) { 
                $row['prijs'] = $biedingen[0]['bodbedrag'];
            }else $row['prijs'] = $row['startprijs'];

            $titel = filter($row['titel']);
            $row['titel'] = $titel;

            $beschrijving = filter($row['beschrijving']);
            $row['beschrijving'] = trim($beschrijving);

            $zoekResultaten[] = $row;
        }
        
        sqlsrv_free_stmt($result);
        dbClose($conn);
        return $zoekResultaten;
    }
    else{
        echo "Kan geen verbinding maken met de database.<br>";
        die( print_r( sqlsrv_errors(), true));
    }    
}

function printZoekResultaten($zoekterm, $rubrieknummer, $page = 1){
    $zoekResultaten = getZoekResultaten($zoekterm, $rubrieknummer, $page);

    if (empty($zoekResultaten)) echo '<div class="center-box"><h3>Geen resultaten gevonden.</h3></div>';
    else{
        foreach ($zoekResultaten as $k => $v) {
        $nr =  $v['voorwerpnummer'];
        $beschrijving = $v['beschrijving'];
        $rub_nr = $v['rubriek_op_laagste_niveau'];
        $rub_naam = $v['rubrieknaam'];
        $titel = $v['titel'];
        $prijs = $v['prijs'];
        $countID = "counter".$nr;
        $img_path = getArtikelImages($nr)[0];

        $d =  $v['looptijdeindeDag'];
        $t =  $v['looptijdbeginTijdstip'];
        $date = $d->format('Y m d')." ".$t->format('H:i:s');

      echo '<section class="rub-artikel">
                <div class="col-xs-3 box-img">
                    <a href="artikel.php&#63;id='.$nr.'">
                        <img src="http://iproject27.icasites.nl/'.$img_path.'" alt="'.$titel.'">
                    </a>
                </div>
                <div class="col-xs-9 box-text">
                    <h3><a href="artikel.php&#63;id='.$nr.'">'.$titel.'</a></h3>
                    <p class="beschrijving"><strong>Beschrijving:</strong><br>'.$beschrijving.'<br>
                    <a href="artikel.php&#63;id='.$nr.'">Lees verder</a></p>
                    <div class="bottom-bar">    
                        <div class="col-xs-6">
                            <h5 id="'.$countID.'"></h5>    
                        </div>
                        <div class="col-xs-3">
                            <h5>€ '.$prijs.'</h5>
                        </div>
                        <div class="col-xs-3 right">
                            <a href="artikel.php&#63;id='.$nr.'" class="btn btn-success">Bied mee</a>
                        </div>
                    </div>
                </div>
            </section>';

        echo '<script> CountDownTimer('."'".$date."'".', '."'".$countID."'".') </script> ';
   
        }
    }
}


function getAantalArtikelenIn($rubrieknummer = null, $roundup = null){

    $conn = dbConnected();
    
    if($conn){
        global $root;
        $aantalArtikelen = 0;
        if ($rubrieknummer == null) $rubrieknummer = $root;
        

        $sql = "SELECT COUNT(voorwerpnummer) as aantal
                FROM Voorwerp ";
        if ($rubrieknummer != $root) {
            $allSubRubs = getAllSubRubrieken($rubrieknummer);
            $query_SubRub = "(".implode(',',$allSubRubs).")";
            $sql.= "JOIN VoorwerpInRubriek on voorwerpnummer = voorwerp 
                    WHERE rubriek_op_laagste_niveau IN $query_SubRub ";
        }

        $result = sqlsrv_query($conn, $sql, null);

        if ($result === false){die( print_r( sqlsrv_errors()));}

        while( $row = sqlsrv_fetch_array($result, SQLSRV_FETCH_ASSOC)) {
            $aantalArtikelen = $row['aantal'];
        }

        if($roundup == 'floor'){
            $length = strlen((string)$aantalArtikelen);
            $nZeros = pow(10, $length -1);
            $aantalArtikelen = floor($aantalArtikelen / $nZeros) * $nZeros;

        }
        
        sqlsrv_free_stmt($result);
        dbClose($conn);
        return $aantalArtikelen;
    }
    else{
        echo "Kan geen verbinding maken met de database.<br>";
        die( print_r( sqlsrv_errors(), true));
    }

    
}

function getArtikelImages($voorwerpnummer, $imgformaat = null){
    $conn = dbConnected();
    $img_paths = array();
    if($conn){
        $sql = "SELECT TOP 4 * ";

        $sql.= "FROM Bestand b INNER JOIN Voorwerp v ON b.voorwerp = v.voorwerpnummer
                WHERE b.voorwerp = $voorwerpnummer
                ORDER BY filenaam";

        $result = sqlsrv_query($conn, $sql, array(), array("Scrollable"=>"buffered"));

        if ( $result === false){die( print_r( sqlsrv_errors()));}

        if (sqlsrv_num_rows($result) == 0){
            return '#';
        }

        while( $row = sqlsrv_fetch_array($result, SQLSRV_FETCH_ASSOC)) {
            if (!empty($row['thumbnail'])) {
                $img_paths[] = ($imgformaat == 'thumbnail') ? $row['thumbnail'] : $row['filenaam'];
            } else {
                $img_paths[] = $row['filenaam'];
            }
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


    echo '<ol class="breadcrumb lint">
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

function getPager($rubrieknummer, $page = 1, $zoekterm = null){
    global $current_page;
    $next_page = $page + 1;
    $pre_page = $page - 1;
    if (!is_null($zoekterm)) {
        $zoekterm = "&term=".$zoekterm;
    }
    $last_page = 30;

    $p_disabled = ($page == 1 ? "disabled" : "");
    $n_disabled = ($page == $last_page ? "disabled" : "");

    $p_link = ($page != 1) ? $current_page.'&#63;rub_nr='.$rubrieknummer.'&page='.$pre_page.$zoekterm : "#" ;

    for ($i=0; $i < 5 ; $i++) { 
    
        $n_link[$i] = ($page != $last_page) ? $current_page.'&#63;rub_nr='.$rubrieknummer.'&page='.($next_page + $i).$zoekterm : "#" ;
    }

    echo       '<ul class="pagination">
                <li class="'.$p_disabled.'">
                  <a href="'.$p_link.'" aria-label="Previous">
                    <span aria-hidden="true">&laquo;</span>
                  </a>
                </li>
                <li class="active"><a href="#">'.$page.'</a></li>
                <li><a href="'.$n_link[0].'">'.$next_page.'</a></li>
                <li><a href="'.$n_link[1].'">'.($next_page + 1).'</a></li>
                <li><a href="'.$n_link[2].'">'.($next_page + 2).'</a></li>
                <li><a href="'.$n_link[3].'">'.($next_page + 3).'</a></li>
                <li>
                  <a href="'.$n_link[0].'" aria-label="Next">
                    <span aria-hidden="true">&raquo;</span>
                  </a>
                </li>
              </ul>';
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
                FROM Voorwerp v INNER JOIN bod b ON b.voorwerp = v.voorwerpnummer 
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


if (isset($_POST['zoekterm']) && isset($_POST['inRubriek'])) {
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
            $allSubRubs = getAllSubRubrieken($inRubriek);
            $query_SubRub = "(".implode(',',$allSubRubs).')';
            $sql.= "AND rubriek_op_laagste_niveau IN $query_SubRub ";
        }

                    
        $sql.= "ORDER BY titel";

        $result = sqlsrv_query($conn, $sql, null);

        if ( $result === false){die( print_r( sqlsrv_errors()));}

        while($row = sqlsrv_fetch_array($result, SQLSRV_FETCH_ASSOC)){

            $titel = filter($row['titel']);
            // maak zoekterm vetgedrukt
            $v_titel = preg_replace("/".$zoekterm."/i", '<b>$0</b>', $titel);
            // voeg nieuwe gevonden resultaat
            echo '<li onclick="set_item(\''.str_replace("'", "\'", $titel).'\')">'.$v_titel.'</li>';
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



function getProductInfo($voorwerpnummer)
{
    $conn = dbConnected();
    $inhoudPagina = array();

    if($conn){

        $sql = "SELECT  voorwerpnummer AS nr, titel, beschrijving, betalingsinstructie, land, plaatsnaam,
                        startprijs, verzendinstructies, verzendkosten, looptijdeindedag AS eindedag, looptijdbegintijdstip AS begintijdstip,
                        gebruiker, bank, bankrekening, creditcard, rubriek_op_laagste_niveau AS rubrieknummer, f.*
                FROM    Voorwerp v  LEFT JOIN Verkoper vk ON v.verkoper = vk.gebruiker
                                    LEFT JOIN VoorwerpInRubriek vir ON v.voorwerpnummer = vir.voorwerp
                                    LEFT JOIN Feedback f ON v.voorwerpnummer = f.voorwerp
                WHERE v.voorwerpnummer = $voorwerpnummer"; 

        $result = sqlsrv_query($conn, $sql, array(), array("Scrollable"=>"buffered"));
        if ( $result === false){die( print_r( sqlsrv_errors()));}

        if(sqlsrv_num_rows($result) == 0){

            sqlsrv_free_stmt($result);
            dbClose($conn);
            echo '<div class="center-box">Artikel bestaat niet of is verlopen.</div>';
        }
        else {
            while( $row = sqlsrv_fetch_array($result, SQLSRV_FETCH_ASSOC)) {
                $row['titel'] = filter($row['titel']);
                $row['beschrijving'] = filter($row['beschrijving']);
                $inhoudPagina = $row;
            }
            sqlsrv_free_stmt($result);
            dbClose($conn);
            return $inhoudPagina;
        }
    }
}

function loadthumbs($images){

    // for($i = 0; $i < 4; $i++){
    //     echo '<div class="thumb">';
    //     echo (!empty($images[$i])) 
    //             ? '<img id="thumbnail'.$i.'" src="http://iproject27.icasites.nl/'.$images[$i].'" alt="Afbeelding kan niet worden gelanden">' 
    //             : '<img src="images/no-image.jpg">';
    //     echo '</div>';
    // }
}

function getHoogsteBod($inhoud)
{
    $biedingen = getArtikelBod($inhoud['voorwerpnummer']);
    $prijs = $inhoud['startprijs'];
    if ($biedingen[0]['bodbedrag'] != null) 
    {
        return ($biedingen[0]['bodbedrag']);
    }
    return $prijs;
}

function checkArtikel ($voorwerpnummer) {
    $voorwerpnummer = $_GET['id'];
    $sql = "SELECT looptijdeindedag, looptijdbegintijdstip FROM voorwerp WHERE voorwerpnummer = '$voorwerpnummer'";
    $result = sqlsrv_query($conn, $sql, null);

    while ($row = sqlsrv_fetch_array($result, SQLSRV_FETCH_ASSOC)) {
        $looptijdbegintijdstip = date_format($row['looptijdbegintijdstip'], "H:i:s");
        $looptijdeindedag = date_format($row['looptijdeindedag'], "d-m-Y");

        $artikelDate = $looptijdeindeDag .' '. $looptijdbegintijdstip;
        echo $artikelDate;
    }
}

function filter($string){
    $string = preg_replace("|<script\b[^>]*>(.*?)</script>|s", "", $string);
    $string = preg_replace("|<style\b[^>]*>(.*?)</style>|s", "", $string);
    $string = strip_tags($string);
    $string = preg_replace("/[^A-Za-z0-9' -%?]/","",$string);
    $string = trim($string);
    return $string;
}
?>
