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
  <li class="select"><a href="./student.php">Case Files</a></li>
  <li><a href="./applicants.php">Applicants</a></li>
  <li><a href="./scheduling.php">Scheduling</a></li>
  <li><a href="./vistors.php">Visitors</a></li>
  <li><a href="./cab.php">Cab Drivers</a></li>
 </ul>
</div>
<div class="content">
	<h1 style='color: blue'>CASE INFORMATION</h1>
	<table border='1' style='border:4px solid blue' id="iconTable">
	<?php
    include_once '../includes/db_connect.php';
    $id = $_GET['user_id'];
    
    $sql = "SELECT * FROM Case_File WHERE Case_ID='$id'";
	$result = $mysqli->query($sql);
	$row = $result->fetch_assoc();

	echo "<tr>
			<td id='formtdlabel'><label>Case ID:</label></td>
			<td><label>".$row['Case_ID']."</label></td>
		</tr>
		<tr>
			<td id='formtdlabel'><label>Dorm:</label></td>
			<td><label>".$row['Dorm']."</label></td>
		</tr>
		<tr>
			<td id='formtdlabel'><label>Room Number:</label></td>
			<td><label>".$row['Room Number']."</label></td>
		</tr>
		<tr>
			<td id='formtdlabel'><label>RD Name:</label></td>
			<td><label>".$row['RD_Name']."</label></td>
		</tr>
		<tr>
			<td id='formtdlabel'><label>Semester:</label></td>
			<td><label>".$row['Semester']."</label></td>
		</tr>
		<tr>
			<td id='formtdlabel'><label>Time of Incident:</label></td>
			<td><label>".$row['Time_of_Incident']."</label></td>
		</tr>
		<tr>
			<td id='formtdlabel'><label>Place of Incident:</label></td>
			<td><label>".$row['Place_of_Incident']."</label></td>
		</tr>
		<tr>
			<td id='formtdlabel'><label>Incident Description:</label></td>
			<td><label>".$row['Incident_Description']."</label></td>
		</tr>
		<tr>
			<td id='formtdlabel'><label>Student ID:</label></td>
			<td><label>".$row['Studen_ID']."</label></td>
		</tr>
		<tr>
			<td id='formtdlabel'><label>Staff ID:</label></td>
			<td><label>".$row['Staff_ID']."</label></td>
		</tr>
		
		
		";
	
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