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
  <li><a href="./home.php">Personnels</a></li>
  <li><a href="./student.php">Case Files</a></li>
  <li><a href="./applicants.php">Applicants</a></li>
  <li class="select"><a href="./scheduling.php">Scheduling</a></li>
  <li><a href="./vistors.php">Visitors</a></li>
  <li><a href="./cab.php">Cab Drivers</a></li>
 </ul>
</div>
<div class="content">
	<div id="formTable">
	<p class="centerText textbig"style='color: blue; margin-right:20%;'>View Schedule</p><br/><br/>
	<form action="view_schedule.php" method="POST">
		<table>
			<tr>
				<td id="formtdlabel"><label>Location:</label></td>
				<td><select name="location" required>
					<option selected>Choose one</option>
					<?php
					$result = $mysqli->query("SELECT DISTINCT(Location) FROM scheduling");
					if ($result->num_rows > 0) {
						while($row = $result->fetch_array()) {
							echo "<option value='$row[0]'>$row[0]</option>";
						}
					}
					?>
				</select></td>
			</tr>
			<tr>
				<td></td>
				<td><br /><button type="submit" name="submit">View Location Schedule</button>
			</tr>
		</table>
		<?php
    	if (isset($_POST['submit'])) {
    		$days = ["Monday", "Tuesday", "Wednesday", "Thursday", "Friday", "Saturday", "Sunday"];
			$shifts = ["Morning", "Afternoon", "Night"];
			echo "<h2>$_POST[location]</h2>";
			foreach ($days as $day) {
				echo "<h3>$day</h3><hr>";
				echo "<table>";
				echo "<th>Shift</th>";
				echo "<th>ID</th>";
				echo "<th>Name</th>";
				foreach ($shifts as $shift) {
					$result = $mysqli->query("SELECT * FROM scheduling, user WHERE Security_Staff_ID = user_id AND Location='$_POST[location]' AND Day='$day' AND Shift='$shift'");
					if ($result->num_rows > 0) {
						
						while($row = $result->fetch_assoc()) {
							echo "<tr>";
							echo "<td>$shift</td>";
							echo "<td>$row[Security_Staff_ID]</td>";
							echo "<td>$row[firstname] $row[lastname]</td>";
							echo "</tr>";
						}
					}
					echo "<tr>";
					echo "<td><hr></td>";
					echo "<td><hr></td>";
					echo "<td><hr></td>";
					echo "</tr>";
				}
				echo "</table>";

			}
		}
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