<?php
	include "connect_MySQL.php";
	session_start();
	unset($_SESSION['uid']);
	
	
	echo "<meta http-equiv=\"refresh\" content=\"1;url= http://211.66.138.51/index.htm\">";
	exit;
	session_destory();
?>
