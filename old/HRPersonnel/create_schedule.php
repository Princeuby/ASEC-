<?php
    include_once '../includes/db_connect.php';
    session_start();
    ?>
<?php
    include_once '../includes/db_connect.php';
    $t = time();
    $num_of_times = [];
	$result = $mysqli->query("SELECT user_id, firstname, lastname FROM user WHERE usertype='personnel'");
	for ($i = 0; $i < $result->num_rows; $i++) {
		$row = $result->fetch_array();
		$num_of_times["$row[0]"] = 0;
	}

	$days = ["Monday", "Tuesday", "Wednesday", "Thursday", "Friday", "Saturday", "Sunday"];
	$shifts = ["Morning", "Afternoon", "Night"];
	$mysqli->query("DELETE FROM scheduling");
	shuffle($days);
	foreach ($days as $day) {
		$available = $num_of_times;
		$result = $mysqli->query("SELECT * FROM location");
		for ($i = 0; $i < $result->num_rows; $i++) {
			$row = $result->fetch_assoc();
			foreach ($shifts as $shift) {
				for ($j = 0; $j < $row["$shift"]; $j++) {
					
					if (count($num_of_times) == 0)
						break 4;
					if (count($available) == 0)
						break 2;

					do {
						$staff_id = array_rand($available);

						// $mysqli->query("INSERT INTO scheduling VALUES ('$staff_id', '$row[Location]', '$shift', '$day')");
    					if ($stmt = $mysqli->prepare("INSERT INTO scheduling VALUES(?, ?, ?, ?)")) {
    						$stmt->bind_param('ssss', $staff_id,$row['Location'],$shift,$day); 
        					$stmt->execute();
        				}

					} while ($mysqli->connect_errno); // Loop continues if there was a failure in inserting a staff	

					$num_of_times["$staff_id"]++;
					
					if ($num_of_times["$staff_id"] == 5)
						unset($num_of_times["$staff_id"]);
					
					unset($available["$staff_id"]);
				}
			}
		}
	}
    // echo time()-$t;s

	header("Location: ./view_schedule.php");
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
  <li><a href="next_kin.php">Next of Kin</a></li>
  <li class="select"><a href="schedule.php">Staff Scheduling</a></li>
  <li><a href="application.php">Staff Application</a></li>

 </ul>
</div>
<div class="content">
<?php

?>
</div>
</div>
<footer>
<div id="footer">
Copyright &copy; 2015 Emmanuel and Essien
</div>
</footer>
<html>
</body>