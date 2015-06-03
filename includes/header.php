<div class="container-fluid">
	<header class="row" id="header">
		<div class=" col-xs-12 col-sm-4 col-lg-2 logo" id="logo">
			<a href="index.php">
				<img src="images/logo.png" alt="logo">
			</a>
		</div>
		<div class="hidden-xs hidden-sm hidden-md col-lg-2 slogan">
			<h5>Altijd het Een en Ander te bieden!</h5>
		</div>
		<div class="hidden-xs hidden-sm col-md-2 col-lg-1">
			<div class="header-text">
				<a href="rubriek.php&#63rub_nr=-1">
					Meer dan<h4><?= getAantalArtikelenIn($root, 'floor'); ?>+</h4>artikelen
				</a>
			</div>
		</div>
		<div class="hidden-xs hidden-sm hidden-md col-lg-2 keurmerk" id="eerlijkonlineveilen">
			<a href="VeilingSiteVanHetJaar.php">
				<img src="images/eerlijkonlineveilen.png" alt="keurmerk">
			</a>
		</div>
		<div class=" col-xs-12 col-sm-8 col-md-6 col-lg-5 login" id="login">
			<?php require 'login.php';?>
		</div>
	</header>
</div>