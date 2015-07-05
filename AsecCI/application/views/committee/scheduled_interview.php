		<style> /* I had to do this */
			#interview_records { display: <?php echo $display_scheduledInterview; ?>; }
			#applicant_interview { display: <?php echo $interview_applicant; ?>; }
		</style>
				<header>
					<h2 class="alt">Applicants to Interview <strong><?php echo $job_position['position']; ?></strong></h2>
				</header>
				<section class="center">
					<?php echo "<span><h3>$no_scheduledInterview</h3></span>"; ?>
					<p class="error"><?php echo $this->session->flashdata('can_interview'); ?></p>
					<section id="interview_records">
						<?php echo form_open("$designation/scheduled_interview"); ?>
						<h3>Applicant Details</h3>
						<hr><br>
						<table>
							<thead>
								<tr>
									<th>Applicant Name</th>
									<th>Phone Number</th>
									<th>Email Address</th>
									<th>Interview Date</th>
									<th></th>
								</tr>
							</thead>
							<tbody>
								<?php 
									foreach ($selected_scheduledInterview as $interview) {
										echo "<tr>";
											$applicant_name = $interview['first_name'].' '.$interview['last_name'];
											echo "<td>$applicant_name</td>";
											echo "<td>$interview[phone_number]</td>";
											echo "<td>$interview[email_address]</td>";
											echo "<td>$interview[interview_date]</td>";
											echo "<td><button class='link-button' name='intApp' value='$interview[applicant_id]'>
												Review</button></td>";
										echo "</tr>";
									}
								?>
							</tbody>
						</table>
						<?php echo form_close(); ?>
						<section id="applicant_interview">
							<script type="text/javascript">window.location.hash = 'applicant_interview';</script>
							<hr>
							<p class="10u 12u$(mobile) center">
							<section id="incidents"><div class="10u 12u$(mobile) center"><article>
								<header>
									<strong>Officer: </strong><span class="blue-text"><?php $applicantName = $selected_applicant['first_name'].' '.$selected_applicant['last_name']; echo "$applicantName";?></span><br>
									<strong>Phone Number: </strong><span class="blue-text"><?php echo $selected_applicant['phone_number'];?></span><br>
									<strong>Email: </strong><span class="blue-text"><?php echo $selected_applicant['email_address'];?></span><br>
								</header>
								<strong>Interview Date: </strong><span class="blue-text"><?php echo $selected_applicant['interview_date'];?></span><br>
								<strong>Interview Location: </strong><span class="blue-text"><?php echo $selected_applicant['interview_location'];?></span><br>
							</article></div></section>
							</p>
							<section class="6u 6u$(mobile) center">
							<?php echo form_open("$designation/add_applicant_interview") ?>
								<?php 
									echo "<label>Training Date: <input type='date' min='".date('Y-m-d')."' name='applicant-training-date' 
										class='size-input'></label>";
									echo "<label>Training Location: <textarea name='applicant-training-location'></textarea></label><br>";
									echo "<label>Approval Status: <select required name='applicant-training-status' class='size-input'>
											<option value='' disabled selected>Choose Status: </option>
											<option value='Not Approved'>Not Approved</option>
											<option value='Approved'>Approved</option>
										</select></label>";
									echo "<input type='hidden' name='buttonAppID' value='$selected_applicant[applicant_id]'>";
									echo "<input type='submit' name='submit' id='addAppInt' value='Add Review'>";
								?>
							<?php echo form_close(); ?>
							</section>
						</section>
					</section>
				</section>

			</div>
	</section>
</div>	