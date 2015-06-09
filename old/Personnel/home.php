 <?php
    include_once '../includes/db_connect.php';
    session_start();
?>   
<?php
	include_once '../includes/db_connect.php';
?>
<!DOCTYPE html>
<html>
<head><title>Personnel | ASEC</title>
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
  <li class="select"><a href="./home.php">Validation</a></li>
  <li><a href="./case.php">Case</a></li>
  <li><a href="./sign.php">Student Sign In/Out</a></li>
  <li><a href="./visitors.php">Visitors</a></li>
  <li><a href="./schedule.php">Schedule</a></li>
 </ul>
</div>
<div class="content">
	<table id="iconTable">
		<form action="./valid.php" method="POST">
		<tr>
			
			<td>
			 <select name="search">
			 	<option value="null">--Choose One--</option>
				<option value="security_staff">Security staff ID</option>
				<option value="student">Student ID</option>
				<option value="cab_driver">Car Number</option>
				<option value="faculty">Faculty ID</option>
				<option value="staff">Staff ID</option>
				<option value="visitor">Visitor ID</option>
			</select>
			</td>
		<tr>
		<td><label> Enter ID </label></td>
			<td><input type="text" name="id"></td>
		</tr>
			<td><button type="submit" name="submit">Submit</button>
			<input type="button" value="Cancel"></td>
		</tr>
	</form>
	</table>
</div>
<footer>
<div id="footer">
Copyright &copy; 2015 Emmanuel and Essien
</div>
</footer>

</body>
</html>