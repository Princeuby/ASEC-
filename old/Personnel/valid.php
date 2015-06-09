<?php
    include_once '../includes/db_connect.php';
    session_start();
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
</div>


<div class="nav">
<ul>
  <li class="select"><a href="./home.php">Validation</a></li>
  <li><a href="./case.php">Case</a></li>
  <li><a href="./sign.php">Student Sign In/Out</a></li>
  <li><a href="./visitors.php">Visitors</a></li>
  <li><a href="./schedule.php">Schedule</a></li>
 </ul>
</div>
<div class="content">
	<?php
    if (isset($_POST['submit'])) {
        $search = $_POST['search'];
        $id = $_POST['id'];
        $id_type = '';
        switch ($search) {
            case 'security_staff':
                $id_type = 'Security_Staff_ID';
                break;
            case 'staff':
                $id_type = 'Staff_ID';
                break;
            case 'student':
                $id_type = 'Student_ID';
                break;
            case 'cab_driver':
                $id_type = 'Car_Number';
                break;
            case 'faculty':
                $id_type = 'Faculty_ID';
                break;
            case 'visitor':
                $id_type = 'Visitor_ID';
                break;
        }
        $stmt = $mysqli->query("SELECT * FROM $search WHERE $id_type='$id'");
        
        if ($stmt->num_rows == 1) {
            echo "<table border='1' style='border:4px solid blue'>";
            echo "<h1 style='color: blue'>DETAILS</h1>";
            // echo "<th align='left'>Value</th>";
            $row = $stmt->fetch_assoc();
            // foreach ($row as $value) {
            foreach ($row as $key => $value) {
                echo "<tr>";
                echo "<td>$key</td>";
                echo "<td>$value</td>";
                echo "</tr>";
            }
            echo "</table>";
            echo "<a href='./home.php'><br/><br/>Search Again</a>";
        } else {
            header("Location: ./no.html");
            exit();
        }
    }
    ?>
</div>
<footer>
<div id="footer">
Copyright &copy; 2015 Emmanuel and Essien
</div>
</footer>

</body>
</html>