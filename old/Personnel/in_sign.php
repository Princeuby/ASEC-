<?php
    include_once '../includes/db_connect.php';
    session_start();
?>



<?php
    include_once '../includes/db_connect.php';
    
 
    if (isset($_POST['submit'])) {

    if ($stmt = $mysqli->prepare("INSERT INTO `girls_visitors` VALUES (?,?,?,?,?,?,?)")) {
    	$time_in = date("Y-m-d H:i:s",time());
        $stmt->bind_param('sssssss', $_POST['vistor_id'],$_POST['name'],$_POST['phone'],$_POST['visitee'],$_POST['room'],$time_in,$_POST['dorm']); 
        $stmt->execute();  
        header("Location: ./sign.php");
        exit();
    } else {
        $_SESSION['err'] = "Database error: cannot prepare statement";
        header("Location: ./home.php");
        exit();
    }
}
    $staff = $_GET['id'];
	$sql = "SELECT * FROM Student WHERE Student_ID = '$staff'";
	$result = $mysqli->query($sql);
	$row = $result->fetch_assoc();

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
  <li class="select"><a href="./sign.php"> Student Sign In/Out</a></li>
  <li><a href="./vistors.php">Visitors</a></li>
  <li><a href="./schedule.php">Schedule</a></li>
 
 </ul>
</div>
<div class="content">
	<div id="formTable">
<p class="centerText textbig">Sign In User Details</p><br />
	<form action="in_sign.php" method="POST">
	<table>
		<?php
		echo "<tr>
			<td id='formtdlabel'><label>Vistors ID:</label></td>
			<td><input type='text' name='vistor_id' value='".$row['Student_ID']."'required readonly></label></td>
		</tr>
		<tr>
			<td id='formtdlabel'><label>Name:</label></td>
			<td><input type='text' name='name' required value='".$row['First_Name']." ".$row['Last_Name']."'required readonly></td>
		</tr>
		<tr>
			<td id='formtdlabel'><label>Phone Number:</label></td>
			<td><input type='text' name='phone' required value='".$row['Phone_Number']."'required readonly></td>
		</tr>
		<tr>
			<td id='formtdlabel'><label>Whom to Visit:</label></td>
			<td><input type='text' name='visitee' required></td>
		</tr>
		<tr>
			<td id='formtdlabel'><label>Room Number:</label></td>
			<td><input type='text' name='room' required></td>
		</tr>
		<tr>
			<td id='formtdlabel'><label>Dorm:</label></td>
			<td><select name='dorm' required>
				<option selected disabled>--Choose One--</option>
                <option value='BB'>Dorm BB</option>
                <option value='EE'>Dorm EE</option>
                <option value='FF'>Dorm FF</option>
                <option value='GVolpi'>Dorm Gabriele Volpi</option>

			</select></td>
		</tr>
		";
		?>
		<tr>
			<td></td>
			<td><br /><button type="submit" name="submit">Sign In</button>
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