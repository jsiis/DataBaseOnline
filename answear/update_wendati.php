<!--ok!-->

<?php
    session_start();
    include "connect_MySQL.php";
    $tempUID = $_SESSION['tempUID'];
//    $_SESSION['teacherID']=$tempUID;
//    $tempUID="20081001";
    $chapterNo=$_SESSION["chapterNo"];
//    $chapterNo='10120081001';
    $b=$_POST['b'];
  
    echo "<table border='1'>";
    echo "<form action='update_wendati.php' method=POST>  
          <input type='hidden' name='b' value='$b'>   
          ";
    
    echo "<tr>
          <td>��Ŀ</td>
          <td><textarea cols=40 rows=5 name='blank'>�������ڴ���д</textarea></td>
          </tr>";
    echo "<tr>
          <td>��</td>
          <td>
          <textarea cols=40 rows=5 name='answer'>�����ڴ���д</textarea>
          </td>
          </tr>";   
    echo "<tr><td colspan='2' align='center'><input type=submit name='submit' value='�ύ'><td></tr>
          </form></table>";
        
    if(isset($_POST["submit"])){
       	$blank=$_POST['blank'];
        $answer=$_POST['answer'];        
 //       $num=$_POST['num'];
 //       $title=$_POST['title'];
        
        include "connect_MySQL.php";
 //       $b = $chapterNo.$num;
        $a="select updateExercise('$b','$blank','$answer','�����','�ش���������')";
        $result = mysqli_query($link,$a);
        $flag = mysqli_fetch_row($result);
        if ($flag[0] == 1) {
	        echo "�����ɹ���2�����ת";		
	        echo"<meta http-equiv=\"refresh\" content=\"1;url=chapter_view_teacher.php\">"; 
	    }
	    else{
	        echo "����ʧ�ܣ�2�����ת";		
	        echo"<meta http-equiv=\"refresh\" content=\"1;url=chapter_view_teacher.php\">"; 
	    }
    }
 //   }
 ?>