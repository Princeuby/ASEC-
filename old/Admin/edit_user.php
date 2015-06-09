<?php
    include_once '../includes/db_connect.php';
    
 
    if (isset($_POST['submit'])) {

    if ($stmt = $mysqli->prepare("UPDATE user SET user_id=?, password=?, firstname=?, lastname=?, email=?, phone=?, usertype=?, date_of_birth=?,gender=?,address=? WHERE user_id=?")) {
        $stmt->bind_param('sssssssssss', $_POST['staff'],$_POST['pass'],$_POST['firstname'],$_POST['lastname'],$_POST['email'],$_POST['phone'],$_POST['usertype'],$_POST['dob'],$_POST['gender'],$_POST['address'],$_POST['old_id']); 
        $stmt->execute();  
        header("Location: ./success_edit_user.html");
        exit();
    } else {
        $_SESSION['err'] = "Database error: cannot prepare statement";
        header("Location: ./home.php");
        exit();
    }
}
    $staff = $_GET['user_id'];
	$sql = "SELECT * FROM user WHERE user_id = '$staff'";
	$result = $mysqli->query($sql);
	$row = $result->fetch_assoc();

?>

<!DOCTYPE html>
<html>
<head><title>Admin | ASEC</title>
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
<p>Welcome, Admin</p>
<a style="text-decoration:none;text-align:right;color:#fff;font-size:15px;"href="../logout.php"><p class="logout">LogOut</p></a></p>

</div>


<div class="nav">
<ul>
  <li class="select"><a href="./home.php">Manage User</a></li>
 </ul>
</div>
<div class="content">
	<div id="formTable">
<p class="centerText textbig" style='color: blue; margin-right:8%;'>Edit User Details</p><br />
	<form action="edit_user.php" method="POST">
		<input type="hidden" name="old_id"
 value="<?php echo $staff; ?>">
	<table>
		<?php
		echo "<tr>
			<td id='formtdlabel'><label>Security Staff ID:</label></td>
			<td><input type='text' name='staff' value='".$row['user_id']."'required></label></td>
		</tr>
		<tr>
			<td id='formtdlabel'><label>First Name:</label></td>
			<td><input type='text' name='firstname' required value='".$row['firstname']."'></td>
		</tr>
		<tr>
			<td id='formtdlabel'><label>Last Name:</label></td>
			<td><input type='text' name='lastname' required value='".$row['lastname']."'></td>
		</tr>
		<tr>
			<td id='formtdlabel'><label>Email:</label></td>
			<td><input type='text' name='email' required value='".$row['email']."'></td>
		</tr>
		<tr>
			<td id='formtdlabel'><label>Gender:</label></td>
			<td><select name='gender' required>
				<option "; echo $row['gender'] == "male" ? "selected " : "" ; echo ">Male</option>
                <option "; echo $row['gender'] == "female" ? "selected " : "" ; echo ">Female</option>
			</select></td>
		</tr>
		<tr>
			<td id='formtdlabel'><label>Address:</label></td>
			<td><input type='text' name='address' required value='".$row['address']."'></td>
		</tr>
		<tr>
			<td id='formtdlabel'><label>Phone:</label></td>
			<td><input type='text' name='phone' required value='".$row['phone']."'></td>
		</tr>
		<tr>
			<td id='formtdlabel'><label>Date of Birth:</label></td>
			<td><input type='date' name='dob' value='".$row['date_of_birth']."' required></td>
		</tr>
		<tr>
			<td id='formtdlabel'><label>Password:</label></td>
			<td><input type='text' name='pass' value='".$row['password']."' required></td>
		</tr>
		<tr>
			<td id='formtdlabel'><label>User Type:</label></td>
			<td><select name='usertype' required>
				<option value='admin' "; echo $row['usertype'] == "admin" ? "selected " : "" ; echo ">Admin</option>
				<option value='cso' "; echo $row['usertype'] == "cso" ? "selected " : "" ; echo ">CSO</option>
                <option value='personnel' "; echo $row['usertype'] == "personnel" ? "selected " : "" ; echo ">Personnel</option>
				<option value='hrpersonnel' "; echo $row['usertype'] == "hrpersonnel" ? "selected " : "" ; echo ">Human Resource Personnel</option>
			</select></td>
		</tr>";
		?>
		<tr>
			<td></td>
			<td><br /><button type="submit" name="submit">Save Edited User</button>
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
</body>
</html>