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
        $selectarray= "SELECT Hnumcs FROM Exam WHERE Hno=$no";
        $selectexamsql = mysqli_query($link, $selectarray);
	//$str1 = array();
        $row = mysqli_fetch_array($selectexamsql, MYSQLI_NUM);
         //echo $row[0]."<br />";
        echo "<br />";
        //print_r (explode("%",$row[0]));
        $str1=explode("%",$row[0]);
        $selectarray1 = "SELECT Hnuma,Hnumb FROM Exam WHERE Hno=$no";
        $selectexamsql1 = mysqli_query($link, $selectarray1); 
        $row1 = mysqli_fetch_array($selectexamsql1, MYSQLI_NUM);
        $j=0;
        $i=0;
        $k=$row1[0]+$row1[1];
        $k=$k+1;
	$blanklist = array();
        $exercisenumber=array();
       while($str1[$i]) 
        {   
            $exercisenumber[$j++]=$k++;
            $selectquery = "SELECT Cexercise.Ceno,  Cexercise.Cstage, Cexercise.Cscore, FillProblem.FPcontent, FPnumber
FROM Cexercise,FillProblem WHERE Cexercise.Ceno='$str1[$i]' AND Cexercise.Ceno=FillProblem.FPid ";
      
        $selectsql = mysqli_query($link, $selectquery);
	
        while($row2 = mysqli_fetch_array($selectsql, MYSQLI_NUM))
             {   
                  $blanklist[]=$row2;
             }
     
        $i++;
        } 
	
	$hno=$_SESSION['examid'];
	$userid=$_SESSION['uid'];
  	$smarty->assign('userid',$userid);
	$smarty->assign('hno',$hno);
        $smarty->assign('blanklist', $blanklist);
        $smarty->assign('exercisenumber', $exercisenumber);
	$k=0;
	//保存答案
        if($_POST['submit']=='保存')
           {
	       while($str1[$k])
                {   
		     $fillanswer="";
		     $flag=0;
		     for($i=0;$i<$blanklist[$k][4];$i++)
		      {
			$temp = $str1[$k]."_".$userid."_".$hno."_".$i;
			if($_POST[$temp])
			{
				$fillanswer=$fillanswer."%".$_POST[$temp];
				$flag=1;
			}
		      }

       //$temp = $str1[$k]."_".$userid."_".$hno;
       if($flag==1)
		{   
			$selectarray2 = "SELECT Ceano FROM CexerciseAnswerForstudent WHERE Ceno='$str1[$k]' AND Chno=$hno AND Sno=$userid";
			$selectexamsql2 = mysqli_query($link, $selectarray2);
			$row = mysqli_fetch_array($selectexamsql2, MYSQLI_NUM);
		
				 
			if($row[0])
			{ 
			   //echo $row[0];
				$updatequery="UPDATE CexerciseAnswerForstudent SET Canswer='$fillanswer' WHERE Ceano=$row[0] ";	
				$updatesql = mysqli_query($link, $updatequery);
			}		
			else
			{
				 $query = "INSERT INTO CexerciseAnswerForstudent    ( Ceano,Ceno,Sno,Chno,Canswer,Cnum) VALUES(NULL,'$str1[$k]','$userid','$hno','$fillanswer', '$exercisenumber[$k]') ";
				$sql = mysqli_query($link, $query);
			}
		} 
       
  		$k++;
    }
        //批改  
          $selectarray3= "SELECT FillProblem.FPanswer, Cexercise.Cscore, CexerciseAnswerForstudent.Canswer, CexerciseAnswerForstudent.Ceano FROM FillProblem,Cexercise
,CexerciseAnswerForstudent WHERE Cexercise.Ceno = CexerciseAnswerForstudent.Ceno AND  FillProblem.FPid=Cexercise.Ceno AND CexerciseAnswerForstudent.Chno=$no AND CexerciseAnswerForstudent.Sno=$userid AND Cexercise.Cename='tk' ";
          $selectsql3 = mysqli_query($link, $selectarray3);
          
          $newscore=array();
          $updateid=array();
          $temp=0; 
	  while ($row = mysqli_fetch_array($selectsql3, MYSQLI_NUM))
           {  

           $str1=$row[0];
           $score=$row[1];
           $str2=$row[2];
           $str3=$row[3];
           $updateid[$temp]=$str3;
           //echo $str3;
           if(strcmp($str1,$str2))
            { 
          	//$updatearray1="UPDATE CexerciseAnswerForstudent  SET Cscore=0 WHERE Ceano=$str3";
                //$updatesql = mysqli_query($link, $updatearray1);
                $newscore[$temp]=0;
             }
            else
               {
                   //$updatearray1="UPDATE CexerciseAnswerForstudent  SET Cscore=$score WHERE Ceano=$str3";
                   //$updatesql = mysqli_query($link, $updatearray1);
                   $newscore[$temp]=$score;
               }
            $temp++;
	 }//while
         //批量更新
              $updatearr="INSERT INTO CexerciseAnswerForstudent(Ceano,Cscore) VALUES";
              $i=0;
              for($i=0;$i<$temp-1;$i++)
                  {
                       $updatearr .= sprintf("($updateid[$i],$newscore[$i]),");
                  }
               $updatearr .= sprintf("($updateid[$i],$newscore[$i])");
               $updatearr .= sprintf("ON DUPLICATE KEY UPDATE Cscore=VALUES (Cscore);");
               $updatesql = mysqli_query($link, $updatearr);
   
    }//if
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
          
      $smarty->display('fillInTheBlank.tpl');
?>
