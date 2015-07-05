			<header>
				<h2 class="alt">Create <strong>Vacancy</strong></h2>
			</header>
			<section class="center">
				<p class="error"><?php echo $this->session->flashdata('vacancy_failed'); ?></p>
				<section id="createvacancy" class="6u 12u$(mobile) center">
					<hr>
					<?php echo form_open("$designation/add_vacancy"); ?>
						<label>Position: <input type="text" name="vacant-position" required></label>
						<label>Position Summary: <textarea name="vacant-summary"></textarea></label>
						<label>Department: <input type="text" name="vacant-department" required></label>
						<label>Education Level: <br><select name="vacant-education-level" class='size-input' required>
								<option value='' disabled selected>Select Level:</option>
								<option value='Primary'>Primary</option>
								<option value='WAEC/JAMB/GCE'>WAEC/JAMB/GCE</option>
								<option value='OND/HND/NCE'>OND/HND/NCE</option>
								<option value='Bachelors Degree'>Bachelors Degree</option>
								<option value='Masters Degree'>Masters Degree</option>
								<option value='PhD'>PhD</option>
							</select></label>
						<label>Working Experience: <textarea name="vacant-working-experience"></textarea></label>
						<label>Other Specifiations: <textarea name="vacant-other-specifications"></textarea></label>
						<label>Closing Date: <input type="date" name="vacant-closing-date" min="<?php echo date('Y-m-d'); ?>"></label>
						<input name="Submit" type="submit" value="Create Vacancy">
					</form>
				</section>
			</section>
		</div>
	</section>
</div>
