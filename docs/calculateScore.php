<?php 
	include "connect_MySQL.php";
	require_once('/usr/local/lib/Smarty-3.1.14/libs/Smarty.class.php');
        session_start();
	
	
        $smarty = new Smarty();
	$smarty->setTemplateDir('/var/www/templates/');
	$smarty->setCompileDir('/var/www/templates_c/');
	$smarty->setConfigDir('/var/www/configs/');
	$smarty->setCacheDir('/var/www/cache/');
 
	$hno=$_SESSION['examid'];
	$userid=$_SESSION['uid'];
  
          //算分 
        $selectarray1= "SELECT CexerciseAnswerForstudent.Ceno, CexerciseAnswerForstudent.Cscore FROM CexerciseAnswerForstudent where  CexerciseAnswerForstudent.Chno=$hno AND CexerciseAnswerForstudent.Sno=$userid ";
          $selectsql = mysqli_query($link, $selectarray1);
          $tscore=0;
 while ($row = mysqli_fetch_array($selectsql,MYSQLI_NUM))
        {
            $tscore=$tscore+$row[1];
        }           
        //echo $tscore;

       $selectarray1= "SELECT Ano FROM ExamAnswerForStudent where  Ahno=$hno AND Asno=$userid ";
       $selectsql = mysqli_query($link, $selectarray1);
       $row = mysqli_fetch_array($selectsql,MYSQLI_NUM);
		
       $subdate = date("Y-m-d",time());
       //echo $subdate;	
       if($row[0])
                  { 
                   //echo $row[0];
                   $updatequery="UPDATE ExamAnswerForStudent SET Ahscore=$tscore,Ahsubtime='$subdate' WHERE Ano=$row[0] ";	
	           $updatesql = mysqli_query($link, $updatequery);
                   }  
       else
          {  
              $query = "INSERT INTO ExamAnswerForStudent ( Ano,Asno,Ahsubtime,Ahno,Ahscore) VALUES(NULL,'$userid','$subdate','$hno', '$tscore') ";
              $sql = mysqli_query($link, $query);

           }
	
        echo "<meta http-equiv=\"refresh\" content=\"1;url=showSelfInformation.php\">"; 	
        $smarty->display('calculateScore.tpl');

?>
          
