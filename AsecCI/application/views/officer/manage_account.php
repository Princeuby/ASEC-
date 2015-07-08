			<header>
				<h2 class="alt">Manage <strong>Account</strong></h2>
			</header>
		    
			<p class="error"><?php echo $this->session->flashdata('error'); ?></p>
			<section class="5u 9u$(mobile) center">
				<?php echo form_open("$designation/manage_account"); ?>
					<label>Old Password:<br><input type="password" name="pass" required></label>
					<label>New Password:<br><input type="password" name="pass-new-1" required></label>
					<label>New Password Again:<br><input type="password" name="pass-new-2" required></label>
					<button name='change-password' value='change'>Change</button>
				<?php echo form_close(); ?>
			</section>
		</div>
	</section>
</div>