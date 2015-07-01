			<header>
				<h2 class="alt">Create <strong>Vacancy</strong></h2>
			</header>
			<section class="center">
				<?php echo "<span><h3>$failed_create</h3></span>"; ?>
				<section id="createvacancy" class="4u 12u$(mobile) center">
					<hr/>
					<?php echo form_open("$designation/vacancy"); ?>
						Position: <span><input type="text" name="vacant-position"></span>
						Department: <span><input type="text" name="vacant-department"></span>
						Education Level: <span><select name="vacant-education-level" class='size-input'>
								<option value='' disabled selected>Choose:</option>
								<option value='Primary'>Primary</option>
								<option value='WAEC/JAMB/GCE'>WAEC/JAMB/GCE</option>
								<option value='OND/HND/NCE'>OND/HND/NCE</option>
								<option value='Bachelor Degree'>Bachelor Degree</option>
								<option value='Master Degree'>Master Degree</option>
								<option value='PHd'>PHd</option>
							</select></span><br/><br/>
						Working Experience: <span><textarea name="vacant-working-experience"></textarea></span>
						Other Specifiations: <span><textarea name="vacant-other-specifications"></textarea></span>
						<br/>Closing Date: <span><input type="date" name="vacant-closing-date" min="<?php echo date('Y-m-d'); ?>"></span>
						<br/><br/><input name="Submit" type="submit" value="Create Vacancy" />
					</form>
				</section>
			</section>

		</div>
	</section>
</div>
