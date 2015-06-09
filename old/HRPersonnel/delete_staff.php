<?php
    include_once '../includes/db_connect.php';
    session_start();
    ?>

<?php
    include_once '../includes/db_connect.php';
    
 
    if (isset($_POST['submit'])) {

    if ($stmt = $mysqli->prepare("DELETE FROM Security_Staff WHERE Security_Staff_ID = ?")) {
        $stmt->bind_param('s', $_POST['staff']); 
        $stmt->execute();  
        header("Location: ./delete_staff_success.html");
        exit();
    } else {
        $_SESSION['err'] = "Database error: cannot prepare statement";
        header("Location: ./home.php");
        exit();
    }
}
	$staff = $_GET['user_id'];
	$sql = "SELECT * FROM Security_Staff WHERE Security_Staff_ID = '$staff'";
	$result = $mysqli->query($sql);
	$row = $result->fetch_assoc();
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
  <li class="select"><a href="./home.php">Manage Staff</a></li>
  <li><a href="next_kin.php">Next of Kin</a></li>
  <li><a href="schedule.php">Staff Scheduling</a></li>
  <li><a href="application.php">Staff Application</a></li>
 </ul>
</div>
<div class="content">
	<div id="formTable">
<p class="centerText textbig" style='color: blue'>Remove User Details</p><br />
	<form action="delete_staff.php" method="POST">
	<table>
		<?php
		echo "<tr>
			<td id='formtdlabel'><label>Security Staff ID:</label></td>
			<td><input type='text' name='staff' value='".$row['Security_Staff_ID']."'required readonly></label></td>
		</tr>
		<tr>
			<td id='formtdlabel'><label>First Name:</label></td>
			<td><input type='text' name='firstname' required value='".$row['First_Name']."' readonly></td>
		</tr>
		<tr>
			<td id='formtdlabel'><label>Middle Name:</label></td>
			<td><input type='text' name='midname' required value='".$row['Middle_Name']."' readonly></td>
		</tr>
		<tr>
			<td id='formtdlabel'><label>Last Name:</label></td>
			<td><input type='text' name='lastname' required value='".$row['Last_Name']."' readonly></td>
		</tr>
		<tr>
			<td id='formtdlabel'><label>Gender:</label></td>
			<td><select name='gender' required readonly>
				<option "; echo $row['Gender'] == "male" ? "selected " : "" ; echo ">Male</option>
                <option "; echo $row['Gender'] == "female" ? "selected " : "" ; echo ">Female</option>
			</select></td>
		</tr>
		<tr>
			<td id='formtdlabel'><label>Date of Birth:</label></td>
			<td><input type='date' name='dob' required value='".$row['Date_of_Birth']."' readonly></td>
		</tr>
		<tr>
			<td id='formtdlabel'><label>Marital Status:</label></td>
			<td><input type='text' name='status' required value='".$row['Marital_Status']."' readonly></td>
		</tr>
		<tr>
			<td id='formtdlabel'><label>Religion:</label></td>
			<td><input type='text' name='rel' required value='".$row['Religion']."' readonly></td>
		</tr>
		<tr>
			<td id='formtdlabel'><label>Phone Number:</label></td>
			<td><input type='text' name='phone' required value='".$row['Phone_Number']."' readonly></td>
		</tr>
		<tr>
			<td id='formtdlabel'><label>Email Address:</label></td>
			<td><input type='text' name='email' required value='".$row['Email_Address']."' readonly></td>
		</tr>
		<tr>
			<td id='formtdlabel'><label>Street:</label></td>
			<td><input type='text' name='street' required value='".$row['Street']."' readonly></td>
		</tr>
		<tr>
			<td id='formtdlabel'><label>City:</label></td>
			<td><input type='text' name='city' required value='".$row['City']."' readonly></td>
		</tr>
		<tr>
			<td id='formtdlabel'><label>LGA:</label></td>
			<td><input type='text' name='lga' required value='".$row['LGA']."' readonly></td>
		</tr>
		<tr>
			<td id='formtdlabel'><label>State:</label></td>
			<td><input type='text' name='state' required value='".$row['State']."' readonly></td>
		</tr>
		<tr>
			<td id='formtdlabel'><label>Nationality:</label></td>
			<td><input type='text' name='nation' value='".$row['Nationality']."' required readonly></td>
		</tr>
		<tr>
			<td id='formtdlabel'><label>Postal Address:</label></td>
			<td><input type='text' name='postal' required value='".$row['Postal_Address']."' readonly></td>
		</tr>
		<tr>
			<td id='formtdlabel'><label>Employment Date:</label></td>
			<td><input type='date' name='emp' value='".$row['Date_of_Employment']."' required readonly></td>
		</tr>
		<tr>
			<td id='formtdlabel'><label>Rank:</label></td>
			<td><input type='text' name='rank' value='".$row['Rank']."' required readonly></td>
		</tr>
		<tr>
			<td id='formtdlabel'><label>Department:</label></td>
			<td><input type='text' name='dep' value='".$row['Department']."' required readonly></td>
		</tr>
		<tr>
			<td id='formtdlabel'><label>Security_Staff Verified:</label></td>
			<td><input type='text' name='sec' value='".$row['Security_Staffcol']."' required readonly></td>
		</tr>";
		?>
		<tr>
			<td></td>
			<td><br /><button type="submit" name="submit">Delete User <a href="delete_staff_success.html"></button>
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