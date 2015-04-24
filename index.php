<!DOCTYPE html>
<html lang="nl">
<head>
	<title>Eenmaal Andermaal</title>
	<meta charset="utf-8">
  	<meta name="viewport" content="width=device-width, initial-scale=1">
  	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.4/css/bootstrap.min.css">
 	<link rel="stylesheet" href="css/custom.css">

	
</head>


<body>

<div class="container-fluid">
	<header>
		<div class="logo col-xs-12 col-sm-7"><a href=""><img src="images/logo.png"></a></div>
		<div class="keurmerk col-md-2 hidden-sm hidden-xs text-center"><img src="images/keurmerk.png"></div>
		<div class="login col-xs-12 col-sm-5 col-md-3"><?php require 'includes/login.php';?></div>
	</header>
</div>
<div class="container-fluid">
	<div class="row row-nomargin zoekbalk">    
        <div class="col-xs-12 col-sm-8 col-sm-offset-2 col-md-6 col-md-offset-3">
		    <div class="input-group">
                <input type="hidden" name="search_param" value="all" id="search_param">         
                <input type="text" class="form-control" name="x" placeholder="Zoek voorwerp...">
                <div class="input-group-btn search-panel">
                    <button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown">
                    	<span id="search_concept">Rubriek</span> <span class="caret"></span>
                    </button>
                    <ul class="dropdown-menu" role="menu">
                      <li><a href="">Alles</a></li>
                      <li class="divider"></li>
                      <li><a href="">Auto's</a></li>
                      <li><a href="">Kleding</a></li>
                      <li><a href="">Diversen</a></li>
                    </ul>
                </div>
                <span class="input-group-btn">
                    <button class="btn btn-default" type="button"><span class="glyphicon glyphicon-search"></span></button>
                </span>

            </div>
        </div>
	</div>
</div>
<div class="container-fluid">
	<main class= "row row-nomargin">
		<nav class="col-xs-2 hidden-xs">
			<h3>Rubrieken</h3>
			<hr>
			<a href="#">Alles</a>
			<a href="#">Auto's</a>
			<a href="#">Kleding</a>
            <a href="#">Diversen</a>
		</nav>

		<div class="content col-xs-12 col-sm-10">

			<h1>Last-Minutes</h1>
			<div class="product-row">
				<div class="product">
					<div class="product-img">
						<img src="images/iphone.jpg" alt="iphone">
					</div>
					<h5>iPhone 6. 64 GB</h5>
					<h4>Hoogste bod: € 180,00</h4>
				</div>
				<div class="product">product</div>
				<div class="product">product</div>
				<div class="product">product</div>
				<div class="product">product</div>
				<div class="product">product</div>
				<div class="product">product</div>
				<div class="product">product</div>
				<div class="product">product</div>
				<div class="product">product</div>
				<div class="product">product</div>
				<div class="product">product</div>
				<div class="product">product</div>
				<div class="product">product</div>
				<div class="product">product</div>
				<div class="product">product</div>
				<div class="product">product</div>
				<div class="product">product</div>
				<div class="product">product</div>
				<div class="product">product</div>
				<div class="product">product</div>
				<div class="product">product</div>
				<div class="product">product</div>
				<div class="product">product</div>
				<div class="product">product</div>
			</div>

			<h1>Popular</h1>
			<div class="product-row">
				<div class="product">product</div>
				<div class="product">product</div>
				<div class="product">product</div>
				<div class="product">product</div>
				<div class="product">product</div>
				<div class="product">product</div>
				<div class="product">product</div>
				<div class="product">product</div>
				<div class="product">product</div>
				<div class="product">product</div>
				<div class="product">product</div>
				<div class="product">product</div>
				<div class="product">product</div>
				<div class="product">product</div>
				<div class="product">product</div>
			</div>

			<h1>Recent Views</h1>
			<div class="product-row">
				<div class="product">product</div>
				<div class="product">product</div>
				<div class="product">product</div>
				<div class="product">product</div>
				<div class="product">product</div>
				<div class="product">product</div>
				<div class="product">product</div>
				<div class="product">product</div>
				<div class="product">product</div>
				<div class="product">product</div>
				<div class="product">product</div>
				<div class="product">product</div>
				<div class="product">product</div>
				<div class="product">product</div>
				<div class="product">product</div>
			</div>
		</div>
	</main>
</div>
<div class="container-fluid">
	<footer>
		footerr
	</footer>
</div>
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.2/jquery.min.js"></script>
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.4/js/bootstrap.min.js"></script>
</body>
</html>