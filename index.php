<!DOCTYPE html>
<html lang="nl">
<head>
	<title>Eenmaal Andermaal</title>
	<meta charset="utf-8">
  	<meta name="viewport" content="width=device-width, initial-scale=1">
  	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.4/css/bootstrap.min.css">
 	<link rel="stylesheet" href="css/custom.css">
    <link rel="stylesheet" href="css/product-box.css">

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.2/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.4/js/bootstrap.min.js"></script>
    <script src="js/main.js"></script>

    <?php include 'includes/favicon.html';?>

    <?php require 'includes/functions.php'; ?>
</head>

<body>

<?php require 'includes/header.php';?>
<?php require 'includes/zoekbalk.php';?>
<div class="container-fluid">
	<main class= "row">
		<div class="content">
        <?php 
            printProductRow('l-minute'); 
            printProductRow('populair');
            printProductRow('recent');
        ?>
		</div>
	</main>
</div>

<?php include 'includes/footer.php';?>
<?php require 'includes/nav-rubriek.php';?>


<script type="text/javascript">

    var counterIds = <?php echo json_encode($counterIds); ?>;
    var dates = <?php echo json_encode($counterDates); ?>;

    for(var i=0;i<counterIds.length;i++){
        CountDownTimer(dates[i], counterIds[i]);
    }

 </script>

</body>
</html>