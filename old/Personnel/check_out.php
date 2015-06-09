
<?php
    include_once '../includes/db_connect.php';
    session_start();
?>
<?php
	include_once '../includes/db_connect.php';
    
 
    if (isset($_POST['submit'])) {
    	$id = $_POST['id'];
    
        if ($stmt = $mysqli->prepare("DELETE FROM `Vistors_Check` WHERE Visitor_ID=?")) {
    		$stmt->bind_param('s',$id);
    		$stmt->execute();
    		$stmt->store_result();
    		header("Location: ./visitors.php");
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
	<table id="iconTable">
		<form action="./check_out.php" method="POST">
		<tr>
		      <td><label> Enter ID </label></td>
			<td><input type="text" name="id"></td>
		</tr>
        <tr><td></td>
			<td><button type="submit" name="submit">Sign Out</button>
			<input type="button" value="Cancel"></td>
		</tr>
	</form>
	</table>
</div>
<footer>
<div id="footer">
Copyright &copy; 2015 Emmanuel and Essien
</div>
</footer>

</body>
</html>