		<style> /* I had to do this */
			#review_records { display: <?php echo $display_applicantsReview; ?>; }
			#applicant_review { display: <?php echo $review_applicant; ?>; }
		</style>
				<header>
					<h2 class="alt">Applicants to Review <strong><?php echo $job_position['position']; ?></strong></h2>
				</header>
				<section class="center">
					<?php echo "<span><h3>$no_applicantsReview</h3></span>"; ?>
					<section id="review_records">
						<?php echo form_open("$designation/applicants_review"); ?>
						<h3>Applicant Details</h3>
						<hr>
						<table>
							<thead>
								<tr>
									<th>Applicant Name</th>
									<th>Phone Number</th>
									<th>Email Address</th>
									<th></th>
								</tr>
							</thead>
							<tbody>
								<?php 
									foreach ($selected_applicantsReview as $review) {
										echo "<tr>";
											$applicant_name = $review['first_name'].' '.$review['last_name'];
											echo "<td>$applicant_name</td>";
											echo "<td>$review[phone_number]</td>";
											echo "<td>$review[email_address]</td>";
											echo "<td><button class='link-button' name='revApp' value='$review[applicant_id]'>
												Review</button></td>";
										echo "</tr>";
									}
								?>
							</tbody>
						</table>
						<?php echo form_close(); ?>
						<section id="applicant_review">
							<script type="text/javascript">window.location.hash = 'applicant_review';</script>
							<hr>
							<p class="10u 12u$(mobile) center">
								Officer: <span class="blue-text"><?php $applicantName = $selected_applicant['first_name'].' '.$selected_applicant['last_name']; echo "$applicantName";?></span><br>
								Phone Number: <span class="blue-text"><?php echo $selected_applicant['phone_number'];?></span><br>
								Email: <span class="blue-text"><?php echo $selected_applicant['email_address'];?></span><br>
								Application Letter: <span class="blue-text"><?php echo $selected_applicant['application_letter'];?></span><br>
								Curriculum Vitae: <span class="blue-text"><?php echo $selected_applicant['curriculum_vitae'];?></span><br>
							</p>
							<section class="6u 6u$(mobile) center">
							<?php echo form_open("$designation/add_applicant_review") ?>
								<?php 
									echo "<label>Interview Date: <input type='date' min='".date('Y-m-d')."' name='applicant-interview-date' 
										class='size-input'></label>";
									echo "<label>Approval Status: <select required name='applicant-interview-status' class='size-input'>
											<option value='Not Approved' selected>Not Approved</option>
											<option value='Approved'>Approved</option>
										</select></label>";
									echo "<input type='hidden' name='buttonAppID' value='$selected_applicant[applicant_id]'>";
									echo "<input type='submit' name='submit' id='addAppRev' value='Add Review'>";
								?>
							<?php echo form_close(); ?>
							</section>
						</section>
					</section>
				</section>

			</div>
	</section>
</div>	