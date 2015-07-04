		<style> /* I had to do this */
			#training_records { display: <?php echo $display_scheduledTraining; ?>; }
			#applicant_training { display: <?php echo $training_applicant; ?>; }
		</style>
				<header>
					<h2 class="alt">Applicants for Training <strong><?php echo $job_position['position']; ?></strong></h2>
				</header>
				<section class="center">
					<?php echo "<span><h3>$no_scheduledTraining</h3></span>"; ?>
					<?php echo "<span><h3>$can_training</h3></span>"; ?>
					<section id="training_records">
						<?php echo form_open("$designation/scheduled_training"); ?>
						<h3>Applicant Details</h3>
						<hr>
						<table>
							<thead>
								<tr>
									<th>Applicant Name</th>
									<th>Phone Number</th>
									<th>Email Address</th>
									<th>Training Date</th>
									<th></th>
								</tr>
							</thead>
							<tbody>
								<?php 
									foreach ($selected_scheduledTraining as $training) {
										echo "<tr>";
											$applicant_name = $training['first_name'].' '.$training['last_name'];
											echo "<td>$applicant_name</td>";
											echo "<td>$training[phone_number]</td>";
											echo "<td>$training[email_address]</td>";
											echo "<td>$training[training_date]</td>";
											echo "<td><button class='link-button' name='traApp' value='$training[applicant_id]'>
												Review</button></td>";
										echo "</tr>";
									}
								?>
							</tbody>
						</table>
						<?php echo form_close(); ?>
						<section id="applicant_training">
							<script type="text/javascript">window.location.hash = 'applicant_training';</script>
							<hr>
							<p class="10u 12u$(mobile) center">
							<section id="incidents"><div class="10u 12u$(mobile) center"><article>
								<header>
									<strong>Officer: </strong><span class="blue-text"><?php $applicantName = $selected_applicant['first_name'].' '.$selected_applicant['last_name']; echo "$applicantName";?></span><br>
									<strong>Phone Number: </strong><span class="blue-text"><?php echo $selected_applicant['phone_number'];?></span><br>
									<strong>Email: </strong><span class="blue-text"><?php echo $selected_applicant['email_address'];?></span><br>
								</header>
								<strong>Training Date: </strong><span class="blue-text"><?php echo $selected_applicant['training_date'];?></span><br>
								<strong>Training Location: </strong><span class="blue-text"><?php echo $selected_applicant['training_location'];?></span><br>
							</article></div></section>
							</p>
							<section class="6u 6u$(mobile) center">
							<?php echo form_open("$designation/add_applicant_training") ?>
								<?php 
									echo "<label>Approval Status: <select required name='applicant-success-status' class='size-input'>
											<option value='' disabled selected>Choose Status: </option>
											<option value='Not Approved'>Not Approved</option>
											<option value='Approved'>Approved</option>
										</select></label>";
									echo "<input type='hidden' name='buttonAppID' value='$selected_applicant[applicant_id]'>";
									echo "<input type='submit' name='submit' id='addAppTra' value='Add Review'>";
								?>
							<?php echo form_close(); ?>
							</section>
						</section>
					</section>
				</section>

			</div>
	</section>
</div>	