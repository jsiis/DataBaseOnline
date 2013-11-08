<?php 
	include "connect_MySQL.php";
	require_once('/usr/local/lib/Smarty-3.1.14/libs/Smarty.class.php');
	session_start();
	$smarty = new Smarty();
	$smarty->setTemplateDir('/var/www/templates/');
	$smarty->setCompileDir('/var/www/templates_c/');
	$smarty->setConfigDir('/var/www/configs/');
	$smarty->setCacheDir('/var/www/cache/');
	
        $uid=$_SESSION['uid'];
	$selectquery = "SELECT * FROM User WHERE UID=$uid";	
	$selectsql = mysqli_query($link, $selectquery);
	$userlist = array();
        while($row = mysqli_fetch_array($selectsql, MYSQLI_NUM)){
		$userlist[] = $row;

	    }
         $smarty->assign('userlist', $userlist);

      
            
         $smarty->display('showSelfInformation.tpl');
            
?>
