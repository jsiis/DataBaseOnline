<!--ok!-->

<?php
    session_start();
    include "connect_MySQL.php";
    $tempUID = $_SESSION['tempUID'];
    error_reporting(0);
    //$_SESSION['teacherID']=$tempUID;
 //   $tempUID='20081001';
        echo "<a href='menu_left_chapter_choose_teacher.php'>����</a><br/>";
    echo "
          <form action='add_chapter.php' method=POST>
          <tr>
      	  <td>��������Ҫ���ӵ��½ڱ��</td>
      	  <td><input type=text name='p'></td>
      	  </tr>
      	  <tr>
      	  <td>��������Ҫ���ӵ��½���</td>
      	  <td><input type=text name='q'></td>
      	  </tr>
      	 ";
    
    echo "<input type=submit name='submita' value='�ύ'><br/></form>";
    if(isset($_POST["submita"])){
    	$pchapterNo=$_POST['p'];
    	$chapterName=$_POST['q'];
    	$n='1';
    	$chapterNo=$n.$pchapterNo.$tempUID;
 //   	echo"$chapterNo";
 //   	echo"$chapterName";
    	include "connect_MySQL.php";
    	$a="select addChapter($chapterNo,$tempUID,'ϰ��','$chapterName')";
        $result = mysqli_query($link,$a);
        $flag = mysqli_fetch_row($result);
            if ($flag[0] == 1) {
		        echo "�����ɹ���2�����ת";		
		        echo"<meta http-equiv=\"refresh\" content=\"1;url=menu_left_chapter_choose_teacher.php\">"; 
		    }
	        else{
		        echo "����ʧ�ܣ�2�����ת";		
	            echo"<meta http-equiv=\"refresh\" content=\"1;url=add_chapter.php\">"; 
	        }
    }