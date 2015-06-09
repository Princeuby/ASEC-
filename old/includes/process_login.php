<?php


include_once 'db_connect.php';
session_start();

$username = $_POST['username'];
$password = $_POST['password'];


if (!isset($_POST['username'], $_POST['password'])) {
    header('Location: ../index.php?error=1');
    exit();
}
$stmt = "SELECT password, user_id, firstname, lastname, usertype FROM user WHERE user_id = '$username'";
$result = $mysqli->query($stmt);
if($result == false) { 
	$_SESSION['error'] = "no user";
	header('Location: ../index.php');
	exit(); 
	}
if ($result->num_rows == 0) { 
	$_SESSION['error'] = "no user";
	header('Location: ../index.php');
	exit();
}
$user = $result->fetch_assoc();
if ($password == $user['password']) {
	
	$_SESSION['user'] = $user['user_id'];
	$_SESSION['clearance'] = $user['usertype'];
	$_SESSION['firstname'] = $user['firstname'];
	$_SESSION['lastname'] = $user['lastname'];
	$_SESSION['logged_in'] = 1;
	// var_dump($_SESSION);
	// die();

	if ($user['usertype'] == 'admin') {
		header("Location: ../Admin/home.php");
		exit();
	}
	elseif ($user['usertype'] == 'cso') {
		header("Location: ../CSO/home.php");
		exit();
	}
	elseif ($user['usertype'] == 'personnel') {
		header("Location: ../Personnel/home.php");
		exit();
	}
	elseif ($user['usertype'] == 'hrpersonnel') {
		header("Location: ../HRPersonnel/home.php");
		exit();
	} else {
		$_SESSION['error'] = "Oops! something happened. We'll fix it";
		header('Location: ../index.php');
	}
}
else {
	$_SESSION['error'] = "wrong user ID or password";
	header('Location: ../index.php');
	exit();
}