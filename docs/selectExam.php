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
		echo "<meta http-equiv=\"refresh\" content=\"1;url=http://211.66.138.51/index.htm\">"; 
	}	
	$selectquery = "SELECT  Exam.Hno,Exam.Hname,Exam.Hdeadline FROM Exam WHERE Hfinal='0'";
        $selectsql = mysqli_query($link, $selectquery);
	$examlist = array();

	while($row = mysqli_fetch_array($selectsql, MYSQLI_NUM)){
		$examlist[] = $row;
	}
	 
	/*if($_POST['examid']){
		$_SESSION['examid']=$_POST['examid'];
		echo "<meta http-equiv=\"refresh\" content=\"1;url=chooseProblem.php\">"; 	
	}*/
	$smarty->assign('examlist', $examlist);
	$smarty->display('selectExam.tpl');

?>















