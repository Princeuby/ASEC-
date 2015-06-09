<?php
    include_once '../includes/db_connect.php';
    session_start();
    ?>
<?php
    
    if (isset($_POST['submit'])) {

    if ($stmt = $mysqli->prepare("INSERT INTO Security_Staff VALUES(?, ?, ?, ?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?)")) {
        $stmt->bind_param('ssssssssssssssssssss', $_POST['staff'],$_POST['firstname'],$_POST['midname'],$_POST['lastname'],$_POST['gender'],$_POST['dob'],$_POST['status'],$_POST['rel'],$_POST['phone'],$_POST['email'],$_POST['street'],$_POST['lga'],$_POST['city'],$_POST['state'],$_POST['nation'],$_POST['postal'],$_POST['emp'],$_POST['rank'],$_POST['dep'],$_POST['sec']); 
        $stmt->execute();  
        header("Location: ./success_add_staff.html");
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
<p class="centerText textbig" style='color: blue'>Add Staff Details</p><br />
	<form action="add_staff.php" method="POST">
	<table>
		
		<tr>
			<td id="formtdlabel"><label>Security Staff ID:</label></td>
			<td><input type="text" name="staff" required placeholder="e.g P.1234"></td>
		</tr>
		<tr>
			<td id="formtdlabel"><label>First Name:</label></td>
			<td><input type="text" name="firstname" required placeholder="e.g Essien"></td>
		</tr>
		<tr>
			<td id="formtdlabel"><label>Middle Name:</label></td>
			<td><input type="text" name="midname" required placeholder="e.g Abel"></td>
		</tr>
		<tr>
			<td id="formtdlabel"><label>Last Name:</label></td>
			<td><input type="text" name="lastname" required placeholder="e.g Emmanuel"></td>
		</tr>
		<tr>
			<td id="formtdlabel"><label>Gender:</label></td>
			<td><select name="gender" required>
				<option selected>Choose one</option>
				<option value="male">Male</option>
				<option value="female">Female</option>
			</select></td>
		</tr>
		<tr>
			<td id="formtdlabel"><label>Date of Birth:</label></td>
			<td><input type="date" name="dob" required placeholder="e.g 06/15/1985"></td>
		</tr>
		<tr>
			<td id="formtdlabel"><label>Marital Status:</label></td>
			<td><input type="text" name="status" required placeholder="e.g Single"></td>
		</tr>
		<tr>
			<td id="formtdlabel"><label>Religion:</label></td>
			<td><input type="text" name="rel" required placeholder="e.g Christian"></td>
		</tr>
		<tr>
			<td id="formtdlabel"><label>Phone Number:</label></td>
			<td><input type="text" name="phone" required placeholder="e.g 08059256222"></td>
		</tr>
		<tr>
			<td id="formtdlabel"><label>Email Address:</label></td>
			<td><input type="text" name="email" required placeholder="e.g emmanuel.essien@aun.edu.ng"></td>
		</tr>
		<tr>
			<td id="formtdlabel"><label>Street:</label></td>
			<td><input type="text" name="street" required placeholder="e.g Jimeta"></td>
		</tr>
		<tr>
			<td id="formtdlabel"><label>City:</label></td>
			<td><input type="text" name="city" required placeholder="e.g Yola"></td>
		</tr>
		<tr>
			<td id="formtdlabel"><label>LGA:</label></td>
			<td><input type="text" name="lga" required placeholder="e.g Numan"></td>
		</tr>
		<tr>
			<td id="formtdlabel"><label>State:</label></td>
			<td><input type="text" name="state" required placeholder="e.g Adamawa State"></td>
		</tr>
		<tr>
			<td id="formtdlabel"><label>Nationality:</label></td>
			<td><input type="text" name="nation" required placeholder="e.g Nigeria"></td>
		</tr><tr>
			<td id="formtdlabel"><label>Postal Address:</label></td>
			<td><input type="text" name="postal" required placeholder="e.g P.M.B 1234"></td>
		</tr><tr>
			<td id="formtdlabel"><label>Employment Date:</label></td>
			<td><input type="date" name="emp" required placeholder="e.g 04/12/2004"></td>
		</tr><tr>
			<td id="formtdlabel"><label>Rank:</label></td>
			<td><input type="text" name="rank" required placeholder="Sergeant"></td>
		</tr>
		<tr>
			<td id="formtdlabel"><label>Department:</label></td>
			<td><input type="text" name="dep" required placeholder="e.g Inventory"></td>
		</tr>
		<tr>
			<td id="formtdlabel"><label>Security_Staff Verified:</label></td>
			<td><input type="text" name="sec" required placeholder="e.g Employed"></td>
		</tr>
		<tr>
			<td></td>
			<td><br /><button type="submit" name="submit">Add Staff</button>
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