<?php
    include_once '../includes/db_connect.php';
    session_start();
?>
<?php
    include_once '../includes/db_connect.php';
    
 
    if (isset($_POST['submit'])) {

    if ($stmt = $mysqli->prepare("INSERT INTO `asecdb`.`Case_File` (`Case_ID`, `Dorm`, `Room Number`, `RD_Name`, `Semester`, `Time_of_Incident`, `Date_of_Incident`, `Place_of_Incident`, `Incident_Description`, `Studen_ID`, `Staff_ID`) VALUES (NULL, ?, ?, ?,?,?,?,?,?,?,?)")) {
        $stmt->bind_param('ssssssssss', $_POST['dorm'],$_POST['rnumber'],$_POST['rdname'],$_POST['semester'],$_POST['time'],$_POST['date'],$_POST['place'],$_POST['descrip'],$_POST['student'],$_POST['security']); 
        $stmt->execute();  
        header("Location: ./home.php");
        exit();
    } else {
        $_SESSION['err'] = "Database error: cannot prepare statement";
        header("Location: ./home.php");
        exit();
    }
}
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
  <li class="select"><a href="./case.php">Case</a></li>
  <li><a href="./sign.php">Student Sign In/Out</a></li>
  <li><a href="./visitors.php">Visitors</a></li>
  <li><a href="./schedule.php">Schedule</a></li>
 
 </ul>
</div>
<div class="content">
	<div id="formTable">
<p class="centerText textbig" style='color: blue'>Add Case Details</p><br />
	<form action="add_case.php" method="POST">
	<table>
		
		<tr>
			<td id="formtdlabel"><label>Dorm:</label></td>
			<td><input type="text" name="dorm" required placeholder="e.g AA"></td>
		</tr>
		<tr>
			<td id="formtdlabel"><label>Room Number:</label></td>
			<td><input type="text" name="rnumber" required placeholder="e.g 211"></td>
		</tr>
		<tr>
			<td id="formtdlabel"><label>RD Name:</label></td>
			<td><input type="text" name="rdname" required placeholder="e.g Emmanuel"></td>
		</tr>
		<tr>
			<td id="formtdlabel"><label>Semester:</label></td>
			<td><input type="text" name="semester" required placeholder="e.g Fall 2012"></td>
		</tr>
		
		<tr>
			<td id="formtdlabel"><label>Time of Incident:</label></td>
			<td><input type="time" name="time" required placeholder="e.g 15:00 hrs"></td>
		</tr>
		<tr>
			<td id="formtdlabel"><label>Place of Incident:</label></td>
			<td><input type="text" name="place" required placeholder="e.g Common room"></td>
		</tr>
		<tr>
			<td id="formtdlabel"><label>Date of Incident:</label></td>
			<td><input type="date" name="date" required placeholder="e.g 2015/2/03></td>">
		</tr>

		<tr>
			<td id="formtdlabel"><label>Description of Incident:</label></td>
			<td><input type="text" name="descrip" required placeholder="e.g Fighting"></td>
		</tr>
		<tr>
			<td id="formtdlabel"><label>Student ID:</label></td>
			<td><input type="text" name="student" required placeholder="e.g A00015678"></td>
		</tr>
		<tr>
			<td id="formtdlabel"><label>Security Staff ID:</label></td>
			<td><input type="text" name="security" required placeholder="e.g p1234"></td>
		<tr>
			<td></td>
			<td><br /><button type="submit" name="submit">Add Case</button>
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