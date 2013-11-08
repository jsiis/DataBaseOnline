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

//查看所有考试的信息
  $selectquery = "SELECT Ahno,Hname,Ahscore,Hfinal FROM ExamAnswerForStudent, Exam WHERE Asno=$uid AND Ahno=Hno";	
	$selectsql = mysqli_query($link, $selectquery);
	$examlist = array();
        while($row = mysqli_fetch_array($selectsql, MYSQLI_NUM)){
		$examlist[] = $row;

	    }
         $smarty->assign('examlist', $examlist);

       $smarty->display('lookOverAnswer.tpl');

?>
