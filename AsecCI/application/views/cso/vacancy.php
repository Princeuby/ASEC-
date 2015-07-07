			<header>
				<h2 class="alt">Create <strong>Vacancy</strong></h2>
			</header>
			<section class="center">
				<p class="error"><?php echo $this->session->flashdata('vacancy_failed'); ?></p>
				<section id="createvacancy" class="6u 12u$(mobile) center">
					<hr>
					<?php echo form_open("$designation/add_vacancy"); ?>
						<label>Closing Date: <br><input name="vacant-closing-date" class="datepickr"></label>
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
						<input name="Submit" type="submit" value="Create Vacancy">
					</form>
				</section>
			</section>
		</div>
	</section>
</div>
	<script src="<?php echo base_url('assets/js/datepickr.min.js'); ?>"></script>
        <script>
            // Regular datepickr
            datepickr('#datepickr');

            // Custom date format
            datepickr('.datepickr', { minDate: new Date().getTime(), dateFormat: 'Y-m-d'});

            // Min and max date
            datepickr('#minAndMax', {
                // few days ago
                minDate: new Date().getTime() - 2.592e8,
                // few days from now
                maxDate: new Date().getTime() + 2.592e8
            });

            // datepickr on an icon, using altInput to store the value
            // altInput must be a direct reference to an input element (for now)
            datepickr('.calendar-icon', { altInput: document.getElementById('calendar-input') });

            // If the input contains a value, datepickr will attempt to run Date.parse on it
            datepickr('[title="parseMe"]');

            // Overwrite the global datepickr prototype
            // Won't affect previously created datepickrs, but will affect any new ones
            datepickr.prototype.l10n.months.shorthand = ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'June', 'July', 'Aug', 'Sept', 'Cct', 'Nov', 'Dec'];
            datepickr.prototype.l10n.months.longhand = ['January', 'February', 'March', 'April', 'May', 'June', 'July', 'August', 'September', 'October', 'November', 'December'];
            datepickr.prototype.l10n.weekdays.shorthand = ['Sun', 'Mon', 'Tue', 'Wed', 'Thur', 'Fri', 'Sat'];
            datepickr.prototype.l10n.weekdays.longhand = ['Sunday', 'Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday', 'Saturday'];
            datepickr('#someEnglish.please', { dateFormat: '\\ j F Y' });
        </script>
