<?php
    include_once '../includes/db_connect.php';
    if ($stmt = $mysqli->prepare("INSERT INTO `Portal` VALUES (NULL, ?, ?)")) {
    	$time = date("Y-m-d H:i:s",time());
    	$stat = "Open";
    	$stmt->bind_param('ss',$time,$stat);
    	$stmt->execute();  
        header("Location: ./success.html");
        exit();
    }

