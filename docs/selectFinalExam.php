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
	$isctquery = "SELECT * FROM Student WHERE Sno=$uid";
	$isctsql = mysqli_query($link, $isctquery);
	$isctrow = mysqli_fetch_array($isctsql, MYSQLI_NUM);
	if($isctrow[1] == NULL){
		echo '<script type="text/javascript">
			alert("超时，请重新登录！");
		</script>';	
		echo "<meta http-equiv=\"refresh\" content=\"1;url=http://localhost/index.htm\">"; 
	}	
	$selectquery = "SELECT  Exam.Hno,Exam.Hname,Exam.Hdeadline FROM Exam WHERE Hfinal='1'";
        $selectsql = mysqli_query($link, $selectquery);
	$examlist = array();

	while($row = mysqli_fetch_array($selectsql, MYSQLI_NUM)){
		$examlist[] = $row;
	}
	 

	$smarty->assign('examlist', $examlist);
	$smarty->display('selectFinalExam.tpl');

?>















