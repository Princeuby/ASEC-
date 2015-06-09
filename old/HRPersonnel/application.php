<?php
    include_once '../includes/db_connect.php';
    session_start();
    ?>

<!DOCTYPE html>
<html>
<head><title>Human Resource | ASEC</title>
	<link rel="stylesheet" type="text/css" href="../css/style.custom.css">
	<link rel="shortcut icon" href="../images/bg.png" type="text/css">
	<link rel="icon" href="../images/bg.png" type="text/css">
</head>
<body>
<div class="header">
<div class="banner">
	<img class="logo" src="../images/bg.png" />
	<p class="textbig">Security Management System</p>
	<p class="textmid">American University of Nigeria<p>
</div>
</div>
<div class="admin">
<p>Welcome,<?php echo "$_SESSION[firstname] $_SESSION[lastname]";?></p>
<a style="text-decoration:none;text-align:right;color:#fff;font-size:15px;"href="../logout.php"><p class="logout">LogOut</p></a></p>

</div>


<div class="nav">
<ul>
  <li><a href="home.php">Manage Staff</a></li>
  <li><a href="next_kin.php">Next of Kin</a></li>
  <li><a href="schedule.php">Staff Scheduling</a></li>
  <li class="select"><a href="application.php">Staff Application</a></li>
 </ul>
</div>
<div class="content">
	<table id="iconTable">
		<tr>
			<td class="icon"><a style="text-decoration:none" href="./open_p.php"><img class="iconImage2" src="../images/open-portal.jpg"/><br/>Open Portal</a></td>
			<td><a style="text-decoration:none" href="./close_p.php"><p></p><img class="iconImage2" src="../images/close-portal.jpg"/><br/>Close Portal</a></td>
		</tr>
	</table>
</div>
<footer>
<div id="footer">
Copyright &copy; 2015 Emmanuel and Essien
</div>
</footer>
<html>
</body>