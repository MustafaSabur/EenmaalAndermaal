<!DOCTYPE html>
<html lang="nl">
<head>
	<title>Eenmaal Andermaal</title>
	<meta charset="utf-8">
  	<meta name="viewport" content="width=device-width, initial-scale=1">
  	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.4/css/bootstrap.min.css">
  	<link rel="stylesheet" href="//maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css">
 	<link rel="stylesheet" href="css/custom.css">
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
		<?php require 'includes/nav-rubriek.php';?>

		<div class="content col-xs-12 col-sm-10">
			<div class="l-minute">
				<h1>Last-Minutes</h1>
				<div class="product-row">
					<a href="voorwerp.php" class="product">
						<div class="product-img ">
							<img src="images/voorwerpen/product1-01.jpg" alt="iphone">
						</div>
						<h5>USB Muis</h5>
						<h4>Hoogste bod: € 180,00</h4>
					</a>
					<a href="voorwerp.php" class="product">
						<div class="product-img ">
							<img src="images/voorwerpen/product1-01.jpg" alt="iphone">
						</div>
						<h5>USB Muis</h5>
						<h4>Hoogste bod: € 180,00</h4>
					</a>
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
			</div>
			<div class= "popular">
				<h1>Popular</h1>
				<div class="product-row popular">
					<a href="voorwerp.php" class="product">
							<div class="product-img ">
								<img src="images/voorwerpen/product1-01.jpg" alt="iphone">
							</div>
							<h5>USB Muis</h5>
							<h4>Hoogste bod: € 180,00</h4>
					</a>
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
			<div class= "recent">
				<h1>Recent Views</h1>
				<div class="product-row recent">
					<a href="voorwerp.php" class="product">
						<div class="product-img ">
							<img src="images/voorwerpen/product1-01.jpg" alt="iphone">
						</div>
						<h5>USB Muis</h5>
						<h4>Hoogste bod: € 180,00</h4>
					</a>
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