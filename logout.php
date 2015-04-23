<?php  
    session_start();  
		unset($_SESSION['loginnaam']);
		session_destroy();
	echo 'U bent uitgelogd.';
	header("refresh:2;url=index.php");
?> 