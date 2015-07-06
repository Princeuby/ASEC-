			<header>
				<h2 class="alt">Application Form: <strong><?php echo $position; ?></strong></h2>
			</header>
			<section class="center">
				<p class="error"><?php echo $this->session->flashdata('failed_create'); //echo $error[0];?></p>
				<?php echo form_open_multipart("vacancy/add_application"); ?>
					<hr/>
					<section class="5u 8u$(mobile) center">
						First Name: <input class="" name="applicant-firstName" type="text">
						Middle Name: <input class="size-input" name="applicant-middleName" type="text">
						Last Name: <input class="size-input" name="applicant-lastName" type="text">
						Phone Number: <input class="size-input" name="applicant-phoneNumber" type="text" max="11">
						Email: <input class="size-input" name="applicant-email" type="email">
						Application Letter: <br><em>Only word documents supported</em>
							<input class="size-input" name="applicant-applicationLetter" type="file"><br>
						Curriculum Vitae: <br><em>Only word documents supported</em>
							<input class="size-input" name="applicant-curriculumVitae" type="file">
					</section>
					<button name="applicant-apply" value="<?php echo $vacancyID; ?>"/>Apply</button>
				<?php echo form_close(); ?>
			</section>

		</div>
	</section>
</div>
