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
						<hr><br>
						<table>
							<thead>
								<tr>
									<th></th>
									<th>Applicant Name</th>
									<th>Phone Number</th>
									<th>Email Address</th>
								</tr>
							</thead>
							<tbody>
								<?php 
									foreach ($selected_applicantsReview as $review) {
										echo "<tr>";
											$applicant_name = $review['first_name'].' '.$review['last_name'];
											echo "<td><button class='link-button' name='revApp' value='$review[applicant_id]'>
												Review</button></td>";
											echo "<td>$applicant_name</td>";
											echo "<td>$review[phone_number]</td>";
											echo "<td>$review[email_address]</td>";
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
							<section id="incidents"><div class="10u 12u$(mobile) center"><article>
								<header>
									<strong>Officer: </strong><span class="blue-text"><?php $applicantName = $selected_applicant['first_name'].' '.$selected_applicant['last_name']; echo "$applicantName";?></span><br>
									<strong>Phone Number: </strong><span class="blue-text"><?php echo $selected_applicant['phone_number'];?></span><br>
									<strong>Email: </strong><span class="blue-text"><?php echo $selected_applicant['email_address'];?></span><br>
								</header>
								<strong>Application Letter: </strong>
								<?php	
									if ($selected_applicant['application_letter']) {
										echo "<a href='".base_url("$selected_applicant[application_letter]")."'>";
										echo "Click to Download</a>";
									}
								?>								
								<br>
								<strong>Curriculum Vitae: </strong>
								<?php	
									if ($selected_applicant['curriculum_vitae']) {
										echo "<a href='".base_url("$selected_applicant[curriculum_vitae]")."'>";	
										echo "Click to Download</a>";
									}
								?>
								<br>
							</article></div></section>
							</p>
							<section class="6u 6u$(mobile) center">
							<?php echo form_open("$designation/add_applicant_review") ?>
								<?php 
									echo "<label>Interview Date: <br><input type='text' class='datepickr' name='applicant-interview-date' 
										class='size-input'></label>";
									echo "<label>Interview Location: <textarea name='applicant-interview-location'></textarea></label><br>";
									echo "<label>Approval Status: <br><select required name='applicant-interview-status' class='size-input'>
											<option value='' disabled selected>Choose Status: </option>
											<option value='Not Approved'>Not Approved</option>
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