<?php
// Pconnect *********
require 'connect.php';


$keyword = '%'.$_POST['keyword'].'%';

$sql = "SELECT TOP 10 titel FROM Voorwerp WHERE titel LIKE '$keyword' ORDER BY titel";
$result = sqlsrv_query($conn, $sql, null);

while($row = sqlsrv_fetch_array($result, SQLSRV_FETCH_ASSOC)){
	// put in bold the written text
	$v_titel = str_ireplace($_POST['keyword'], '<b>'.$_POST['keyword'].'</b>', $row['titel']);
	// add new option
    echo '<li onclick="set_item(\''.str_replace("'", "\'", $row['titel']).'\')">'.$v_titel.'</li>';

}

require 'closedb.php';


?>