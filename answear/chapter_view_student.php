<?php
    session_start();
	include "connect_MySQL.php";
//	$tempUID = $_POST['UID'];
//    $_SESSION['studentID']=$tempUID;
//    $Tno="SELECT Tno from user,student where user.UID=student.Sno";
    error_reporting(0);
    $tempUID=$_SESSION['tempUID'];
    if($_POST['chapterNo']){
		$_SESSION['chapterNo']=$_POST['chapterNo'];
	}
    $chapterNo=$_SESSION['chapterNo'];
?>

<html>
<head>
  <title>�½���ϰ���</title>
</head>
<body>
  <div align="right">
    <a href='menu_left_chapter_choose_student.php'>����</a><br/>
  </div>
  <div  align="center">
  <font size='6' face='��������'>������ϰ���</font>
  <br/><br/><br/><br/><br/><br/><br/><br/><br/><br/>
  <?php
    include "connect_MySQL.php";
    $sql0="call showTeaOfStu('$tempUID')";
    $result0 = mysqli_query($link,$sql0);
    $flag0 = mysqli_fetch_row($result0);
    $Tno=$flag0[0];
    
    
    include "connect_MySQL.php";
    $sql1="select isChapterPublished('$chapterNo')";
    $result = mysqli_query($link,$sql1);
    $flag = mysqli_fetch_row($result);
    
    echo"$flag[0]";
    
    if($flag[0]==0){
    	 echo"     </table>
    	      
    	      <table border='1'>
 
    	     ";
    	
    	echo "<table border='1'>
		<tr>
			<th>ϰ����</th>
			<th>ϰ����</th>
			<th>����</th>
			<th>��Ŀ����</th>
			<th>�ο���</th>
		</tr>";
      	$sql="call showTeaPublishedExerciseInfo('$Tno','$chapterNo');";
        $result=mysqli_query($link,$sql);
        while(1){
        	$row = mysqli_fetch_array($result, MYSQLI_NUM);
         	if($row != NULL)
		    {
			    echo "<tr>";
			    Foreach($row as $key=>$value){
			       //if($key!=1 && $key!=8)
	//		            echo "<tr>";
				    	echo "<th>$value</th>";
				    	
		    	}
		    	

		        echo "</tr>";
		        }
		        else  
		       	   break;
		   }
    
    }//end if
    
    else{
    	include "connect_MySQL.php";
        $sql2="select isChapterFinsh('$chapterNo','$tempUID')";
        $result2 = mysqli_query($link,$sql2);
        $flag2 = mysqli_fetch_row($result2);
        
        echo"$flag2[0]";
    
       if($flag2[0]==1){
        	echo "<table border='1'>
		    <tr>
			<th>��Ŀ</th>
			<th>ѧ����</th>
			<th>�ο���</th>
			<th>����</th>
	    	</tr>";
        	$sql="call showStuExerciseAnswer('$tempUID','$chapterNo');";
            $result=mysqli_query($link,$sql);
            while(1){
            	$row = mysqli_fetch_array($result, MYSQLI_NUM);
             	if($row != NULL)
	    	    {
	    		    echo "<tr>";
		    	    Foreach($row as $key=>$value){
			       //if($key!=1 && $key!=8)
	//		            echo "<tr>";
				    	echo "<th>$value[3]$value[4]$value[5]$value[6]</th>";
		        	}
		        	echo "</tr>";
		        }
		        else  
		       	   break;
            }
		   echo "</table>";
		   
		   echo "<br/><br/><br/><br/><br/><br/>
		         <div  align='center'>
		         <font size='4' face='��������'>��������</font>";
		   
		   $sql0="call showChapterComment('$chapterNo',$tempUID')";
		   $result0 = mysqli_query($link,$sql0);
		   $flag0 = mysqli_fetch_row($result0);
		   $Comment=$flag0[0];
		   
		   echo "
		         <table align='center'>
		         <tr><td>
		           $Comment;
		           </td></tr>
		         ";
		   
       }//endif
       
       
       
       else{
           echo "<font  face='��������'>����δ�μӱ��²���</font>
                 <br/><br/><br/><br/><br/><br/><br/>";
           echo "<a href='exercise_take_student.php'><font align='center'>���²���</font></a><br/>";
       }
    }
 ?>
  </div>  
</body>
</html>