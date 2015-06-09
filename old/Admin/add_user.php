<?php
    include_once '../includes/db_connect.php';
   
 
    if (isset($_POST['submit'])) {

    if ($stmt = $mysqli->prepare("INSERT INTO user VALUES(?, ?, ?, ?,?,?,?,?,?,?)")) {
        $pass = "asec";
        $stmt->bind_param('ssssssssss', $_POST['staff'],$pass,$_POST['firstname'],$_POST['lastname'],$_POST['email'],$_POST['phone'],$_POST['usertype'],$_POST['dob'],$_POST['gender'],$_POST['address']); 
        $stmt->execute();  
        header("Location: ./success_user.html");
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
<p class="centerText textbig" style='color: blue; margin-right:10%;'>Add User Details</p><br />
	<form action="add_user.php" method="POST">
	<table>
		
		<tr>
			<td id="formtdlabel"><label>Security Staff ID:</label></td>
			<td><input type="text" name="staff" required placeholder="e.g P.123..."></td>
		</tr>
		<tr>
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
			<td><input type="date" name="dob" required></td>
		</tr>
		<tr>
			<td id="formtdlabel"><label>User Type:</label></td>
			<td><select name="usertype" required>
				<option selected>Choose one</option>
				<option value="cso">CSO</option>
				<option value="personnel">Personnel</option>
				<option value="hrpersonnel">Human Resource Personnel</option>
			</select></td>
		</tr>
		<tr>
			<td></td>
			<td><br /><button type="submit" name="submit">Add User</button>
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
