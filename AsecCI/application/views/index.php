<!DOCTYPE HTML>
<html>
	<head>
		<title><?php echo $title; ?> | ASEC</title>
		<meta charset="utf-8" />
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<!--[if lte IE 8]><script src="assets/js/ie/html5shiv.js"></script><![endif]-->
		<link rel="icon" href="<?php echo base_url('assets/images/logo.png'); ?>">
		<link rel="stylesheet" href="<?php echo base_url('assets/css/main.css'); ?>">
		<link rel="stylesheet" href="<?php echo base_url('assets/css/custom.css'); ?>">
		<!--[if lte IE 8]><link rel="stylesheet" href="assets/css/ie8.css" /><![endif]-->
		<!--[if lte IE 9]><link rel="stylesheet" href="assets/css/ie9.css" /><![endif]-->
	</head>
	<body>
		<div class="wrapper blue">
			<div id="main" class="login">
				<section id="top" class="one dark cover blue">
					<div class="container">
						<header>
							<hr><h1>Security Management System</h1><hr>
							<section style="margin-left: 80%">
								<a style='color:white;' href="<?php echo base_url('vacancy');?>">Click to Apply>>></a>
							</section>
						</header>
						
						<section class="6u center size-panel">
							<img id="big-logo" class="center" src="<?php echo base_url('assets/images/logo.png'); ?>" />
						    <p class="error"><?php echo $this->session->flashdata('error'); ?></p>
							<?php echo validation_errors(); ?>
							<?php echo form_open('login') ?>
							    <label class="red-box"><input type="text" name="id" placeholder="Officer ID" class="size-input"
									value="<?php echo $officer['officer_id'];?>" required></label>
							    <label class="red-box"><input type="password" name="password" placeholder="Password" class="size-input" required></label><br>
							    <input type="submit" name="submit" value="Login">
							</form>
						</section>
					</div>
				</section>
			</div>
			<div class="push"></div>
		</div>
		<div id="footer" class="login">
			<!-- Copyright -->
			<ul class="copyright">
				<li>&copy; American University of Nigeria. All rights reserved.</li><li>Design: <a href="#">UNKNOWN</a></li>
			</ul>
		</div>	
	</body>
</html>
