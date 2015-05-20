<?php
session_start();
$session = $_SESSION['loginnaam'];

if(!file_exists('images/artikelen/'.$session.'/')){
	mkdir('images/artikelen/'.$session.'/', 0777, true);
}
else {
	echo 'Map bestaat al.';
}
?>