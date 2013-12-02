<?php 
	include "connect_MySQL.php";
	require_once('/usr/local/lib/Smarty-3.1.14/libs/Smarty.class.php');
        session_start();
	
	
        $smarty = new Smarty();
	$smarty->setTemplateDir('/var/www/templates/');
	$smarty->setCompileDir('/var/www/templates_c/');
	$smarty->setConfigDir('/var/www/configs/');
	$smarty->setCacheDir('/var/www/cache/');
  	
        //$no=$_GET['$examid'];
        if($_GET['$examid'])
              $_SESSION['examid']=$_GET['$examid'];
        $no=$_SESSION['examid'];
		$userid=$_SESSION['uid'];
	//判断考试是否已经回答过一次
		$judgequery = "SELECT * FROM ExamAnswerForStudent,Exam WHERE Ahno='$no' AND Asno='$userid' AND Hno=Ahno AND Hfinal='1'";
		$judgesql = mysqli_query($link, $judgequery);
		$judgerow = mysqli_fetch_array($judgesql, MYSQLI_NUM);
		if($judgerow[0])
		{
			echo '<script type="text/javascript">
				alert("已参加过本次考试");
				</script>';	
			echo "<meta http-equiv=\"refresh\" content=\"1;url=selectFinalExam.php\">"; 
		}

	//echo $no;
        $selectarray1 = "SELECT Hnumas FROM Exam WHERE Hno=$no";
        $selectexamsql = mysqli_query($link, $selectarray1);
	//$str1 = array();
        $row = mysqli_fetch_array($selectexamsql, MYSQLI_NUM);
         //echo $row[0]."<br />";
        echo "<br />";
        //print_r (explode("%",$row[0]));
        $str1=explode("%",$row[0]);
        //echo  $str1[0]; 
        
        $i=0;
        $j=0;
        $k=1;
	$chooselist = array();
        $exercisenumber=array();
       while($str1[$i]) 
        {   
           
            $exercisenumber[$j++]=$k++;
            $selectquery = "SELECT Cexercise.Ceno, Cexercise.Cstage,Cexercise.Cscore,ChooseProblem.CPcontent
FROM Cexercise,ChooseProblem WHERE Cexercise.Ceno='$str1[$i]' AND Cexercise.Ceno=ChooseProblem.CPid ";
      
        $selectsql = mysqli_query($link, $selectquery);
	
        while($row = mysqli_fetch_array($selectsql, MYSQLI_NUM))
             {   
                  $chooselist[]=str_replace("%","<br/>",$row);
                   
             }
     
        $i++;
        } 

	
	$hno=$_SESSION['examid'];
	$userid=$_SESSION['uid'];
  	$smarty->assign('userid',$userid);
	$smarty->assign('hno',$hno);
        $smarty->assign('chooselist', $chooselist);
        $smarty->assign('exercisenumber', $exercisenumber);
	$k=0;
	
	//保存答案
        if($_POST['submit']=='保存')
         {
	     while($str1[$k])
                {  
           
                     $temp = $str1[$k]."_".$userid."_".$hno;
          
                   if($_POST[$temp])
	           { 
                //echo $_POST[$temp];
	        $selectarray2 = "SELECT Ceano FROM CexerciseAnswerForstudent WHERE Ceno='$str1[$k]' AND Chno=$hno AND Sno=$userid";
                $selectexamsql2 = mysqli_query($link, $selectarray2);
                $row = mysqli_fetch_array($selectexamsql2, MYSQLI_NUM);
                
                     
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
          $selectarray3= "SELECT ChooseProblem.CPanswer, Cexercise.Cscore, CexerciseAnswerForstudent.Canswer, CexerciseAnswerForstudent.Ceano FROM ChooseProblem,Cexercise,
 CexerciseAnswerForstudent WHERE Cexercise.Ceno = CexerciseAnswerForstudent.Ceno AND Cexercise.Ceno =ChooseProblem.CPid AND CexerciseAnswerForstudent.Chno=$no AND CexerciseAnswerForstudent.Sno=$userid AND Cexercise.Cename='xz'";
          $selectsql2 = mysqli_query($link, $selectarray3);
	//$begtime = time();
           
          $newscore=array();
          $updateid=array();
          $temp=0; 
	  while ($row = mysqli_fetch_array($selectsql2, MYSQLI_NUM))
		{  

			$str1=$row[0];
			$score=$row[1];
			$str2=$row[2];
			$str3=$row[3];
			//echo $str3;
                        $updateid[$temp]=$str3;
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
                                $newscore[$temp]=$score*2;
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
       
	     //$endtime = time();
        }    //if
			//echo $endtime-$begtime;
			//echo "</br>";


        $smarty->display('chooseProblem.tpl');

?>
          





