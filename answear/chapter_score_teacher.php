<?php
//	include "indexTeacher.php" ;
    session_start();
	include "connect_MySQL.php";
	echo'<table border="1" align="center">
	<COL width = "150"><COL width = "150" ><COL width = "150" ><COL width = "150" ><COL width = "150" ><COL width = "150" ></COL>
	<tr>
		<th>ѧ��</th>
		<th>����</th>
		<th>�͹���÷�</th>
		<th>������÷�</th>
		<th>����������</th>
		<th>����</th>
	</tr>';
//	$Cno = '10120081001' ;
//	$Tno = '20081001' ;	
	$Cno = $_SESSION['chapterNo'];	
	$Tno = $_SESSION['tempUID'];
	
	 echo "<a href='chapter_view_teacher.php'>����</a><br/>";

//	include "connectMySql.php";
	//produce name?
	include "connect_MySQL.php";
	$sql1 = mysqli_query($link, "call showMark('$Tno','$Cno');");
	for(;;)
	{
		$row = mysqli_fetch_array($sql1, MYSQLI_NUM);
		if($row == NULL) break ;
		echo "<tr>";	
		for( $j = 0 ; $j < 4 ; $j++ )
		{
			echo "<th>$row[$j]</th>";
		}
	//	if ( $row[3] == NULL )
	//	{
		echo '
			<th>
			<form action="mark_CA.php" method="post" >
				<input name="Sno" type="hidden" value="'.$row[0].'">
				<input name="Tno" type="hidden" value="'.$Tno.'">
				<input name="Cno" type="hidden" value="'.$Cno.'">
				<input type="submit" value="����" name="change" size = "15" />
			</form>
			</th>
		' ;
		echo '
			<th>
			<form action="changeComment.php" method="post" >
				<input name="Sno" type="hidden" value="'.$row[0].'">
				<input name="Tno" type="hidden" value="'.$Tno.'">
				<input name="Cno" type="hidden" value="'.$Cno.'">
				<input type="submit" value="�޸�" name="add" size = "15" />
			</form>
			</th>
		' ;		
	//	}
		echo "</tr>";			
	}
	mysqli_free_result($sql1);
?>



