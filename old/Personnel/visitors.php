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
<a style="text-decoration:none;text-align:right;color:#fff;font-size:15px;"href="../logout.php"><p class="logout">LogOut</p></a></p>
 
</div>


<div class="nav">
<ul>
  <li><a href="./home.php">Validation</a></li>
  <li><a href="./case.php">Case</a></li>
  <li><a href="./sign.php"> Student Sign In/Out</a></li>
  <li class="select"><a href="./visitors.php">Visitors</a></li>
  <li><a href="./schedule.php">Schedule</a></li>
 </ul>
</div>
<div class="content">
    <table id="iconTable">
        <tr>
            <td class="icon"><a style="text-decoration:none" href="./check_in.php"><img class="iconImage" src="../images/check-in.png"/><br/>Check In Visitor</a></td>
            <td class="icon"><a style="text-decoration:none" href="./check_out.php"><img class="iconImage" src="../images/check-out.png"/><br/>Check Out Visitor</a></td>
            <td class="icon"><a style="text-decoration:none" href="./add_visitor.php"><img class="iconImage" src="../images/user-up.png"/><br/>Add Visitor</a></td>
            <td class="icon"><a style="text-decoration:none" href="./view_visitor.php"><img class="iconImage" src="../images/user-view.png"/><br/>View Visitors</a></td>

        </tr>
    </table>
</div>
<footer>
<div id="footer">
Copyright &copy; 2015 Emmanuel and Essien
</div>
</footer>

</body>
</html>