<!DOCTYPE html>
<html lang="nl">
<head>
    <title>Eenmaal Andermaal</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.4/css/bootstrap.min.css">
    <link rel="stylesheet" href="//maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="css/custom.css">
    <link rel="stylesheet" href="css/over-ons.css">
    <?php require 'includes/functions.php'; ?>
</head>

<body>

<?php require 'includes/header.php';?>

<div class="container-fluid">
    <div class="row zoekbalk">
        <div class="col-xs-12 col-sm-8 col-sm-offset-2 col-md-6 col-md-offset-3">
            <div class="input-group">
                <input type="hidden" name="search_param" value="all" id="search_param">
                <input type="text" class="form-control" name="x" placeholder="Zoek artikel...">
                <div class="input-group-btn search-panel">
                    <!-- <button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown">
                    	<span id="search_concept">Rubriek</span> <span class="caret"></span>
                    </button> -->
                    <select name="Rubriek" class="btn"> <!-- class="dropdown-menu" role="menu" -->>
                        <option>Alles</option>

                    </select>
                </div>
                <span class="input-group-btn">
                    <button class="btn btn-default" type="button"><span class="glyphicon glyphicon-search"></span></button>
                </span>

            </div>
        </div>
    </div>
</div>
<div class="container-fluid">
    <main class= "row">

        <?php require 'includes/nav-rubriek.php';?>
        <div class="content col-xs-12 col-sm-10">

            <div class="center-box">
                <h3>Team</h3>
                <p>iConcepts heeft de organisatie Twenty-Seven Creations benadert om voor hen deze veilingsite te maken. Twenty-Seven Creations is een non-profit organisatie dat zich bezig houdt met het maken van moderne responsive website waar achter een database schuil gaat. Ook houden ze zich bezig met het maken van een beheerders applicaties waarmee de informatie in de database kan worden aangepast. Twenty-seven creations is gevestigd in het gebouw van de Hogeschool van Arnhem en Nijmegen te Arnhem. Binnen de organisatie op de afdeling ICA is een groep van 5 man samen aan het werk gegaan om deze site te maken voor IConcepts. De leden van de groep zijn Tom van den Berg, Tom Heerkens, Mustafa Sabur, Sven van Wijnen en Volkan Yüksel. De groep is erg enthousiast over de opdracht en is direct aan het werk gegaan.</p>

                <br><br><img id="twentyseven" src="images/IMG_4505 copy.jpg" alt="team">
                <br><br><br><br>
            </div>
        </div>
    </main>
</div>
<?php include 'includes/footer.php';?>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.2/jquery.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.4/js/bootstrap.min.js"></script>
<script src="js/jquery.visible.min.js"></script>
<script src="js/main.js"></script>
</body>
</html>