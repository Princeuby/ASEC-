<?php
    include_once '../includes/db_connect.php';
    session_start();
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
  <li><a href="./home.php">Manage Staff</a></li>
  <li class="select"><a href="next_kin.php">Next of Kin</a></li>
  <li><a href="schedule.php">Staff Scheduling</a></li>
  <li><a href="application.php">Staff Application</a></li>
 </ul>
</div>
<div class="content">
	<div id="formTable">
<p class="centerText textbig" style='color: blue'>View Next of Kin Details</p><br/>
	<table class='centerText' border='1' style='border:4px solid blue; margin-left:auto; margin-right:auto;'>
		<tr>
			<td>Staff ID</td>
			<td>First Name</td>
			<td>Last Name</td>
			<td></td>
			<td></td>
		</tr>
		<?php
    include_once '../includes/db_connect.php';
    
    $sql = 'SELECT * FROM Next_of_Kin';
	$result = $mysqli->query($sql);
	if ($result->num_rows > 0) {
		while($row = $result->fetch_assoc()) {
			echo "<tr><td>".$row['Staff_ID']."</td><td>".$row['First_Name']."</td><td>".$row['Last_Name']."</td><td class='icon'><a style='text-decoration:none' href='./edit_kin.php?user_id=".$row['Staff_ID']."'><img class='iconImage3' src='../images/user-edit.jpg'/>Edit Kin</a></td>
			<td class='icon'><a style='text-decoration:none' href='./delete_kin.php?user_id=".$row['Staff_ID']."'><img class='iconImage4' src='../images/user-delete.png'/> Delete Kin</a></td>
			</tr>";
		}
	}
?>
		<!--<tr>
			<td id="formtdlabel"><label>First Name:</label></td>
			<td><input type="text" name="firstname" required placeholder="e.g Essien"></td>
		</tr>
		<tr>
			<td id="formtdlabel"><label>Last Name:</label></td>
			<td><input type="text" name="lastname" required placeholder="e.g Emmanuel"></td>
		</tr>
		<tr>
			<td id="formtdlabel"><label>Email:</label></td>
			<td><input type="text" name="email" required placeholder="e.g emmanuel.essien@aun.edu.ng"></td>
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
			<td id="formtdlabel"><label>Address:</label></td>
			<td><input type="text" name="address" required placeholder="e.g No 3, Sabon Gida, Jimeta"></td>
		</tr>
		<tr>
			<td id="formtdlabel"><label>Phone:</label></td>
			<td><input type="text" name="phone" required placeholder="e.g 08059256222"></td>
		</tr>
		<tr>
			<td id="formtdlabel"><label>Date of Birth:</label></td>
			<td><input type="datetime-local" name="dob" required></td>
		</tr>
		<tr>
			<td id="formtdlabel"><label>User Type:</label></td>
			<td><select name="usertype" required>
				<option selected>Choose one</option>
				<option value="cso">CSO</option>
				<option value="personnel">Personnel</option>
			</select></td>
		</tr>-->
	</table>
</div>
</div>
<footer>
<div id="footer">
Copyright &copy; 2015 Emmanuel and Essien
</div>
</footer>
<html>
</body>