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
				<h1>Over ons:</h1>
				
				<h2>iConcepts</h2>
				<p>iConcepts is een organisatie dat betrouwbaarheid hoog in het vaandel heeft staan. Dit wil iConcepts graag overbrengen in hun dienstverlening, waarbij geen onderscheidt gemaakt wordt tussen het persoonlijke dan wel digitale contact.iConcepts wil een veilingsite openen, waarop gebruikers hun artikelen ter verkoop aanbieden en andere bij opbod die artikelen kunnen kopen. Enkele grote veilingsites floreren, zonder echte concurrentie te hebben. Dit gat wil IConcepts opvullen.</p>
				<br>
				<img id="anton" src="images/gouwenberg_anton.jpg" alt="Foto Anton Mijnder"> <p>CEO Iconepts Anton Mijnder</p>
				<br>

				<h2>Eenmaal Andermaal:</h2>
				
				<h3>Wat kunt u doen op deze website?</h3>
				
				<p>Op deze website kunt u zoeken naar 2e hands artikelen die andere mensen willen verkopen. Hier kunt u op bieden en als u het hoogste bedrag heeft geboden kunt u overleggen met de verkoper waar en wanneer u de transactie kunt regelen. Ook kunt u op deze website artikelen die u in huis heeft verkopen. Dit kunt u doen door naar mijn account te gaan en op toevoegen veiling te klikken. Daarna volgt u de stappen die hier worden aangegeven. U krijgt een e-mail als uw product is verkocht.</p>
				
				<h3>Prijs!</h3>
				
				<p>Waarom nieuwe artikelen kopen als de 2e handse net zo goed zijn? Het is toch zonde om nieuwe artikelen weg te gooien. U kunt ze veel beter verkopen. Eenmaal Andermaal is daar de oplossing voor! Alles gemakkelijk veilen.</p>
				
				<h3>Veiling site van het jaar</h3>
				
				<p>Afgelopen jaar is Eenmaal Andermaal verkozen tot de meest populaire veilingsite tijdens De Website van het Jaar verkiezing. Deze verkiezing is de ultieme publieksprijs die zich richt op de kwaliteit en inhoud van websites en wordt jaarlijks georganiseerd door MetrixLab. Voor moederbedrijf IConcept is het de derde prijs op rij die het snelgroeiende bedrijf in ontvangst mocht nemen. De afgelopen twee weken won het bedrijf ook al de Sprout Challenger of the Year Award, de High Growth Award en werd Emesa runner up bij de FD Gazellen. De Website van het Jaar Award wordt jaarlijks uitgereikt aan de meest populaire website volgens het Nederlandse publiek.<p>
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