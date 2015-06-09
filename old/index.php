
<?php
	session_start();
	include_once './includes/db_connect.php';
	$sql = "SELECT * FROM Portal WHERE portal_status='Open'";
	$result = $mysqli->query($sql);
	if ($result->num_rows > 0) {          
		$msg = "<a style='color:white;' href='application.php'>Click to Apply>>></a>";
	} else {
		$msg = "";
	}

?>
<!DOCTYPE html>
<html>
	
<head>
	<title>Login | ASEC</title>
		<meta charset="utf-8">
		<link href="css/style.css" rel='stylesheet' type='text/css' />
		<link rel="shortcut icon" href="./images/bg.png" type="text/css">
		<link rel="icon" href="./images/bg.png" type="text/css">
		
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<script type="application/x-javascript"> addEventListener("load", function() { setTimeout(hideURLbar, 0); }, false); function hideURLbar(){ window.scrollTo(0,1); } </script>
		<!--webfonts-->
		<link href='http://fonts.googleapis.com/css?family=Open+Sans:600italic,400,300,600,700' rel='stylesheet' type='text/css'>
		<!--//webfonts-->
</head>
<body>
	<div class="banner">
		<hr></hr>
		<p class="textbig">
			Security Management System
		</p>
		<p class="textmid">
		American University of Nigeria
	</p>
		<hr></hr>
		<div style="margin-left: 80%" class="application">
			<?php echo $msg; ?>
						<p></p>
					</div>

	</div>
	
				 <!-----start-main---->
				<div class="login-form">
						<!--<h1>Login</h1>-->
				<img id="logo" src="images/bg.png" />
				
				<form action="./includes/process_login.php" method="POST">
					<li>
						<input name="username" type="text" class="text" placeholder="User ID" required="required"/><a href="#" class=" icon user"></a>
					</li>
					<li>
						<input name="password" type="password" placeholder="password" required="required"/><a href="#" class=" icon lock"></a>
					</li>
					
					 <div class ="forgot">
						<h3><a href="#">Forgot Password?</a></h3>
						<input type="submit" onclick="myFunction()" value="Login" > <a href="#" class=" icon arrow"></a>
					</div>
									</form>

			</div>
			<div class="error">
				<?php
					if (isset($_SESSION['error'])) {
					echo "<p>Sorry, ". $_SESSION['error']. "</p>";
					session_destroy();
				}
				?>
			</div>
			<!--//End-login-form-->
			


		  <!-----start-copyright---->
   					<div class="footer">
   						<hr></hr>
						<p>Emma and Essien &copy; 2015</p> 
					</div>
				<!-----//end-copyright---->
		 		
</body>
</html>