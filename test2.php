<?php
	$a="%a%b%c";
	$b="%b%a%c";
	$str1array = explode("%",$a);
	$str2array = explode("%",$b);
	sort($str1array);
	sort($str2array);
	$tmpscore = 0;
	for($i = 1;$i<min(count($str1array),count($str2array));$i++){
		echo $str1array[$i];
		echo $str2array[$i];
		if(!strcmp($str1array[$i],$str2array[$i])){
			$tmpscore++;
		}	
	 }
	echo $tmpscore;
	echo "<br>";
	print_r($str1array);
	echo "<br>";
	print_r($str2array);
	echo "<br>";
	if($str1array == $str2array)
		echo 1;
	else 
		echo 0;
?>
