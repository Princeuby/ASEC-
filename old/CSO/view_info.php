<?php
include_once '../includes/db_connect.php';
session_start();
?>

<!DOCTYPE html>
<html>
<head><title>CSO | ASEC</title>
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
<p>Welcome, <?php echo "$_SESSION[firstname] $_SESSION[lastname]";?></p>
<a style="text-decoration:none;text-align:right;color:#fff;font-size:15px;"href="../logout.php"><p class="logout">LogOut</p></a></p>

</div>


<div class="nav">
<ul>
  <li class="select"><a href="./home.php">Personnels</a></li>
  <li><a href="./student.php">Case Files</a></li>
  <li><a href="./applicants.php">Applicants</a></li>
  <li><a href="./scheduling.php">Scheduling</a></li>
  <li><a href="./vistors.php">Visitors</a></li>
  <li><a href="./cab.php">Cab Drivers</a></li>
 </ul>
</div>
<div class="content">
<h1 style='color: blue'>DETAILS</h1>
	<table border='1' style='border:4px solid blue' id="iconTable">
		<tr>
			<th>Staff ID</th>
			<th>First Name</th>
			<th>Last Name</th>
			<th>Email Address</th>
		</tr>
	<?php
    include_once '../includes/db_connect.php';
    
    $sql = 'SELECT * FROM Security_Staff';
	$result = $mysqli->query($sql);
	if ($result->num_rows > 0) {
		while($row = $result->fetch_assoc()) {
			echo "<tr><td><a href='./user_info.php?user_id=".$row['Security_Staff_ID']."'>".$row['Security_Staff_ID']."</a></td><td>".$row['First_Name']."</td><td>".$row['Last_Name']."</td><td>".$row['Email_Address']."</td>
			
			</tr>";
		}
	}
?>
	</table>
</div>
<footer>
<div id="footer">
Copyright &copy; 2015 Emmanuel and Essien
</div>
</footer>

</body>
</html>