<!DOCTYPE html>
<html lang="nl">		
<head>
	<title>Mijn veilingen</title>
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.4/css/bootstrap.min.css">
	<link rel="stylesheet" href="css/custom.css">
	<link rel="stylesheet" href="css/rubriek.css">
	<link rel="stylesheet" href="css/mijnveilingen.css">
</head>
<body>

<?php
require 'includes/connect.php';
require 'includes/header.php';
require 'includes/functions.php';
require 'includes/zoekbalk.php';

echo '
<div class="container-fluid">
<div class="content">
    <div class="row">';

        require 'includes/nav-account.php';


        if ($conn) {
            if (!isset($_SESSION['loginnaam'])) {
                echo '<h3><small>U bent niet ingelogd. Log in om uw accountgegevens te bekijken.</h3></small></table>';
            }

            else {
				
                $session = $_SESSION['loginnaam'];
                $sql = "select v.titel, v.beschrijving, v.startprijs, v.betalingswijze, r.rubrieknummer, v.betalingsinstructie, v.voorwerpnummer, v.looptijd, r.rubrieknaam, v.looptijdbegindag, v.looptijdbegintijdstip, v.looptijdeindedag
                            from voorwerp v
                                inner join voorwerpInRubriek vir
                                    on v.voorwerpnummer = vir.voorwerp
                                inner join Rubriek r
                                    on vir.rubriek_op_laagste_niveau = r.rubrieknummer
                            WHERE verkoper = '$session' ORDER BY startprijs";
                $result = sqlsrv_query($conn, $sql, null);
				
				$rowResult = sqlsrv_query($conn, $sql, array(), array("Scrollable"=>"buffered"));
                $rowCount = sqlsrv_num_rows($rowResult);

                if (empty($rowCount)) {
                    echo '<h3><small>U heeft nog geen veilingen aangemaakt.</h3></small>';
                }


                if	((sqlsrv_errors()) != null) {
                    echo '<h1><small>Er is iets foutgegaan aan onze kant. Probeer het later opnieuw.</small></h1>';
                }

				
                while ($row = sqlsrv_fetch_array($result, SQLSRV_FETCH_ASSOC)) {
					
					$voorwerpnummer = $row['voorwerpnummer'];
					$images = getArtikelImages($voorwerpnummer)[0];
					
					
                    $looptijdbegindag = date_format($row['looptijdbegindag'], "d-m-Y");
                    $looptijdbegintijdstip = date_format($row['looptijdbegintijdstip'], "H:i:s");
                    $looptijdeindedag = date_format($row['looptijdeindedag'], "d-m-Y");
                    echo '
                    <section class="rub-artikel">
                        <div class="col-xs-3 box-img">
                                <img class="plaatje" src="'.$images.'" alt="plaatje">
                            </div>
                            <div class="col-xs-9 box-text">
                                <h3>'.$row['titel'].'</h3>
                                <strong>Rubriek:</strong><br>'.$row['rubrieknaam'].'<br>
                                <div class="bottom-bar">
                                    <div class="col-xs-7">
                                        <h5>Begindatum: '.$looptijdbegindag.' '.$looptijdbegintijdstip.'<br> Einddatum: '.$looptijdeindedag.' '.$looptijdbegintijdstip.'</h5>
                                    </div>
                                    <div class="col-xs-2">
                                        <h5>Startprijs: &euro;'.$row['startprijs'].'</h5>
                                    </div>
                                    <div class="col-xs-3 right">
                                        <a href="artikel.php&#63;id='.$voorwerpnummer.'&rub_nr='.$row['rubrieknummer'].'" class="btn btn-success">Bekijken</a>
                                    </div>
                                </div>
                            </div>
                        </section>';
                }
            }
        }
        ?>
    </div>
</div>
</div>
<br><br><br><br>

<?php
require 'includes/footer.php';
?>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.2/jquery.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.4/js/bootstrap.min.js"></script>
<script src="js/main.js"></script>
</body>
</html>