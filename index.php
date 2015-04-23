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
	<header class ="row">
		<div class="logo col-xs-12 col-sm-6 col-md-7"><a href=""><img src="images/logo.png"></a></div>
		<div class="keurmerk col-md-2 hidden-sm hidden-xs text-center"><img src="images/keurmerk.png"></div>
		<div class="login col-xs-12 col-sm-6 col-md-3 text-center-xs"><?php require 'login.php';?></div>

		
		</div>
	</header>
</div>
<div class="container zoekbalk">
	<div class="row">    
        <div class="col-xs-8 col-xs-offset-2">
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
                      <li><a href="">Cars</a></li>
                      <li><a href="">Clothes</a></li>
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
	<main class= "row no-left-margin">
		<nav class="col-xs-2">
			<a href="#">All</a>
			<hr>
			<a href="#">Cars</a>
			<a href="#">Clothes</a>
			<a href="#">Other</a>
		</nav>

		<div class="col-xs-10">

			<h1>Last-Minutes</h1>
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