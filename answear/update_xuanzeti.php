<!--OK!-->

<?php
    session_start();
    include "connect_MySQL.php";
    $tempUID = $_SESSION['tempUID'];
    $_SESSION['teacherID']=$tempUID;
    $chapterNo=$_SESSION["chapterNo"];
//    $chapterNo='10120081001';
//    $tempUID="20081001";
    $b=$_POST['b'];
    
    echo "$b";
  
  echo "<table border='1'>";
    echo "<form action='update_xuanzeti.php' method=POST>
          <input type='hidden' name='b' value='$b'>
          ";
    
    echo "<td>��Ŀ</td>
          <td><textarea cols=40 rows=5 name='blank'>�������ڴ���д</textarea></td>
          </tr>";
    echo "<tr>
          <td>��</td>
          <td>
          <input type=radio name = 'Choice' value = 'A' >A
          <input type=radio name = 'Choice' value = 'B' >B
          <input type=radio name = 'Choice' value = 'C' >C
          <input type=radio name = 'Choice' value = 'D' >D
          </td>
          </tr>";   
    echo "<tr><td colspan='2' align='center'><input type=submit name='submit' value='�ύ'><td></tr>
          </form></table>";
        if(isset($_POST["submit"])){
        	$blank=$_POST['blank'];
            $Choice=$_POST['Choice'];
 //           $title=$_POST['title'];
 //           $num=$_POST['num'];
            
  //          $b = $chapterNo.$num;
            $a="select updateExercise('$b','$blank','$Choice','ѡ����','ѡ����ȷ��ѡ��')";
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