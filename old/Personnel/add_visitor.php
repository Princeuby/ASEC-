<?php
    include_once '../includes/db_connect.php';
    session_start();
?>

<?php
    include_once '../includes/db_connect.php';
    
 
    if (isset($_POST['submit'])) {

    if ($stmt = $mysqli->prepare("INSERT INTO `asecdb`.`Visitor` (`Visitor_ID`, `First_Name`, `Middle_Name`, `Last_Name`, `Gender`, `Date_of_Birth`, `Marital_Status`, `Religion`, `Phone_Number`, `Email_Address`, `Street`, `City`, `LGA`, `State`, `Nationality`, `Work_Address`, `Security_Staff_ID`) VALUES (?, ?, ?,?,?,?,?,?,?,?,?,?,?,?,?,?,?)")) {
        $stmt->bind_param('sssssssssssssssss', $_POST['visitor'],$_POST['fname'],$_POST['mname'],$_POST['lname'],$_POST['gender'],$_POST['dob'],$_POST['marital'],$_POST['rel'],$_POST['phone'],$_POST['email'],$_POST['street'],$_POST['city'],$_POST['lga'],$_POST['state'],$_POST['national'],$_POST['work'],$_POST['security']); 
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
  <li><a href="./case.php">Case</a></li>
  <li><a href="./sign.php">Student Sign In/Out</a></li>
  <li class="select"><a href="./visitors.php">Visitors</a></li>
  <li><a href="./schedule.php">Schedule</a></li>
  
 
 </ul>
</div>
<div class="content">
	<div id="formTable">
<p class="centerText textbig"style='color: blue; margin-right:5%;'>Add Visitor Details</p><br />
	<form action="add_visitor.php" method="POST">
	<table>
		
		<tr>
			<td id="formtdlabel"><label>Visitor ID:</label></td>
			<td><input type="text" name="visitor" required placeholder="e.g V0001"></td>
		</tr>
		<tr>
			<td id="formtdlabel"><label>First Name:</label></td>
			<td><input type="text" name="fname" required placeholder="e.g Paul"></td>
		</tr>
		<tr>
			<td id="formtdlabel"><label>Middle Name:</label></td>
			<td><input type="text" name="mname" required placeholder="e.g Emmanuel"></td>
		</tr>
		<tr>
			<td id="formtdlabel"><label>Last Name:</label></td>
			<td><input type="text" name="lname" required placeholder="e.g John"></td>
		</tr>
		
		<tr>
			<td id="formtdlabel"><label>Gender:</label></td>
			<td><select name="gender" required>
					<option value="Male">Male </option>
					<option value="Female">Female </option>
					
			</select>
			</td>

		</tr>
		<tr>
			<td id="formtdlabel"><label>Date of Birth:</label></td>
			<td><input type="date" name="dob" required placeholder="e.g 1988/2/03"></td>
		</tr>
		<tr>
			<td id="formtdlabel"><label>Marital Status:</label></td>
			<td><select name="marital" required>
					<option value="Single">Single </option>
					<option value="Married">Married </option>
					<option value="Widowed">Widowed </option>
					<option value="Widower">Widower </option>
					<option value="Divorced">Divorced</option>
			</select>
			</td>
		</tr>

		<tr>
			<td id="formtdlabel"><label>Religion:</label></td>
			<td><input type="text" name="rel" required placeholder="e.g Christain"></td>
		</tr>
		<tr>
			<td id="formtdlabel"><label>Phone Number:</label></td>
			<td><input type="text" name="phone" required placeholder="e.g 08137483678"></td>
		</tr>
		<tr>
			<td id="formtdlabel"><label>Email Address:</label></td>
			<td><input type="text" name="email" required placeholder="e.g Paul.john@yahoo.com"></td>
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
			<td><input type="text" name="state" required placeholder="Adamawa"></td>
		</tr>
		<tr>
			<td id="formtdlabel"><label>Nationality:</label></td>
			<td><input type="text" name="national" required placeholder="e.g Nigerian"></td>
		</tr>
		<tr>
			<td id="formtdlabel"><label>Work Address:</label></td>
			<td><input type="text" name="work" required placeholder="e.g ABTI Academy, Yola"></td>
		</tr>
		<tr>
			<td id="formtdlabel"><label>Security Staff ID:</label></td>
			<td><input type="text" name="security" required placeholder="e.g p1234"></td>
		</tr>
			

			<td></td>
			<td><br /><button type="submit" name="submit">Add Visitor</button>
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