<?php
    session_start();
    include "connect_MySQL.php";
    
    $tempUID = $_SESSION['tempUID'];
//    $_SESSION['teacherID']=$tempUID;
//    $chapterNo=10120081001;
    $chapterNo=$_SESSION["chapterNo"];
  
  /*����ж���*/
    echo "<table border='1'>";
    echo "<form action='add_panduanti.php' method=POST>
          <tr>
          <td>ϰ����</td>
          <td><input type=text name='num'></td>
          </tr>
          ";
    echo "
          <tr>
          <td>��Ŀ</td>
          <td><textarea cols=40 rows=5 name='blank'>���⼰ѡ�����ڴ���д</textarea></td>
          </tr>";
    echo "<tr>
          <td>��</td>
          <td>
          <input type=radio name = 'Choice' value = '��' >��
          <input type=radio name = 'Choice' value = '��' >��
          </td>
          </tr>";   
    echo "<tr><td colspan='2' align='center'><input type=submit name='submit' value='�ύ'><td></tr>
          </form></table>";
    if(isset($_POST["submit"])){
    	$num=$_POST['num'];
      	$blank=$_POST['blank'];
        $Choice=$_POST['Choice'];
        
        include "connect_MySQL.php";
        $b=$chapterNo.$num;
        $a1="select addExercise('$b','$chapterNo','�ж���','$blank','$Choice','�ж�����')";
        $result = mysqli_query($link,$a1);
        $flag = mysqli_fetch_row($result);
        if ($flag[0] == 1) {
	        echo "�����ɹ���2�����ת";		
	        echo"<meta http-equiv=\"refresh\" content=\"1;url=chapter_view_teacher.php\">"; 
	    }
	    else{
		    echo "����ʧ�ܣ�2�����ת";		
		    echo"<meta http-equiv=\"refresh\" content=\"1;url=add_panduanti.php\">"; 
	    }
    }
 ?>