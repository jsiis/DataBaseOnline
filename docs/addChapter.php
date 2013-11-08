<?php 
	include "connect_MySQL.php";
	require_once('/usr/local/lib/Smarty-3.1.14/libs/Smarty.class.php');
	
	
	$smarty = new Smarty();
	$smarty->setTemplateDir('/var/www/templates/');
	$smarty->setCompileDir('/var/www/templates_c/');
	$smarty->setConfigDir('/var/www/configs/');
	$smarty->setCacheDir('/var/www/cache/');
	
	$selectquery = "SELECT * FROM Chapter";	
	$selectsql = mysqli_query($link, $selectquery);
	$chapterlist = array();
	//mysqli_fetch_all($selectsql, MYSQLI_NUM);
	
	while($row = mysqli_fetch_array($selectsql, MYSQLI_NUM)){
		$chapterlist[] = $row;

	}
	/*
	while(1)
	{
		$row = mysqli_fetch_array($selectsql, MYSQLI_NUM);
		if($row != NULL){
			$chapterlist $row;
			//foreach($row as $key=>$value)
			//	echo "<th>$value</th>";
		}else{
			break;
		}
	}*/
	$smarty->assign('chapterlist', $chapterlist);

	
	if ($_POST['cno'] AND $_POST['cname'])
	{
		$cno = $_POST['cno'];
		$name = $_POST['cname'];
		$insertquery = "INSERT INTO Chapter (Cno, Cname) VALUES ('$cno', '$name')";
		$insertsql = mysqli_query($link, $insertquery);

		//printf("error %s\n", mysqli_error($link));
	
		$err = mysqli_error($link); 
		if ($err)
			echo "error$err";
		else
			echo "<meta http-equiv=\"refresh\" content=\"1;url=addChapter.php\">"; 
	}

	//$flag = 	mysql_affected_rows();
	//echo "\n$flag";
	
	$smarty->display('addChapter.tpl');
?>
