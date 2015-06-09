<?php
    include_once '../includes/db_connect.php';
    if ($stmt = $mysqli->prepare("DELETE FROM `Portal` WHERE portal_status=?")) {
    	$time = date("Y-m-d H:i:s",time());
    	$stat = "Open";
    	$stmt->bind_param('s',$stat);
    	$stmt->execute();  
        header("Location: ./closed.html");
        exit();
    }
