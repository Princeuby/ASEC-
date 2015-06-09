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
    <h1 style='color: blue'>PERSONNEL INFORMATION</h1>
	<table border='1' style='border:4px solid blue' id="iconTable">
	<?php
    include_once '../includes/db_connect.php';
    $id = $_GET['user_id'];
    
    $sql = "SELECT * FROM Security_Staff WHERE Security_Staff_ID='$id'";
	$result = $mysqli->query($sql);
	$row = $result->fetch_assoc();

	echo "<tr>
			<td id='formtdlabel'><label>Security Staff ID:</label></td>
			<td><label>".$row['Security_Staff_ID']."</label></td>
		</tr>
		<tr>
			<td id='formtdlabel'><label>First Name:</label></td>
			<td><label>".$row['First_Name']."</label></td>
		</tr>
		<tr>
			<td id='formtdlabel'><label>Middle Name:</label></td>
			<td><label>".$row['Middle_Name']."</label></td>
		</tr>
		<tr>
			<td id='formtdlabel'><label>Last Name:</label></td>
			<td><label>".$row['Last_Name']."</label></td>
		</tr>
		<tr>
			<td id='formtdlabel'><label>Gender:</label></td>
			<td><label>".$row['Gender']."</label></td>
		</tr>
		<tr>
			<td id='formtdlabel'><label>Date of Birth:</label></td>
			<td><label>".$row['Date_of_Birth']."</label></td>
		</tr>
		<tr>
			<td id='formtdlabel'><label>Marital Status:</label></td>
			<td><label>".$row['Marital_Status']."</label></td>
		</tr>
		<tr>
			<td id='formtdlabel'><label>Religion:</label></td>
			<td><label>".$row['Religion']."</label></td>
		</tr>
		<tr>
			<td id='formtdlabel'><label>Phone Number:</label></td>
			<td><label>".$row['Phone_Number']."</label></td>
		</tr>
		<tr>
			<td id='formtdlabel'><label>Email Address:</label></td>
			<td><label>".$row['Email_Address']."</label></td>
		</tr>
		<tr>
			<td id='formtdlabel'><label>Street:</label></td>
			<td><label>".$row['Street']."</label></td>
		</tr>
		<tr>
			<td id='formtdlabel'><label>City:</label></td>
			<td><label>".$row['City']."</label></td>
		</tr>
		<tr>
			<td id='formtdlabel'><label>LGA:</label></td>
			<td><label>".$row['LGA']."</label></td>
		</tr>
		<tr>
			<td id='formtdlabel'><label>State:</label></td>
			<td><label>".$row['State']."</label></td>
		</tr>
		<tr>
			<td id='formtdlabel'><label>Nationality:</label></td>
			<td><label>".$row['Nationality']."</label></td>
		</tr>
		<tr>
			<td id='formtdlabel'><label>Postal Address:</label></td>
			<td><label>".$row['Postal_Address']."</label></td>
		</tr>
		<tr>
			<td id='formtdlabel'><label>Employment Date:</label></td>
			<td><label>".$row['Date_of_Employment']."</label></td>
		</tr>
		<tr>
			<td id='formtdlabel'><label>Rank:</label></td>
			<td><label>".$row['Rank']."</label</td>
		</tr>
		<tr>
			<td id='formtdlabel'><label>Department:</label></td>
			<td><label>".$row['Department']."</label></td>
		</tr>
		<tr>
			<td id='formtdlabel'><label>Security_Staff Verified:</label></td>
			<td><label>".$row['Security_Staffcol']."</label></td>
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