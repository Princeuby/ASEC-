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
<p>Welcome,<?php echo "$_SESSION[firstname] $_SESSION[lastname]";?></p>
<a style="text-decoration:none;text-align:right;color:#fff;font-size:15px;"href="../logout.php"><p class="logout">LogOut</p></a></p>

</div>


<div class="nav">
<ul>
  <li><a href="./home.php">Validation</a></li>
  <li><a href="./case.php">Case</a></li>
  <li class="select"><a href="./sign.php">Student Sign In/Out</a></li>
  <li><a href="./visitors.php">Visitors</a></li>
  <li><a href="./schedule.php">Schedule</a></li>
   
 </ul>
</div>
<div class="content">
	<p>Number of female Visitors: <?php include_once '../includes/db_connect.php';
	$sql = "SELECT count(*) as count FROM girls_visitors";
	$result = $mysqli->query($sql);
	$row = $result->fetch_assoc();
	echo $row['count'];
	?>
</p>
	<br/><h1 style='color: blue'>VISITORS IN DORM</h1>
	<table border='1' style='border:4px solid blue' id="iconTable">
		<tr>
			<th>Visitor ID</th>
			<th>Visitor Name</th>
			<th>Phone Number</th>
			<th>Whom to Visit</th>
			<th>Room Number</th>
			<th>Time In</th>
			<th>Resident Hall</th>
		</tr>
	<?php
    
    
    $sql = 'SELECT * FROM girls_visitors';
	$result = $mysqli->query($sql);
	if ($result->num_rows > 0) {
		while($row = $result->fetch_assoc()) {
			echo "<tr><td>".$row['Visitors_ID']."</td><td>".$row['Visitors_Name']."</td><td>".$row['Phone_Number']."</td><td>".$row['Whom_To_Visit']."</td><td>".$row['Room_Number']."</td><td>".$row['Time_In']."</td><td>".$row['Residence_Hall']."</td>
			
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