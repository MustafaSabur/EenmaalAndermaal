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
	var myCenter=new google.maps.LatLng(52.522952,5.440695);
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
		<nav class="col-xs-2 hidden-xs">
			<h3>Rubrieken</h3>
			<hr>
			<a href="rubriek.php">Categorie 1</a>
			<a href="#">Categorie 2</a>
			<a href="#">Categorie 3</a>
         <a href="#">Categorie 4</a>
         <a href="#">Categorie 5</a>
         <a href="#">Categorie 6</a>
         <a href="#">Categorie 7</a>
         <a href="#">Categorie 8</a>
         <a href="#">Categorie 9</a>
         <a href="#">Categorie 10</a>
         <a href="#">Categorie 11</a>
         <a href="#">Categorie 12</a>
         <a href="#">Categorie 13</a>
         <a href="#">Categorie 14</a>
         <a href="#">Categorie 15</a>
         <a href="#">Categorie 16</a>
         <a href="#">Categorie 17</a>
         <a href="#">Categorie 18</a>
         <a href="#">Categorie 19</a>
         <a href="#">Categorie 20</a>
         <a href="#">Categorie 21</a>
         <a href="#">Categorie 22</a>
         <a href="#">Categorie 23</a>
         <a href="#">Categorie 24</a>
         <a href="#">Categorie 25</a>
         <a href="#">Categorie 26</a>
         <a href="#">Categorie 27</a>
         <a href="#">Categorie 28</a>
         <a href="#">Categorie 29</a>
         <a href="#">Categorie 30</a>
         <a href="#">Categorie 31</a>
         <a href="#">Categorie 32</a>
		</nav>

		<div class="content col-xs-12 col-sm-10">

			<h1>Contact Info</h1>
			<h3>Vestigingsadres:</h3>
			<h5>Straat:</h5> <p>Ruitenberglaan</p> <br>
			<h5>Huisnummer:</h5> <p>31</p> <br>
			<h5>Postcode:</h5> <p>6826 CC</p> <br>
			<h5>Plaats:</h5> <p>Arnhem</p> <br>
			<h5>E-mailadres:</h5> <p>info.27creations@gmail.com<p> <br>
			<h5>Telefoonnummer:</h5> <p>+31 (0)33 460 00 70</p> <br>
			<h5>kvk:</h5> <p>123456789012<p> <br>
			<h5>Fax:</h5> <p>+31 (0)33 460 00 79<p> <br>
			<h2>Google Maps:<h2>
			<iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d2456.9885509881647!2d5.949330540257853!3d51.98886230949375!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x0000000000000000%3A0x076f2727a90f3906!2sHogeschool+van+Arnhem+en+Nijmegen!5e0!3m2!1snl!2snl!4v1423563072587" class="iframe"></iframe>
			<div id="googleMap"> </div> 
	
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