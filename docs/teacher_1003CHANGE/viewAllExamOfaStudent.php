<?php
        include "connect_MySQL.php";
        require 'smarty/libs/Smarty.class.php';
        $smarty = new Smarty;
	session_start();
        $smarty->template_dir = "smarty/templates/templates";
        $smarty->compile_dir = "smarty/templates/templates_c";
        $smarty->config_dir = "smarty/templates/config";
        $smarty->cache_dir = "smarty/templates/cache";

        if ($_POST['snum'])
        {
                $snum = $_POST['snum'];
		$_SESSION['sid']=$snum;
		$selectquery = "SELECT UID,Uname,Ahno,Hname,Ahsubtime,Ahscore FROM User,Exam,ExamAnswerForStudent WHERE Exam.Hno=ExamAnswerForStudent.Ahno AND UID='$snum' AND ExamAnswerForStudent.Asno=User.UID";
                $selectsql = mysqli_query($link, $selectquery);
		$studentinfolist = array();
		while($row = mysqli_fetch_array($selectsql,MYSQLI_NUM)) {
			$studentinfolist[] = $row;
		}
		$smarty->assign('studentinfolist', $studentinfolist);
        }
        $smarty->display('viewAllExamOfaStudent.tpl');

?>
