<?php
// Pconnect *********
require 'connect.php';

// function connect() {
//     return new PDO('mysql:host=localhost;dbname=autocomplet', 'root', '', array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION, PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8"));
// }
// $pdo = connect();




// $query = $pdo->prepare($sql);
// $query->bindParam(':keyword', $keyword, PDO::PARAM_STR);
// $query->execute();


// $list = $query->fetchAll();



$keyword = '%'.$_POST['keyword'].'%';
$sql = "SELECT * FROM Voorwerp WHERE titel LIKE (:keyword) ORDER BY titel LIMIT 0, 10";
$result = sqlsrv_query($conn, $sql, null);

$row = sqlsrv_fetch_array($result, SQLSRV_FETCH_ASSOC);

foreach ($row as $rs) {
	// put in bold the written text
	$v_titel = str_replace($_POST['keyword'], '<b>'.$_POST['keyword'].'</b>', $rs['v_titel']);
	// add new option
    echo '<li onclick="set_item(\''.str_replace("'", "\'", $rs['v_titel']).'\')">'.$v_titel.'</li>';
}
?>