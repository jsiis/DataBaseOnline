<?php
	include "connect_MySQL.php";
	//整理多选题
	$class = 'dx';
	$query = "SELECT `题号`, `题目` FROM `tiku` WHERE `题型` = '$class' ";
	$sql = mysqli_query($link, $query);
	//$result = mysqli_fetch_array($sql, MYSQLI_NUM);	
	while($row = mysqli_fetch_array($sql, MYSQLI_NUM)){
		$query1 = "SELECT * FROM `xuanze` WHERE `题号` = '$row[0]'";
		$sql1 = mysqli_query($link, $query1);
		$CPcontent = $row[1];
		$number = 0;
		$CPanswer = '';
		while($row1 =  mysqli_fetch_array($sql1, MYSQLI_NUM)){
			$number++;
			$CPcontent = $CPcontent."%".$row1[1].$row1[3];
			if($row1[2] == 'T')
				$CPanswer = $CPanswer."%".$row1[1];
		}
		//echo $CPcontent;
		//echo $row[0];
		$query2 = "INSERT INTO `ChooseProblem`(`CPid`, `CPcontent`, `CPanswer`, `CPnumber`, `CPclass`) VALUES ('$row[0]','$CPcontent','$CPanswer','$number','$class')";
		$sql2 = mysqli_query($link, $query2);
		$err = mysqli_error($link); 
		if($err)
		{
			echo "error$err";
		}
	}


?>
