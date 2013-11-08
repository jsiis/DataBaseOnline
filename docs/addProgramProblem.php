<?php 
	include "connect_MySQL.php";
	require_once('/usr/local/lib/Smarty-3.1.14/libs/Smarty.class.php');
	
	$smarty = new Smarty();
	$smarty->setTemplateDir('/var/www/templates/');
	$smarty->setCompileDir('/var/www/templates_c/');
	$smarty->setConfigDir('/var/www/configs/');
	$smarty->setCacheDir('/var/www/cache/');
	
	/*if (($_FILES["infile"]["type"] == "text/plain") && ($_FILES["outfile"]["type"] == "text/plain")//format control 
	&& ($_FILES["infile"]["size"] < 20000) && ($_FILES["outfile"]["size"] < 20000))
	{
		//$infilename = $_POST['no']
		if ($_FILES["infile"]["error"] > 0 || $_FILES["outfile"]["error"] > 0)
		{
			echo "Return Code: " . $_FILES["infile"]["error"] . "<br />";
		}else{
			/*echo "Upload: " . $_FILES["infile"]["name"] . "<br />";
			echo "Type: " . $_FILES["infile"]["type"] . "<br />";
			echo "Size: " . ($_FILES["infile"]["size"] / 1024) . " Kb<br />";
			echo "Temp file: " . $_FILES["infile"]["tmp_name"] . "<br />";
			
			if (file_exists("/var/www/upload/" . $_FILES["infile"]["name"]) || file_exists("/var/www/upload/" . $_FILES["outfile"]["name"]) )
			{
				echo $_FILES["infile"]["name"] . " already exists. ";
			}else{
			move_uploaded_file($_FILES["infile"]["tmp_name"],
			"/var/www/upload/" . $_FILES["infile"]["name"]);
			move_uploaded_file($_FILES["outfile"]["tmp_name"],
			"/var/www/upload/" . $_FILES["outfile"]["name"]);
			//echo "Stored in: " . "/var/www/upload/" . $_FILES["infile"]["name"];
			//echo "Stored in: " . "/var/www/upload/" . $_FILES["outfile"]["name"];
			//}
		}
	}else{
	echo "Invalid file";
	}*/
	
	$selectchapterquery = "SELECT * FROM Chapter";	
	$selectchaptersql = mysqli_query($link, $selectchapterquery);
	$chapterlist = array();

	while($row = mysqli_fetch_array($selectchaptersql, MYSQLI_NUM)){
		$chapterlist[] = $row;
	}
	
	$selectknowledgequery = "SELECT * FROM Knowledge";	
	$selectknowledgesql = mysqli_query($link, $selectknowledgequery);
	$knowledgelist = array();

	while($row = mysqli_fetch_array($selectknowledgesql, MYSQLI_NUM)){
		$knowledgelist[] = $row;
	}
	$smarty->assign('chapterlist', $chapterlist);
	$smarty->assign('knowledgelist', $knowledgelist);
	
	if($_POST['cno'] AND $_POST['econtent'] AND $_POST['answer'] AND $_POST['score'] AND $_POST['style'] AND $_POST['stage'] AND  ($_FILES["infile"]["type"] == "text/plain") && ($_FILES["outfile"]["type"] == "text/plain")//format control 
	&& ($_FILES["infile"]["size"] < 20000) && ($_FILES["outfile"]["size"] < 20000) )
	{
		if ($_FILES["infile"]["error"] > 0 || $_FILES["outfile"]["error"] > 0)
		{
			echo "Return Code: " . $_FILES["infile"]["error"] . "<br />";
		}else{
			$cno = $_POST['cno'];
			$econtent = $_POST['econtent'];
			$answer = $_POST['answer'];
			$intxt = "in";
			$outtxt = "out";
			$score = $_POST['score'];
			$style = $_POST['style'];
			$stage = $_POST['stage'];
			
			$query = "INSERT INTO Pexercise(Pcno, Pecontent, Panswer, Pin, Pout, Pscore, Pstage, Pstyle) VALUES('$cno', '$econtent', '$answer', '$intxt', '$outtxt', '$score', '$stage', $style)";
			$sql = mysqli_query($link, $query);
			$peno = mysqli_insert_id($link);
			
			move_uploaded_file($_FILES["infile"]["tmp_name"],
			"/var/www/upload/in" . $peno);
			$infilepath = "/var/www/upload/in".$peno;
			move_uploaded_file($_FILES["outfile"]["tmp_name"],
			"/var/www/upload/out" . $peno);
			$outfilepath = "/var/www/upload/out". $peno;
			
			$uquery = "UPDATE Pexercise SET Pin='$infilepath', Pout='$outfilepath' WHERE Peno=$peno";
			mysqli_query($link, $uquery);
			$err = mysqli_error($link); 
			if ($err){
				echo "error$err";
			}else{
				echo "<meta http-equiv=\"refresh\" content=\"1;url=addProgramProblem.php\">";
			}
		}	
	}else{
		
	}
	
	$smarty->display('addProgramProblem.tpl');
?>
