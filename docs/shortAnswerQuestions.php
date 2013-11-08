<?php 
	include "connect_MySQL.php";
	require_once('/usr/local/lib/Smarty-3.1.14/libs/Smarty.class.php');
        session_start();
	
	
        $smarty = new Smarty();
	$smarty->setTemplateDir('/var/www/templates/');
	$smarty->setCompileDir('/var/www/templates_c/');
	$smarty->setConfigDir('/var/www/configs/');
	$smarty->setCacheDir('/var/www/cache/');
  

	$no=$_SESSION['examid'];
	//echo $_SESSION['examid'];
        $selectarray = "SELECT Hnumcs FROM Exam WHERE Hno=$no";
        $selectexamsql = mysqli_query($link, $selectarray);
	//$str1 = array();
        $row = mysqli_fetch_array($selectexamsql, MYSQLI_NUM);
         //echo $row[0]."<br />";
        echo "<br />";
        //print_r (explode("%",$row[0]));
        $str1=explode("%",$row[0]);
        //echo  $str1[0];
        $selectarray1 = "SELECT Hnuma FROM Exam WHERE Hno=$no";
        $selectexamsql1 = mysqli_query($link, $selectarray1); 
        $row1 = mysqli_fetch_array($selectexamsql1, MYSQLI_NUM);
        $selectarray2 = "SELECT Hnumb FROM Exam WHERE Hno=$no";
        $selectexamsql2 = mysqli_query($link, $selectarray2); 
        $row2 = mysqli_fetch_array($selectexamsql2, MYSQLI_NUM);
        $j=$row1[0]+$row2[0]+1;
        $i=0;
        $k=0;
	$simplelist = array();
        $exercisenumber= array();
       while($str1[$i]) 
        { 
            $exercisenumber[$k++]=$j++;
            $selectquery = "SELECT   Cexercise.Ceno,Cexercise.Cstage,Cexercise.Cscore,Cexercise.Cecontent
FROM Cexercise WHERE Cexercise.Ceno=$str1[$i] ";
      
        $selectsql = mysqli_query($link, $selectquery);
	
        while($row = mysqli_fetch_array($selectsql, MYSQLI_NUM))
             {   
                  $simplelist[]=$row;
             }
     
        $i++;
        } 
	
	$hno=$_SESSION['examid'];
	$userid=$_SESSION['uid'];
  	$smarty->assign('userid',$userid);
	$smarty->assign('hno',$hno);
        $smarty->assign('simplelist', $simplelist);
        $smarty->assign('exercisenumber', $exercisenumber);
	$k=0;
	//保存答案
	while($str1[$k])
        {   
           $temp = $str1[$k]."_".$userid."_".$hno;
           if($_POST[$temp])
	      {   
	        $selectarray3 = "SELECT Ceano FROM CexerciseAnswerForstudent WHERE Ceno=$str1[$k] AND Chno=$hno AND Sno=$userid";
                $selectexamsql3 = mysqli_query($link, $selectarray3);
                $row = mysqli_fetch_array($selectexamsql3, MYSQLI_NUM);
                
                     
                if($row[0])
                  { 
                   //echo $row[0];
                   $updatequery="UPDATE CexerciseAnswerForstudent SET Canswer='$_POST[$temp]' WHERE Ceano=$row[0] ";	
	           $updatesql = mysqli_query($link, $updatequery);
                   }  
                
                else
                     {
             $query = "INSERT INTO CexerciseAnswerForstudent    ( Ceano,Ceno,Sno,Chno,Canswer,Cnum) VALUES(NULL,'$str1[$k]','$userid','$hno','$_POST[$temp]','$exercisenumber[$k]') ";
	       $sql = mysqli_query($link, $query);
                      }
	      }  
           
	   $k++;
        }
        //批改  
          $selectarray4= "SELECT Cexercise.Canswer, Cexercise.Cscore, CexerciseAnswerForstudent.Canswer, CexerciseAnswerForstudent.Ceano FROM Cexercise
INNER JOIN CexerciseAnswerForstudent ON Cexercise.Ceno = CexerciseAnswerForstudent.Ceno";
          $selectsql4 = mysqli_query($link, $selectarray4);
	  while ($row = mysqli_fetch_array($selectsql4, MYSQLI_NUM))
           {  

           $str1=$row[0];
           $score=$row[1];
           $str2=$row[2];
           $str3=$row[3];
           //echo $str3;
           if(strcmp($str1,$str2))
            { 
          	$updatearray1="UPDATE CexerciseAnswerForstudent  SET Cscore=0 WHERE Ceano=$str3";
                $updatesql = mysqli_query($link, $updatearray1);
             }
            else
               {
                   $updatearray1="UPDATE CexerciseAnswerForstudent  SET Cscore=$score WHERE Ceano=$str3";
                $updatesql = mysqli_query($link, $updatearray1);
               }
	}
          //算分 
        /* $selectarray1= "SELECT CexerciseAnswerForstudent.Ceno, CexerciseAnswerForstudent.Cscore FROM CexerciseAnswerForstudent where  CexerciseAnswerForstudent.Chno=$hno AND CexerciseAnswerForstudent.Sno=$userid ";
          $selectsql = mysqli_query($link, $selectarray1);
          $tscore=0;
 while ($row = mysqli_fetch_array($selectsql,MYSQLI_NUM))
        {
            $tscore=$tscore+$row[1];
        }           
        //echo $tscore;

      $query = "INSERT INTO ExamAnswerForStudent        ( Ano,Asno,Ahno,Ahscore) VALUES(NULL,'$userid','$hno',           '$tscore') ";
      $sql = mysqli_query($link, $query);*/
	
	$smarty->display('shortAnswerQuestions.tpl');
?>
