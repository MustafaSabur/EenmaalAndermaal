<!-- alle functies-->
<?php

//connection
require_once 'conn.php';


//globals
$rubrieklijst;
$root = -1;




// Smart GET function
function GET($name=NULL, $value=false, $option="default")
{
    $option=false; // Old version depricated part
    $content=(!empty($_GET[$name]) ? trim($_GET[$name]) : (!empty($value) && !is_array($value) ? trim($value) : false));
    if(is_numeric($content))
        return preg_replace("@([^0-9])@Ui", "", $content);
    else if(is_bool($content))
        return ($content?true:false);
    else if(is_float($content))
        return preg_replace("@([^0-9\,\.\+\-])@Ui", "", $content);
    else if(is_string($content))
    {
        if(filter_var ($content, FILTER_VALIDATE_URL))
            return $content;
        else if(filter_var ($content, FILTER_VALIDATE_EMAIL))
            return $content;
        else if(filter_var ($content, FILTER_VALIDATE_IP))
            return $content;
        else if(filter_var ($content, FILTER_VALIDATE_FLOAT))
            return $content;
        else
            return preg_replace("@([^a-zA-Z0-9\+\-\_\*\@\$\!\;\.\?\#\:\=\%\/\ ]+)@Ui", "", $content);
    }
    else false;
}

function printRubrieken($rubrieknummer = -1, $weergave = null){

    global $rubrieklijst;
    global $root;

    if (empty($rubrieklijst[$rubrieknummer])) {
        getSubrubrieken($rubrieknummer);
    }


    if ($weergave == 'options') {
        echo '<select name="Rubriek" id="zoekInRubriek" class="rub-select">';
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

function getAllSubRubrieken($rubrieknummer){
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



    return $allSubRubs;
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


function getRubriekArtikelen($rubrieknummer, $page = 1, $nArtikelen = 8){

    global $root;
    $conn = dbConnected();
    $start = ($page -1) * $nArtikelen;
    
    

    if($conn){
        $sql = "SELECT v.*
                FROM Voorwerp v INNER JOIN VoorwerpInRubriek vir ON v.voorwerpnummer = vir.voorwerp ";
                                //INNER JOIN Gebruiker g ON g.gebruikersnaam = v.verkoper
                                //LEFT JOIN Gebruikerstelefoon t ON g.gebruikersnaam = t.gebruiker ";
        $sql.= "WHERE looptijdeindedag >= CONVERT(DATE, GETDATE()) AND looptijdbegintijdstip > CONVERT(TIME, GETDATE()) ";

        if ($rubrieknummer != $root) {
            $allSubRubs = getAllSubRubrieken($rubrieknummer);
            $query_SubRub = "(".implode(',',$allSubRubs).")";
            $sql.= "AND rubriek_op_laagste_niveau IN $query_SubRub ";
        }
        
        $sql.= "ORDER BY looptijdeindeDag, looptijdbeginTijdstip, looptijd
                OFFSET $start ROWS
                FETCH NEXT $nArtikelen ROWS ONLY";


        $result = sqlsrv_query( $conn, $sql, array(), array("Scrollable"=>"buffered"));
        if ( $result === false) { die( print_r( sqlsrv_errors() ) ); }

        $row_count = sqlsrv_num_rows($result); 



        if ($row_count == 0) {
            echo '<div class="center-box"><h3>Sorry niets gevonden.</h3></div>';
        }else {
            while( $row = sqlsrv_fetch_array( $result, SQLSRV_FETCH_ASSOC)) {

                $voorwerpnummer = $row['voorwerpnummer'];

                $images = getArtikelImages($voorwerpnummer, 'thumbnail');
                $src_first_img = trim($images[0]);

                $d =  $row['looptijdeindeDag'];
                $t =  $row['looptijdbeginTijdstip'];
                $date = "'".$d->format('Y-m-d')." ".$t->format('H:i:s')."'";
                $biedingen = getArtikelBod($row['voorwerpnummer']);

                $titel = $row['titel'];
                $titel = strip_tags($titel);
                $titel = preg_replace("/[^A-Za-z0-9' -%?]/","",$titel);
                $titel = trim($titel);

                $beschrijving = $row['beschrijving'];
                //$beschrijving = preg_replace("/<script*(.*?)script>/i", "", $beschrijving);
                //$beschrijving = preg_replace('/(<(script|style)\b[^>]*>).*?(<\/\2>)/s', "gonee", $beschrijving);
                $beschrijving = preg_replace("|<script\b[^>]*>(.*?)</script>|s", "", $beschrijving);
                $beschrijving = preg_replace("|<style\b[^>]*>(.*?)</style>|s", "", $beschrijving);
                $beschrijving = strip_tags($beschrijving);
                $beschrijving = trim($beschrijving);
                
                $prijs = $row['startprijs'];

                if ($biedingen[0]['bodbedrag'] != null) {
                    $prijs = $biedingen[0]['bodbedrag'];
                }


                
                
              echo '<section class="rub-artikel">
                        <div class="col-xs-3 box-img">
                            <img src="http://iproject27.icasites.nl/'.$src_first_img.'" alt="'.$titel.'">
                        </div>
                        <div class="col-xs-9 box-text">
                            <h3><a href="artikel.php&#63;id='.$voorwerpnummer.'">'.$titel.'</a></h3>
                            <p class="beschrijving"><strong>Beschrijving:</strong><br>'.$beschrijving.'<br>
                            <a href="artikel.php&#63;id='.$voorwerpnummer.'&rub_nr='.$rubrieknummer.'">Lees verder</a></p>
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
                                    <a href="artikel.php&#63;id='.$voorwerpnummer.'&rub_nr='.$rubrieknummer.'" class="btn btn-success">Bied mee</a>
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

function getAantalArtikelenIn($rubrieknummer){
    global $root;

    $conn = dbConnected();
    
    if($conn){
        $aantalArtikelen = 0;

        $sql = "SELECT COUNT(voorwerpnummer) as aantal
                FROM Voorwerp JOIN VoorwerpInRubriek on voorwerpnummer = voorwerp ";

        if ($rubrieknummer != $root) {
            $allSubRubs = getAllSubRubrieken($rubrieknummer);
            $query_SubRub = "(".implode(',',$allSubRubs).")";
            $sql.= "WHERE rubriek_op_laagste_niveau IN $query_SubRub ";
        }

        $result = sqlsrv_query($conn, $sql, null);

        if ($result === false){die( print_r( sqlsrv_errors()));}

        while( $row = sqlsrv_fetch_array($result, SQLSRV_FETCH_ASSOC)) {
            $aantalArtikelen = $row['aantal'];
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
            
            $img_paths[] =  ($imgformaat == 'thumbnail') ? $row['thumbnail'] : $row['filenaam'];
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



function getPager($rubrieknummer, $page = 1){
    $next_page = $page + 1;
    $pre_page = $page - 1;

    $last_page = 30;

    $p_disabled = ($page == 1 ? "disabled" : "");
    $n_disabled = ($page == $last_page ? "disabled" : "");

    $p_link = ($page != 1) ? 'rubriek.php&#63;rub_nr='.$rubrieknummer.'&page='.$pre_page : "#" ;

    for ($i=0; $i < 5 ; $i++) { 
    
        $n_link[$i] = ($page != $last_page) ? 'rubriek.php&#63;rub_nr='.$rubrieknummer.'&page='.($next_page + $i) : "#" ;
    }
    //$aantal = getAantalArtikelenIn($rubrieknummer);

    //echo $aantal;



    // echo   '<ul class="pager lint">
    //             <li class="previous '.$p_disabled.'"><a href="rubriek.php&#63;rub_nr='.$rubrieknummer.'&page='.$pre_page.'"><span aria-hidden="true">&larr;</span> Vorige</a></li>
    //             <li class="next '.$n_disabled.'"><a href="rubriek.php&#63;rub_nr='.$rubrieknummer.'&page='.$next_page.'">Volgende <span aria-hidden="true">&rarr;</span></a></li>
    //         </ul>';





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

            $titel = $row['titel'];
            $titel = strip_tags($titel);
            $titel = preg_replace("/[^A-Za-z0-9' -%?]/","",$titel);
            $titel = trim($titel);
            // maak zoekterm vetgedrukt
            $v_titel = preg_replace("/".$zoekterm."/i", '<b>$0</b>', $titel);
            // voeg nieuwe gevonden resultaat
            echo '<li onclick="set_item(\''.str_replace("'", "\'", $titel).'\')">'.$v_titel.'</li>';
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
                vk.creditcard, b.gebruiker as bieder, b.bodbedrag, b.bod_tijdstip, b.bod_dag,
                f.commentaar, f.dag, f.rating, f.soort_gebruiker, f.tijdstip
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

                $inhoudPagina['titel'] = $row['titel'];
                $inhoudPagina['land'] = $row['land'];
                $inhoudPagina['beschrijving'] = $row['beschrijving'];
                $inhoudPagina['betalingsinstructie'] = $row['betalingsinstructie'];
                $inhoudPagina['plaatsnaam'] = $row['plaatsnaam'];
                $inhoudPagina['startprijs'] = $row['startprijs'];                    
                $inhoudPagina['verzendinstructies'] = $row['verzendinstructies'];
                $inhoudPagina['verzendkosten'] = $row['verzendkosten'];
                $inhoudPagina['gebruiker'] = $row['gebruiker'];
                $inhoudPagina['bank'] = $row['bank'];
                $inhoudPagina['bankrekening'] = $row['bankrekening'];
                $inhoudPagina['creditcard'] = $row['creditcard'];
                $inhoudPagina['bieder'] = $row['bieder'];
                $inhoudPagina['bodbedrag'] = $row['bodbedrag'];
                $inhoudPagina['bod_tijdstip'] = $row['bod_tijdstip'];
                $inhoudPagina['bod_dag'] = $row['bod_dag'];
                $inhoudPagina['commentaar'] = $row['commentaar'];
                $inhoudPagina['dag'] = $row['dag'];
                $inhoudPagina['rating'] = $row['rating'];
                $inhoudPagina['soort_gebruiker'] = $row['soort_gebruiker'];
                $inhoudPagina['tijdstip'] = $row['tijdstip'];

            }
            sqlsrv_free_stmt($result);
            dbClose($conn);
            return $inhoudPagina;
        }
    }
}

function fileUpload($id) {
	$session = $_SESSION['loginnaam'];
	$target_dir = 'upload/'.$session.'/';
	$target_file = $target_dir . $voorwerpnr . '_' .  basename($_FILES["fileToUpload{$id}"]["name"]);
	var_dump($target_dir);
	var_dump($target_file);
	$uploadOk = 1;
	$imageFileType = pathinfo($target_file,PATHINFO_EXTENSION);
	// Check if image file is a actual image or fake image
	if(isset($_POST["submit"])) {
		$check = getimagesize($_FILES["fileToUpload{$id}"]["tmp_name"]);
		if($check !== false) {
			$uploadOk = 1;
		} else {
			echo "Bestand is geen image.";
			$uploadOk = 0;
		}
	}

	// Check if file already exists
	if (file_exists($target_file)) {
		echo "Uw bestand bestaat al.";
		$uploadOk = 0;
	}
	// Check file size
	if ($_FILES["fileToUpload"]["size"] > 500000) {
		echo "Sorry, your file is too large.";
		$uploadOk = 0;
	}
	// Allow certain file formats
	if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg") {
		echo "Sorry, only JPG, JPEG, PNG are allowed";
		$uploadOk = 0;
	}
	// Check if $uploadOk is set to 0 by an error
	if ($uploadOk == 0) {
		echo "Sorry, your file was not uploaded.";
	// if everything is ok, try to upload file
	} else {
		if (move_uploaded_file($_FILES["fileToUpload{$id}"]["tmp_name"], $target_file)) {
			echo "The file ". basename( $_FILES["fileToUpload"]["name"]). " has been uploaded.";
		} else {
			echo "Sorry, there was an error uploading your file.";
		}
	}

$query="INSERT into bestand (FILENAAM, VOORWERP) VALUES('$target_file','$voorwerpnr'); ";
$result = sqlsrv_query($conn, $query, null);
}
?>
