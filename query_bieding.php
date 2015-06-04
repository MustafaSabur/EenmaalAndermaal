 <?php
session_start();
$session = $_SESSION['loginnaam'];
$input_check = true;

require 'includes/connect.php';	
require 'includes/functions.php';

if(!isset($session))
{
	echo 'U moet eerst inloggen voordat u kan bieden.';
}
else
{
	$bedrag = $_POST['InputBedrag'];
	$gebruiker = $session;
	$voorwerp = $_POST['voorwerpID'];
	$rubriek = $_POST['rubriekID'];
}

$sql = "SELECT verkoper FROM voorwerp WHERE voorwerpnummer = '$voorwerp'";
$result = sqlsrv_query($conn, $sql, null);

while ($row = sqlsrv_fetch_array($result, SQLSRV_FETCH_ASSOC)) {
	if ($row['verkoper'] == $gebruiker) {
		$input_check = false;
		echo 'U mag niet op uw eigen voorwerpen bieden.';
		header('refresh:3; url= artikel.php?id='.$voorwerp.'&rub_nr='.$rubriek);
	}
}

if (!is_numeric($bedrag)) {
	echo 'Het door u opgegeven bedrag is niet geldig.';
	$input_check = false;
	header('refresh:3; url= artikel.php?id='.$voorwerp.'&rub_nr='.$rubriek);
	exit();
}

// var_dump($voorwerp);
// var_dump($bedrag);
// var_dump($gebruiker);

if ($input_check == true) {
    $sql = "INSERT INTO [dbo].[Bod] 
			([voorwerp],
			[bodbedrag],
			[gebruiker]
			)
			values
			($voorwerp,
			$bedrag,
			'$gebruiker')";
	
    $result = sqlsrv_query($conn, $sql, null);
	
	if( ($errors = sqlsrv_errors() ) != null) {
		echo '<h3>Er is iets foutgegaan aan onze kant. Probeer het later opnieuw.</h3>';
		foreach( $errors as $error ) {
            echo "SQLSTATE: ".$error[ 'SQLSTATE']."<br />";
            echo "code: ".$error[ 'code']."<br />";
            echo "message: ".$error[ 'message']."<br />";
        }
	}
    header('refresh:0; url= artikel.php?id='.$voorwerp.'&rub_nr='.$rubriek);
}
?>