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
                <h3>Veiling site van het jaar</h3>

                <p>Afgelopen jaar is Eenmaal Andermaal verkozen tot de meest populaire veilingsite tijdens De Website van het Jaar verkiezing. Deze verkiezing is de ultieme publieksprijs die zich richt op de kwaliteit en inhoud van websites en wordt jaarlijks georganiseerd door MetrixLab. Voor moederbedrijf IConcept is het de derde prijs op rij die het snelgroeiende bedrijf in ontvangst mocht nemen. De afgelopen twee weken won het bedrijf ook al de Sprout Challenger of the Year Award, de High Growth Award en werd Emesa runner up bij de FD Gazellen. De Website van het Jaar Award wordt jaarlijks uitgereikt aan de meest populaire website volgens het Nederlandse publiek.<p><br>
                <img src="images/websitevanhetjaar.png" alt="award">
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