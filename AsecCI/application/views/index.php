<body>
	<div id="main" class="login">
		<section id="top" class="one dark cover">
			<div class="container">

				<header>
					<h2 class="alt">Please provide valid <strong>login</strong> details</h2>
				</header>

				<section>
					<?php echo validation_errors(); ?>

					<?php echo form_open('login') ?>
					
					    <label for="id">id</label>
					    <input type="text" name="id"><br>
					
					    <label for="password">Password</label>
					    <input type="password" name="password"><br>
					
					    <input type="submit" name="submit" value="Login" />
					
					</form>
				</section>

			</div>
		</section>
	</div>
</body>