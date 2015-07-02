			<header>
				<h2 class="alt"><strong>Job Description: <?php echo $selected_vacancy['position']; ?></strong></h2>
			</header>
			<section style="text-align: left;">
				<!-- &nbsp; -->
				<p><br>AUN is seeking for a permanent Payroll Accountant. 
				This position is a local one and opens to indigenous and/or legal residents of Nigeria
				<br>
				<br><strong>Title: <?php echo $selected_vacancy['position']; ?></strong>
				<br><strong>Department: <?php echo $selected_vacancy['department']; ?></strong>
				<br><strong>Opening Date: <?php echo $selected_vacancy['opening_date']; ?></strong>
				<br><strong>Closing Date: <?php echo $selected_vacancy['closing_date']; ?></strong>
				<br>
				<br><strong>SUMMARY OF POSITION</strong>
				<br><em>You will be an officer three and do what he does</em>
				</p><span>
				<strong>Working Experience</strong>
					<ul>
						<?php echo $selected_vacancy['working_experience']; ?>
					</ul>
				<strong>Other Requirements</strong>
					<ul>
						<li>Minimum Education requirement: <?php echo $selected_vacancy['education_level']; ?></li>
						<?php echo $selected_vacancy['other_specifications']; ?>
					</ul></span>
				<?php echo form_open('vacancy/applicants'); ?>
				<button class="center" name="apply-now" value="<?php echo $selected_vacancy['vacancy_id']; ?>">
					Click to Apply</button><?php echo form_close(); ?>
			</section>

		</div>
	</section>
</div>