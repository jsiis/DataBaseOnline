<?php
  session_start();
  
  $tempUID = $_SESSION['UID'];
  $_SESSION['teacherID']=$tempUID;
  $chapterNo=$_SESSION["chapterNo"];
  include "connect_MySQL.php";
  
  $sql="select distinct Cname from chapter where Cno='$chapterNo'";
  $result = mysqli_query($link,$sql);
  $row = mysqli_fetch_row($result);

?>
<html>
<head>
  <title><?php echo"$row[0]"?>   No.<?php echo"$tempUID"?>��ʦ����</title>
</head>
<body>
  <table border='1'>
    <caption><?php echo"$row[0]"?>   No.<?php echo"$tempUID"?>��ʦ����</caption>
    <tr align='center'>
      <td>����</td>
      <td>����</td>
    </tr>
    <tr align='center'>
      <td>ѡ����</td>
      <td><a href="add_xuanzeti.php">���</a>/<a href="update_xuanzeti.php">�޸�</a></td>
    </tr>
    <tr align='center'>
      <td>�ж���</td>
      <td><a href="add_panduanti.php">���</a>/<a href="update_panduanti.php">�޸�</a></td>
    </tr>
    <tr align='center'>
      <td>�����</td>
      <td><a href="add_tiankongti.php">���</a>/<a href="update_tiankongti.php">�޸�</a></td>
    </tr>
    <tr align='center'>
      <td>�ʴ���</td>
      <td><a href="add_wendati.php">���</a>/<a href="update_wendati.php">�޸�</a></td>
    </tr>
  </table>
  <a href="delete_exercise.php">ɾ����Ŀ</a><br/>
  <?php
    echo "<form action='tests_make_chapter_teacher.php' method='post'>
          <tr>
          <td>��������</td>
          <td><input type=text name='deadline'></td>
          <td>��ֹ����</td>
          <td><input type=text name='releasetime'></td>
          <tr><td colspan='2' align='center'><input type=submit name='submit' value='�����½�'><td></tr>
          </form>";
    if(isset($_POST["submit"])){
    	$deadline=$_POST['deadline'];
    	$releasetime=$_POST['releasetime'];
    	$sql="select publishChapter('$chapterNo','$deadline','$releasetime')";
    	$result = mysqli_query($link,$sql);
        $flag = mysqli_fetch_row($result);
        if ($flag[0] == 1) {
        echo "�����ɹ���2�����ת";		
        echo"<meta http-equiv=\"refresh\" content=\"1;url=chapter_view_teacher.php\">"; 
        }
	    else{
	        echo "����ʧ�ܣ�2�����ת";		
	        echo"<meta http-equiv=\"refresh\" content=\"1;url=tests_make_chapter_teacher.php\">"; 
        }
    }
  ?>
</body>
</html>