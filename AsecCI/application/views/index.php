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
</body>