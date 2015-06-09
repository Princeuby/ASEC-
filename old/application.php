<?php
	session_start();
	include_once './includes/db_connect.php';
	$sql = "SELECT * FROM Portal WHERE portal_status='Open'";
	$result = $mysqli->query($sql);
	if ($result->num_rows > 0) {
		if (isset($_POST['submit'])) {
			if ($stmt = $mysqli->prepare("INSERT INTO `asecdb`.`Application` (`Application_ID`, `Date_of_Application`, `First_Name`, `Middle_Name`, `Last_Name`, `Gender`, `Date_of_Birth`, `Marital Status`, `Religion`, `Phone_Number`, `Email Address`, `Street`, `City`, `LGA`, `State`, `Nationality`, `Postal_Address`) VALUES (NULL,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?)")) {
				$time = date("Y-m-d H:i:s",time());
				$stmt->bind_param('ssssssssssssssss',$time,$_POST['fname'],$_POST['mname'],$_POST['lname'],$_POST['gender'],$_POST['dob'],$_POST['status'],$_POST['rel'],$_POST['phone'],$_POST['email'],$_POST['street'],$_POST['lga'],$_POST['city'],$_POST['state'],$_POST['nation'],$_POST['postal']); 
				$stmt->execute();
				header("Location: ./thankyou.html");
        		exit();
			} else {
			header("Location: ./index.php");
			exit(); 
			}
		}
	}
	else {
		$_SESSION['error'] = "You are not meant to access that page.";
		header("Location: ./index.php");
		exit();
	}
?>
<!DOCTYPE html>
<html>
<head><title>Application | ASEC</title>
	<link rel="stylesheet" type="text/css" href="./css/style.custom.css">
	<link rel="shortcut icon" href="./images/bg.png" type="text/css">
	<link rel="icon" href="./images/bg.png" type="text/css">
</head>
<body>
<div class="header">
<div class="banner">
	<img class="logo" src="./images/bg.png" />
	<p class="textbig">Security Management System</p>
	<p class="textmid">American University of Nigeria<p>
</div>
</div>
<div class="admin">
<p>Welcome, Applicant</p>
<a style="text-decoration:none;text-align:right;color:#fff;font-size:15px;"href="./logout.php"><p class="logout">LogOut</p></a></p>
</div>


<div class="nav">
<ul>
  <li class="select"><a href="#">Application</a></li>
 </ul>
</div>
<div class="content">
	<div id="formTable">
		<p class="centerText textbig" style='color: blue; margin-right:10%;'>Application Form</p><br />
		<form action="application.php" method="POST">
			<table>

		<tr>
			<td id="formtdlabel"><label>First Name:</label></td>
			<td><input type="text" name="fname" required placeholder="e.g Dayo"></td>
		</tr>
		<tr>
			<td id="formtdlabel"><label>Middle Name:</label></td>
			<td><input type="text" name="mname" required placeholder="e.g Agbola"></td>
		</tr>
		<tr>
			<td id="formtdlabel"><label>Last Name:</label></td>
			<td><input type="text" name="lname" required placeholder="e.g Tunde"></td>
		</tr>
		<tr>
			<td id="formtdlabel"><label>Gender:</label></td>
			<td><select name="gender" required>
				<option selected>Choose one</option>
				<option value="male">Male</option>
				<option value="female">Female</option>
			</select></td>
		</tr>
		<tr>
			<td id="formtdlabel"><label>Date of Birth:</label></td>
			<td><input type="date" name="dob" required placeholder="e.g 06/15/1985"></td>
		</tr>
		
		<tr>
			<td id="formtdlabel"><label>Marital Status:</label></td>
			<td><input type="text" name="status" required placeholder="e.g Single"></td>
		</tr>
		<tr>
			<td id="formtdlabel"><label>Religion:</label></td>
			<td><input type="text" name="rel" required placeholder="e.g Christian"></td>
		</tr>
		<tr>
			<td id="formtdlabel"><label>Phone Number:</label></td>
			<td><input type="text" name="phone" required placeholder="e.g 08059256222"></td>
		</tr>
		<tr>
			<td id="formtdlabel"><label>Email Address:</label></td>
			<td><input type="text" name="email" required placeholder="e.g emmanuel.essien@aun.edu.ng"></td>
		</tr>
		<tr>
			<td id="formtdlabel"><label>Street:</label></td>
			<td><input type="text" name="street" required placeholder="e.g Jimeta"></td>
		</tr>
		<tr>
			<td id="formtdlabel"><label>City:</label></td>
			<td><input type="text" name="city" required placeholder="e.g Yola"></td>
		</tr>
		<tr>
			<td id="formtdlabel"><label>LGA:</label></td>
			<td><input type="text" name="lga" required placeholder="e.g Numan"></td>
		</tr>
		<tr>
			<td id="formtdlabel"><label>State:</label></td>
			<td><input type="text" name="state" required placeholder="e.g Adamawa State"></td>
		</tr>
		<tr>
			<td id="formtdlabel"><label>Nationality:</label></td>
			<td><input type="text" name="nation" required placeholder="e.g Nigeria"></td>
		</tr>
		<tr>
			<td id="formtdlabel"><label>Postal Address:</label></td>
			<td><input type="text" name="postal" required placeholder="e.g P.M.B 1234"></td>
		</tr>
		<tr>
			<td></td>
			<td><br /><button type="submit" name="submit">Apply</button>
		</tr>
			</table>
		</form>
	</div>
</div>
<footer>
<div id="footer">
Copyright &copy; 2015 Emmanuel and Essien
</div>
</footer>
<html>
</body>