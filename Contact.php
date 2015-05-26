<!DOCTYPE html>
<html lang="nl">
<head>
	<title>Eenmaal Andermaal</title>
	<meta charset="utf-8">
  	<meta name="viewport" content="width=device-width, initial-scale=1">
  	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.4/css/bootstrap.min.css">
 	<link rel="stylesheet" href="css/custom.css">
	<link rel="stylesheet" href="css/contact.css">
    <?php require 'includes/functions.php'; ?>

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
	
<div class="container-fluid">
	
</div>
<div class="container-fluid">
	<main class= "row">
        <?php require 'includes/nav-rubriek.php';?>
		
		<div class="content">
		
			<div class="center-box">
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
				<h5>Klantenservice:</h5> <p>Hebben we nog niet.</p>
				<h1><small>Veelgestelde vragen:</small></h1>

                <h5>Hoe werkt het?</h5>
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