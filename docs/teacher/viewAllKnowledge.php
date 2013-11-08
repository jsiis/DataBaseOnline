<?php
        include "connect_MySQL.php";
        require 'smarty/libs/Smarty.class.php';
        $smarty = new Smarty;
        $smarty->template_dir = "smarty/templates/templates";
        $smarty->compile_dir = "smarty/templates/templates_c";
        $smarty->config_dir = "smarty/templates/config";
        $smarty->cache_dir = "smarty/templates/cache";

        $selectquery = "SELECT * FROM Knowledge";
        $selectsql = mysqli_query($link, $selectquery);
        $knowledgelist = array();
        while($row = mysqli_fetch_array($selectsql, MYSQLI_NUM)){
        	$knowledgelist[] = $row;
//		echo "$row[1]";
        	}
        $smarty->assign('knowledgelist', $knowledgelist);
        $err = mysqli_error($link);
        if ($err)
        	echo "error$err";
        $smarty->display('viewAllKnowledge.tpl');
?>
