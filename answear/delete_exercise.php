<?php
    session_start();
    include "connect_MySQL.php";
//    $tempUID = $_POST['UID'];
//    $_SESSION['teacherID']=$tempUID;
//    $chapterNo=$_POST["chapterNo"];
    $tempUID=$_SESSION['tempUID'];
//    $chapterNo=$_SESSION["chapterNo"];
    $chapterNo=$_SESSION["chapterNo"];
    $b=$_POST['b'];
    
//    echo "<form action='delete_exercise.php' method=POST>
//      	      <td>������Ҫɾ������Ŀ��ţ���λ���֣�</td>
//      	      <td><input type=text name='exerciseNo'></td>
//      	 ";
//    
//    echo "<input type=submit name='submit' value='�ύ'><br/>";
    
//    if(isset($_POST["submit"])){
//    	$exerciseNo=$_POST['exerciseNo'];
    	
    	include "connect_MySQL.php";
 //   	$b=$chapterNo.$exerciseNo;
    	$a="select deleteExercise('$b')";
    	$result = mysqli_query($link,$a);
        $flag = mysqli_fetch_row($result);
 
        if ($flag[0] == 1) {
	    	echo "�����ɹ���2�����ת";
			echo"<meta http-equiv=\"refresh\" content=\"2;url=chapter_view_teacher.php\">"; 		
	    }
	    else{
		    echo "����ʧ�ܣ�2�����ת";
			echo"<meta http-equiv=\"refresh\" content=\"2;url=chapter_view_teacher.php\">"; 
	    }
  //  }