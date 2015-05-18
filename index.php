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
<?php require 'includes/zoekbalk.php';?>
<div class="container-fluid">
	<main class= "row">
		<?php require 'includes/nav-rubriek.php';?>

		<div class="content col-xs-12">
			<div class="product-box l-minute">
				<h1>Last-Minutes</h1>
				<div class="product-row" id="l-minute">
					<a href="artikel.php" class="product">
						<div class="product-img ">
							<img src="images/artikelen/product1-01.jpg" alt="iphone">
						</div>
                        <h5>Grijs USB 3.0 Muis</h5>
                        <h5>Computer Accessoires</h5>
						<h4>Hoogste bod: € 3,00</h4>
						<p class="time" id="time"></p>
					</a>
					<a href="artikel.php" class="product">
						<div class="product-img ">
							<img src="images/artikelen/product2-01.jpg" alt="iphone">
						</div>
						<h5>Zwarte Logitech Luidsprekers</h5>
                        <h5>Luidsprekers</h5>
						<h4>Hoogste bod: € 80,00</h4>
						<p class="time" id="time2"></p>
					</a>
					<a href="artikel.php" class="product">
						<div class="product-img ">
							<img src="images/artikelen/product3-01.jpg" alt="iphone">
						</div>
						<h5>Batavus herenfiets</h5>
                        <h5>Fietsen</h5>
						<h4>Hoogste bod: € 120,00</h4>
						<p class="time" id="time2"></p>
					</a>
					<a href="artikel.php" class="product">
						<div class="product-img ">
							<img src="images/artikelen/product4-01.jpg" alt="iphone">
						</div>
						<h5>Laptops</h5>
						<h5>Macbook Air</h5>
						<h4>Hoogste bod: € 450,00</h4>
						<p class="time" id="time2"></p>
					</a>
					<a href="artikel.php" class="product">
						<div class="product-img ">
							<img src="images/artikelen/product5-01.jpg" alt="iphone">
						</div>
						<h5>Diversen</h5>
						<h5>Electronische transporter</h5>
						<h4>Hoogste bod: € 995,00</h4>
						<p class="time" id="time2"></p>
					</a>
					<a href="artikel.php" class="product">
						<div class="product-img ">
							<img src="images/artikelen/product11-01.jpg" alt="iphone">
						</div>
                        <h5>Koptelefoons</h5>
						<h5>Beats by Dre</h5>
						<h4>Hoogste bod: € 3,00</h4>
						<p class="time" id="time"></p>
					</a>
					<a href="artikel.php" class="product">
						<div class="product-img ">
							<img src="images/artikelen/product12-01.jpg" alt="iphone">
						</div>
                        <h5>Telefoons</h5>
						<h5>iPhone 6</h5>
						<h4>Hoogste bod: € 80,00</h4>
						<p class="time" id="time2"></p>
					</a>
					<a href="artikel.php" class="product">
						<div class="product-img ">
							<img src="images/artikelen/product13-01.jpg" alt="iphone">
						</div>
                        <h5>Schoenen</h5>
						<h5>Filling Pieces</h5>
						<h4>Hoogste bod: € 120,00</h4>
						<p class="time" id="time2"></p>
					</a>
					<a href="artikel.php" class="product">
						<div class="product-img ">
							<img src="images/artikelen/product14-01.jpg" alt="iphone">
						</div>
                        <h5>Auto's</h5>
						<h5>Mercedes</h5>
						<h4>Hoogste bod: € 94.500,00</h4>
						<p class="time" id="time2"></p>
					</a>
					<a href="artikel.php" class="product">
						<div class="product-img ">
							<img src="images/artikelen/product15-01.jpg" alt="iphone">
						</div>
                        <h5>Horloges</h5>
                        <h5>Richard Mille</h5>
						<h4>Hoogste bod: € 995,00</h4>
						<p class="time" id="time2"></p>
					</a>
					<a href="artikel.php" class="product">
						<div class="product-img ">
							<img src="images/artikelen/product16-01.jpg" alt="iphone">
						</div>
                        <h5>Kleding</h5>
						<h5>Stüssy T-Shirt</h5>
						<h4>Hoogste bod: € 3,00</h4>
						<p class="time" id="time"></p>
					</a>
					<a href="artikel.php" class="product">
						<div class="product-img ">
							<img src="images/artikelen/product17-01.jpg" alt="iphone">
						</div>
                        <h5>Jachten</h5>
						<h5>Heesen Yachts</h5>
						<h4>Hoogste bod: € 16.000.000</h4>
						<p class="time" id="time2"></p>
					</a>
					<a href="artikel.php" class="product">
						<div class="product-img ">
							<img src="images/artikelen/product18-01.jpg" alt="iphone">
						</div>
						<h5>Spelcomputers</h5>
                        <h5>PlayStation 4</h5>
						<h4>Hoogste bod: € 320,00</h4>
						<p class="time" id="time2"></p>
					</a>
					<a href="artikel.php" class="product">
						<div class="product-img ">
							<img src="images/artikelen/product19-01.jpg" alt="iphone">
						</div>
						<h5>Kleding</h5>
                        <h5>Mechanical Dummy</h5>
						<h4>Hoogste bod: € 20,00</h4>
						<p class="time" id="time2"></p>
					</a>
				</div>
				<div class="arrow-left" onclick="scrollL('l-minute')">
					<img src="images/r_arrow_orange.png" alt="leftarrow">
					<img src="images/r_arrow_trans.png" alt="leftarrow">
					
				</div>
				<div class="arrow-right" onclick="scrollR('l-minute')">
					<img src="images/r_arrow_orange.png" alt="rightarrow">
					<img src="images/r_arrow_trans.png" alt="rightarrow">
				</div>
			</div>
			<div class= "product-box populair">
				<h1>Populair</h1>
				<div class="product-row" id="populair">
                    <a href="artikel.php" class="product">
                        <div class="product-img ">
                            <img src="images/artikelen/product19-01.jpg" alt="iphone">
                        </div>
                        <h5>Kleding</h5>
                        <h5>Mechanical Dummy</h5>
                        <h4>Hoogste bod: € 20,00</h4>
                        <p class="time" id="time2"></p>
                    </a>
                    <a href="artikel.php" class="product">
                        <div class="product-img ">
                            <img src="images/artikelen/product18-01.jpg" alt="iphone">
                        </div>
                        <h5>Spelcomputers</h5>
                        <h5>PlayStation 4</h5>
                        <h4>Hoogste bod: € 320,00</h4>
                        <p class="time" id="time2"></p>
                    </a>
                    <a href="artikel.php" class="product">
                        <div class="product-img ">
                            <img src="images/artikelen/product17-01.jpg" alt="iphone">
                        </div>
                        <h5>Jachten</h5>
                        <h5>Heesen Yachts</h5>
                        <h4>Hoogste bod: € 16.000.000</h4>
                        <p class="time" id="time2"></p>
                    </a>
                    <a href="artikel.php" class="product">
                        <div class="product-img ">
                            <img src="images/artikelen/product16-01.jpg" alt="iphone">
                        </div>
                        <h5>Kleding</h5>
                        <h5>Stüssy T-Shirt</h5>
                        <h4>Hoogste bod: € 3,00</h4>
                        <p class="time" id="time"></p>
                    </a>
                    <a href="artikel.php" class="product">
                        <div class="product-img ">
                            <img src="images/artikelen/product15-01.jpg" alt="iphone">
                        </div>
                        <h5>Horloges</h5>
                        <h5>Richard Mille</h5>
                        <h4>Hoogste bod: € 995,00</h4>
                        <p class="time" id="time2"></p>
                    </a>
                    <a href="artikel.php" class="product">
                        <div class="product-img ">
                            <img src="images/artikelen/product1-01.jpg" alt="iphone">
                        </div>
                        <h5>Computer Accessoires</h5>
                        <h5>Grijs USB 3.0 Muis</h5>
                        <h4>Hoogste bod: € 3,00</h4>
                        <p class="time" id="time"></p>
                    </a>
                    <a href="artikel.php" class="product">
                        <div class="product-img ">
                            <img src="images/artikelen/product2-01.jpg" alt="iphone">
                        </div>
                        <h5>Luidsprekers</h5>
                        <h5>Zwarte Logitech Luidsprekers</h5>
                        <h4>Hoogste bod: € 80,00</h4>
                        <p class="time" id="time2"></p>
                    </a>
                    <a href="artikel.php" class="product">
                        <div class="product-img ">
                            <img src="images/artikelen/product3-01.jpg" alt="iphone">
                        </div>
                        <h5>Fietsen</h5>
                        <h5>Batavus herenfiets</h5>
                        <h4>Hoogste bod: € 120,00</h4>
                        <p class="time" id="time2"></p>
                    </a>
                    <a href="artikel.php" class="product">
                        <div class="product-img ">
                            <img src="images/artikelen/product4-01.jpg" alt="iphone">
                        </div>
                        <h5>Laptops</h5>
                        <h5>Macbook Air</h5>
                        <h4>Hoogste bod: € 450,00</h4>
                        <p class="time" id="time2"></p>
                    </a>
                    <a href="artikel.php" class="product">
                        <div class="product-img ">
                            <img src="images/artikelen/product5-01.jpg" alt="iphone">
                        </div>
                        <h5>Diversen</h5>
                        <h5>Electronische transporter</h5>
                        <h4>Hoogste bod: € 995,00</h4>
                        <p class="time" id="time2"></p>
                    </a>
                    <a href="artikel.php" class="product">
                        <div class="product-img ">
                            <img src="images/artikelen/product11-01.jpg" alt="iphone">
                        </div>
                        <h5>Koptelefoons</h5>
                        <h5>Beats by Dre</h5>
                        <h4>Hoogste bod: € 3,00</h4>
                        <p class="time" id="time"></p>
                    </a>
                    <a href="artikel.php" class="product">
                        <div class="product-img ">
                            <img src="images/artikelen/product12-01.jpg" alt="iphone">
                        </div>
                        <h5>Telefoons</h5>
                        <h5>iPhone 6</h5>
                        <h4>Hoogste bod: € 80,00</h4>
                        <p class="time" id="time2"></p>
                    </a>
                    <a href="artikel.php" class="product">
                        <div class="product-img ">
                            <img src="images/artikelen/product13-01.jpg" alt="iphone">
                        </div>
                        <h5>Schoenen</h5>
                        <h5>Filling Pieces</h5>
                        <h4>Hoogste bod: € 120,00</h4>
                        <p class="time" id="time2"></p>
                    </a>
                    <a href="artikel.php" class="product">
                        <div class="product-img ">
                            <img src="images/artikelen/product14-01.jpg" alt="iphone">
                        </div>
                        <h5>Auto's</h5>
                        <h5>Mercedes</h5>
                        <h4>Hoogste bod: € 94.500,00</h4>
                        <p class="time" id="time2"></p>
                    </a>
				</div>
				<div class="arrow-left" onclick="scrollL('populair')">
					<img src="images/r_arrow_red.png" alt="leftarrow">
					<img src="images/r_arrow_trans.png" alt="leftarrow">
				</div>
				<div class="arrow-right" onclick="scrollR('populair')">
					<img src="images/r_arrow_red.png" alt="rightarrow">
					<img src="images/r_arrow_trans.png" alt="rightarrow">
				</div>
			</div>
			<div class= "product-box recent">
				<h1>Recent Views</h1>
				<div class="product-row" id="recent">
                    <a href="artikel.php" class="product">
                        <div class="product-img ">
                            <img src="images/artikelen/product3-01.jpg" alt="iphone">
                        </div>
                        <h5>Fietsen</h5>
                        <h5>Batavus herenfiets</h5>
                        <h4>Hoogste bod: € 120,00</h4>
                        <p class="time" id="time2"></p>
                    </a>
                    <a href="artikel.php" class="product">
                        <div class="product-img ">
                            <img src="images/artikelen/product11-01.jpg" alt="iphone">
                        </div>
                        <h5>Koptelefoons</h5>
                        <h5>Beats by Dre</h5>
                        <h4>Hoogste bod: € 3,00</h4>
                        <p class="time" id="time"></p>
                    </a>
                    <a href="artikel.php" class="product">
                        <div class="product-img ">
                            <img src="images/artikelen/product14-01.jpg" alt="iphone">
                        </div>
                        <h5>Auto's</h5>
                        <h5>Mercedes</h5>
                        <h4>Hoogste bod: € 94.500,00</h4>
                        <p class="time" id="time2"></p>
                    </a>
                    <a href="artikel.php" class="product">
                        <div class="product-img ">
                            <img src="images/artikelen/product4-01.jpg" alt="iphone">
                        </div>
                        <h5>Laptops</h5>
                        <h5>Macbook Air</h5>
                        <h4>Hoogste bod: € 450,00</h4>
                        <p class="time" id="time2"></p>
                    </a>
                    <a href="artikel.php" class="product">
                        <div class="product-img ">
                            <img src="images/artikelen/product13-01.jpg" alt="iphone">
                        </div>
                        <h5>Schoenen</h5>
                        <h5>Filling Pieces</h5>
                        <h4>Hoogste bod: € 120,00</h4>
                        <p class="time" id="time2"></p>
                    </a>
                    <a href="artikel.php" class="product">
                        <div class="product-img ">
                            <img src="images/artikelen/product15-01.jpg" alt="iphone">
                        </div>
                        <h5>Horloges</h5>
                        <h5>Richard Mille</h5>
                        <h4>Hoogste bod: € 995,00</h4>
                        <p class="time" id="time2"></p>
                    </a>
                    <a href="artikel.php" class="product">
                        <div class="product-img ">
                            <img src="images/artikelen/product5-01.jpg" alt="iphone">
                        </div>
                        <h5>Diversen</h5>
                        <h5>Electronische transporter</h5>
                        <h4>Hoogste bod: € 995,00</h4>
                        <p class="time" id="time2"></p>
                    </a>
                    <a href="artikel.php" class="product">
                        <div class="product-img ">
                            <img src="images/artikelen/product16-01.jpg" alt="iphone">
                        </div>
                        <h5>Kleding</h5>
                        <h5>Stüssy T-Shirt</h5>
                        <h4>Hoogste bod: € 3,00</h4>
                        <p class="time" id="time"></p>
                    </a>
                    <a href="artikel.php" class="product">
                        <div class="product-img ">
                            <img src="images/artikelen/product11-01.jpg" alt="iphone">
                        </div>
                        <h5>Koptelefoons</h5>
                        <h5>Beats by Dre</h5>
                        <h4>Hoogste bod: € 3,00</h4>
                        <p class="time" id="time"></p>
                    </a>
                    <a href="artikel.php" class="product">
                        <div class="product-img ">
                            <img src="images/artikelen/product18-01.jpg" alt="iphone">
                        </div>
                        <h5>Spelcomputers</h5>
                        <h5>PlayStation 4</h5>
                        <h4>Hoogste bod: € 320,00</h4>
                        <p class="time" id="time2"></p>
                    </a>
                    <a href="artikel.php" class="product">
                        <div class="product-img ">
                            <img src="images/artikelen/product12-01.jpg" alt="iphone">
                        </div>
                        <h5>Telefoons</h5>
                        <h5>iPhone 6</h5>
                        <h4>Hoogste bod: € 80,00</h4>
                        <p class="time" id="time2"></p>
                    </a>
                    <a href="artikel.php" class="product">
                        <div class="product-img ">
                            <img src="images/artikelen/product14-01.jpg" alt="iphone">
                        </div>
                        <h5>Auto's</h5>
                        <h5>Mercedes</h5>
                        <h4>Hoogste bod: € 94.500,00</h4>
                        <p class="time" id="time2"></p>
                    </a>
                    <a href="artikel.php" class="product">
                        <div class="product-img ">
                            <img src="images/artikelen/product17-01.jpg" alt="iphone">
                        </div>
                        <h5>Jachten</h5>
                        <h5>Heesen Yachts</h5>
                        <h4>Hoogste bod: € 16.000.000</h4>
                        <p class="time" id="time2"></p>
                    </a>
                    <a href="artikel.php" class="product">
                        <div class="product-img ">
                            <img src="images/artikelen/product15-01.jpg" alt="iphone">
                        </div>
                        <h5>Horloges</h5>
                        <h5>Richard Mille</h5>
                        <h4>Hoogste bod: € 995,00</h4>
                        <p class="time" id="time2"></p>
                    </a>
				</div>
				<div class="arrow-left" onclick="scrollL('recent')">
					<img src="images/r_arrow_purple.png" alt="leftarrow">
					<img src="images/r_arrow_trans.png" alt="leftarrow">
				</div>
				<div class="arrow-right" id="arrow" onclick="scrollR('recent')">
					<img src="images/r_arrow_purple.png" alt="rightarrow">
					<img src="images/r_arrow_trans.png" alt="rightarrow">
				</div>
			</div>
		</div>
	</main>
</div>
<?php include 'includes/footer.php';?>

	<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.2/jquery.min.js"></script>
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.4/js/bootstrap.min.js"></script>
	<script src="js/main.js"></script>
</body>
</html>