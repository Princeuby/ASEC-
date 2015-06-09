<?php
include_once '../includes/db_connect.php';
session_start();
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
<p>Welcome, <?php echo "$_SESSION[firstname] $_SESSION[lastname]";?></p>
<a style="text-decoration:none;text-align:right;color:#fff;font-size:15px;"href="../logout.php"><p class="logout">LogOut</p></a></p>

</div>


<div class="nav">
<ul>
  <li><a href="./home.php">Validation</a></li>
  <li><a href="./case.php">Case</a></li>
  <li><a href="./sign.php">Student Sign In/Out</a></li>
  <li class="select"><a href="./visitors.php">Visitors</a></li>
  <li><a href="./schedule.php">Schedule</a></li>
  
  
 </ul>
</div>
<div class="content">
	<p>Number of Visitors: <?php include_once '../includes/db_connect.php';
	$sql = "SELECT count(*) as count FROM Vistors_Check";
	$result = $mysqli->query($sql);
	$row = $result->fetch_assoc();
	echo $row['count'];
	?>
</p>
	<br/><h1 style='color: blue'>VISITORS ON CAMPUS</h1>
	<table border='1' style='border:4px solid blue' id="iconTable">
		<tr>
			<th>Visitor ID</th>
			<th>Visitor Name</th>
			<th>Phone Number</th>
			<th>Date of Visit</th>
			<th>Whom to Visit</th>
			<th>Visit Location</th>
			
		</tr>
	<?php
    
    
    $sql = 'SELECT * FROM Vistors_Check';
	$result = $mysqli->query($sql);
	if ($result->num_rows > 0) {
		while($row = $result->fetch_assoc()) {
			$vis = $row['Visitor_ID'];
			$sql2 = "SELECT * FROM Visitor WHERE Visitor_ID='$vis'";
			$result2 = $mysqli->query($sql2);
			$row2 = $result2->fetch_assoc();
			echo "<tr><td>".$row['Visitor_ID']."</td><td>".$row2['First_Name']." ".$row2['Last_Name']."</td><td>".$row2['Phone_Number']."</td><td>".$row['Date_of_Visit']."</td><td>".$row['Whom_to_Visit']."</td><td>".$row['Visit_Location']."</td>
			
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