<?php
include_once '../includes/db_connect.php';
session_start();
?>

<!DOCTYPE html>
<html>
<head><title>Personnel | ASEC</title>
	<link rel="stylesheet" type="text/css" href="../css/style.custom.css">

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
  <li ><a href="./home.php">Validation</a></li>
  <li><a href="./case.php">Case</a></li>
  <li><a href="./sign.php"> Student Sign In/Out</a></li>
  <li><a href="./visitors.php">Visitors</a></li>
  <li class="select"><a href="./schedule.php">Schedule</a></li>
  
 </ul>
</div>
<div class="content">
	<div id="formTable">
	<p class="centerText textbig">Security Schedule</p><br/>
	<?php
	$days = ["Monday", "Tuesday", "Wednesday", "Thursday", "Friday", "Saturday", "Sunday"];
	$shifts = ["Morning", "Afternoon", "Night"];
	echo "<h1 class='centerText' style='color: blue'>WEEKLY SHIFT SCHEDULE</h1>";
	echo "<table class='centerText' border='1' style='border:4px solid blue; margin-left:auto; margin-right:auto;'>";
	echo "<th>Day</th>";
	echo "<th>Location</th>";
	echo "<th>Shift</th>";
	foreach ($days as $day) {
		$result = $mysqli->query("SELECT * FROM scheduling WHERE Security_Staff_ID='$_SESSION[user]' AND Day='$day'");// AND Shift='$shift'");
		if ($result->num_rows > 0) {
			$row = $result->fetch_assoc();
				echo "<tr>";
				echo "<td>$day</td>";
				echo "<td>$row[Location]</td>";
				echo "<td>$row[Shift]</td>";
				echo "</tr>";
		}
		else {
			echo "<tr>";
			echo "<td>$day</td>";
			echo "<td>**DAY OFF**</td>";
			echo "<td>--</td>";
		}	
	}
	echo "</table>";
	?>
</div>
</div>
<footer>
<div id="footer">
Copyright &copy; 2015 Emmanuel and Essien
</div>
</footer>
<html>
</body>