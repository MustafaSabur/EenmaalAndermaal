<div class="container-fluid">
	<header class="row" id="header">
		<div class="logo col-xs-12 col-sm-2 col-sm-push-0" id="logo"><a href="index.php"><img src="images/logo.png" alt="logo"></a></div>
		<div class="col-xs-12 col-sm-3 col-sm-push-0"><h6>Altijd het Een en Ander te bieden!</h6></div>
		<div class="header-text col-sm-1 hidden-sm hidden-xs">Meer dan<h4><?= getAantalArtikelenIn($root, 'floor'); ?>+</h4>artikelen</div>
		<div class="keurmerk col-md-2 hidden-sm hidden-xs" id="eerlijkonlineveilen"><img src="images/eerlijkonlineveilen.png" alt="keurmerk"></div>
		<div class="login col-xs-12 col-sm-6 col-md-4" id="login"><?php require 'login.php';?></div>
	</header>
</div>