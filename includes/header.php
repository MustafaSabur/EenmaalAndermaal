<div class="container-fluid">
	<header class="row" id="header">
		<div class="logo col-xs-12 col-sm-2 col-sm-push-0" id="logo"><a href="index.php"><img src="images/logo.png" alt="logo"></a></div>
		<div class="col-xs-12 col-sm-3 col-sm-push-0"><br><h4>Altijd het Een en Ander te bieden!</h4></div>
		<div class="header-text col-sm-1 hidden-sm hidden-xs"><a href="rubriek.php&#63rub_nr=-1">Meer dan<h4><?= getAantalArtikelenIn($root, 'floor'); ?>+</h4>artikelen</a></div>
		<div class="keurmerk col-md-2 hidden-sm hidden-xs" id="eerlijkonlineveilen"><a href="VeilingSiteVanHetJaar.php"><img src="images/eerlijkonlineveilen.png" alt="keurmerk"></a></div>
		<div class="login col-xs-12 col-sm-6 col-md-4" id="login"><?php require 'login.php';?></div>
	</header>
</div>