<body>
	<div id="main" class="login">
		<section id="top" class="one dark cover">
			<div class="container">
				<header>
					<hr><h1>Security Management System</h1><hr>
				</header>

				<section class="6u center">
					<img id="logo" src="<?php echo site_url('assets/images/logo.png'); ?>" />
					<?php echo validation_errors(); ?>
					<?php echo form_open('login') ?>
					    <label class="red-box"><input type="text" name="id" placeholder="Officer ID"></label>
					    <label class="red-box"><input type="password" name="password" placeholder="Password"></label><br>
					    <input type="submit" name="submit" value="Login">
					</form>
				</section>

			</div>
		</section>
	</div>
	<div id="footer" class="login">
		<!-- Copyright -->
		<ul class="copyright">
			<li>&copy; American University of Nigeria. All rights reserved.</li><li>Design: <a href="#">UNKNOWN</a></li>
		</ul>

	</div>

		<!-- Scripts -->
	<script src="assets/js/jquery.min.js"></script>
	<script src="assets/js/jquery.scrolly.min.js"></script>
	<script src="assets/js/jquery.scrollzer.min.js"></script>
	<script src="assets/js/skel.min.js"></script>
	<script src="assets/js/util.js"></script>
	<!--[if lte IE 8]><script src="assets/js/ie/respond.min.js"></script><![endif]-->
	<script src="assets/js/main.js"></script>
	
</body>
</html>
