<?php 
//	session_start();	
//	$tempUserId = $_SESSION['userID'];
//	$_SESSION['userID']=client;
//	$tempUserPassword = $_SESSION['password'];
//	$_SESSION['password']=123;
	$link = mysqli_connect("127.0.0.1","root","0818","dbexercise");
//	$link = mysqli_connect("liuyanscut.gicp.net","client","123","dbexercise");
	mysqli_query($link, "set charset 'gbk'");//�������ӱ���
	mysqli_query($link, "set names 'gbk'");//�������ӱ���
	if (!$link) {
    printf("Connect failed: %s\n", mysqli_connect_error());
    exit();
    }
	
?>