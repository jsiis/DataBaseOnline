<form action = 'showTopTen.php' method = post>
<input type = submit name=score value="����������">
<input type = submit name=time value="��ʱ������">
</form>
<?php 
	session_start();
	error_reporting(0);
	include "connect_MySQL.php";
//	$chapterNo = '10120081001';
    if($_POST['top']){
		$_SESSION['top']=$_POST['top'];
	}

    echo "<a href='menu_left_chapter_choose_student.php'>����</a><br/>";
    $chapterNo = $_SESSION['top'];
	if($_POST['score']){
		$mode = '0';
		//echo"<meta http-equiv=\"refresh\" content=\"1;url=showTopTen.php\">"; 
	}
	if($_POST['time']){
		$mode = '1';
		//echo"<meta http-equiv=\"refresh\" content=\"1;url=showTopTen.php\">"; 
	}
	echo "<table>
		<tr>
			<th>����</th>
			<th>�ɼ�</th>
			<th>�ύʱ��</th>
		</tr>";
	$query = "call showTop10($chapterNo,$mode)";
	$sql1 = mysqli_query($link,$query);
	while(1){
		$row = mysqli_fetch_array($sql1, MYSQLI_NUM);
		if($row != NULL)
		{
			echo "<tr>";
			Foreach($row as $key=>$value){
				//if($key!=1 && $key!=8)
					echo "<th>$value</th>";
			}
		echo "</tr>";
		}else{
			break;
		}		
	}
	echo "</table>";
?>
