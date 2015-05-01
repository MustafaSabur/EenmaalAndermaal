<!DOCTYPE html>
<html lang="nl">
<head>
	<title>Eenmaal Andermaal</title>
	<meta charset="utf-8">
  	<meta name="viewport" content="width=device-width, initial-scale=1">
  	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.4/css/bootstrap.min.css">
  	<link rel="stylesheet" href="//maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css">
 	<link rel="stylesheet" href="css/custom.css">
	<link rel="stylesheet" href="css/contact.css">
	
	<script
	src="http://maps.googleapis.com/maps/api/js">
	</script>
	
	<script>
	
	var myCenter=new google.maps.LatLng(51.988900, 5.949291);
	var marker;
	
	function initialize() {
	  var mapProp = {
	    center:myCenter,
	    zoom:12,
	    mapTypeId:google.maps.MapTypeId.ROADMAP
	  };
	  var map=new google.maps.Map(document.getElementById("googleMap"), mapProp);
	  
	  var marker=new google.maps.Marker({
	    position:myCenter,
		animation:google.maps.Animation.BOUNCE
	    });

	  marker.setMap(map);
	  
	  
	}
	google.maps.event.addDomListener(window, 'load', initialize);
	</script>
	</head>
	
<body>

	<?php require 'includes/header.php';?>
	<?php require 'includes/nav-rubriek.php';?>
<div class="container-fluid">
	<div class="row zoekbalk">    
        <div class="col-xs-12 col-sm-8 col-sm-offset-2 col-md-6 col-md-offset-3">
		    <div class="input-group">
                <input type="hidden" name="search_param" value="all" id="search_param">         
                <input type="text" class="form-control" name="x" placeholder="Zoek voorwerp...">
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
		

		<div class="content col-xs-12 col-sm-10">
		
			<div class"center-box">
				<h1>Contact Info</h1>
				<h1><small>Vestigingsadres: </small></h1>
				<h5>Straat: </h5> <p>Ruitenberglaan</p> <br>
				<h5>Huisnummer: </h5> <p>31</p> <br>
				<h5>Postcode: </h5> <p>6826 CC</p> <br>
				<h5>Plaats: </h5> <p>Arnhem</p> <br>
				<h5>E-mailadres: </h5> <p>info.27creations@gmail.com<p> <br>
				<h5>Telefoonnummer: </h5> <p>+31 (0)33 460 00 70</p> <br>
				<h5>kvk: </h5> <p>123456789012<p> <br>
				<h5>Fax: </h5> <p>+31 (0)33 460 00 79<p> <br>
				<h2>Google Maps:<h2>
				<div id="googleMap"> </div> 
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