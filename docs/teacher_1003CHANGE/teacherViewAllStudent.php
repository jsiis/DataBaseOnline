<?php
        include "connect_MySQL.php";
        require 'smarty/libs/Smarty.class.php';
	session_start();
        $smarty = new Smarty;
        $smarty->template_dir = "smarty/templates/templates";
        $smarty->compile_dir = "smarty/templates/templates_c";
        $smarty->config_dir = "smarty/templates/config";
        $smarty->cache_dir = "smarty/templates/cache";

//        if ($_POST['tno'])
//        {
                $num = $_SESSION['uid'];
//                $insertquery = "INSERT INTO Knowledge (Kno, Kname) VALUES (NULL, '$name')";
//                $insertsql = mysqli_query($link, $insertquery);
		$selectquery = "SELECT Sno,Uname FROM Student,User WHERE Student.Sno=User.UID AND Student.Stno='$num'";
		$selectsql = mysqli_query($link, $selectquery);
		$studentlist = array();
		while($row = mysqli_fetch_array($selectsql, MYSQLI_NUM)){
		        $studentlist[] = $row;
		 }
    		$smarty->assign('studentlist', $studentlist);
                $err = mysqli_error($link);
                if ($err)
                        echo "error$err";
         //       else
       //                 echo "<meta http-equiv=\"refresh\" content=\"1;url=addKnowledge.php\">";
//        }
        $smarty->display('teacherViewAllStudent.tpl');
?>

