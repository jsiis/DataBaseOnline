
<?php
        include "connect_MySQL.php";
        require 'smarty/libs/Smarty.class.php';
        $smarty = new Smarty;
        $smarty->template_dir = "smarty/templates/templates";
        $smarty->compile_dir = "smarty/templates/templates_c";
        $smarty->config_dir = "smarty/templates/config";
        $smarty->cache_dir = "smarty/templates/cache";
        $selectchapterquery = "SELECT * FROM Chapter";
        $selectchaptersql = mysqli_query($link, $selectchapterquery);
        $chapterlist = array();
//        $smarty->assign('chapterlist', $chapterlist);

        while($row = mysqli_fetch_array($selectchaptersql, MYSQLI_NUM)){
                $chapterlist[] = $row;
        }
        $smarty->assign('chapterlist', $chapterlist);
//echo "HELLO";
	if ($_POST['cno']){
	$cno = $_POST['cno'];
	$cno = implode("%",$cno);
//echo "$cno";
//	$cno = explode("%",$_POST['cno']);
        $selectquery = "SELECT UID,Uname,Ahsubtime,Ahscore FROM User,Exam,ExamAnswerForStudent WHERE User.UID=ExamAnswerForStudent.Asno AND Exam.Hno=ExamAnswerForStudent.Ahno AND Hcno='$cno' ORDER BY Ahno,Ahscore DESC";
        $selectsql = mysqli_query($link, $selectquery);
        $scorelist = array();
        while($row = mysqli_fetch_array($selectsql, MYSQLI_NUM)){
        	$scorelist[] = $row;
	//	echo "$row[0]";
	//	echo "<br />";
        	}
        $smarty->assign('scorelist', $scorelist);
        $err = mysqli_error($link);
        if ($err)
        	echo "error$err";
	}
        $smarty->display('viewAllStudentScoreByChapter.tpl');
?>
