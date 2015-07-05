			<header>
				<h2 class="alt">Application Form: <strong><?php echo $position; ?></strong></h2>
			</header>
			<section class="center">
				<p class="error"><?php echo $this->session->flashdata('failed_create'); ?></p>
				<?php echo form_open("vacancy/add_application"); ?>
					<hr/>
					<section class="4u 6u$(mobile) center">
						First Name: <input name="applicant-firstName" type="text">
						Middle Name: <input name="applicant-middleName" type="text">
						Last Name: <input name="applicant-lastName" type="text">
						Phone Number: <input name="applicant-phoneNumber" type="text" max="11">
						Email: <input name="applicant-email" type="text">
						Application Letter: <br><em>Only word documents supported</em>
							<input name="applicant-applicationLetter" type="file" accept="file_extension">
						Curriculum Vitae: <br><em>Only word documents supported</em>
							<input name="applicant-curriculumVitae" type="file" accept="file_extension">
					</section>
					<button name="applicant-apply" value="<?php echo $vacancyID; ?>"/>Apply</button>
				<?php echo form_close(); ?>
			</section>

		</div>
	</section>
</div>
