			<style> /* I had to do this */
				#successapplicants { display: <?php echo $display_success_applicants; ?>; }
				#newofficer { display: <?php echo $add_new_officer; ?>; }
			</style>
				<header>
					<h2 class="alt">Add<strong> Officer</strong></h2>
				</header>
				<section class="center">
					<p class="error"><?php echo $this->session->flashdata('create_failed'); ?></p>
					<?php echo "<span><h3>$no_applicants</h3></span>"; ?>
					<section id="successapplicants">
						<hr><br>
						<table>
							<thead>
								<tr>
									<th></th>
									<th>Applicant Name</th>
									<th>Phone Number</th>
									<th>Email</th>
									<th>Position Applied</th>
									<th>Department</th>
								</tr>
							</thead>
							<?php echo form_open("$designation/add_officer") ?>
							<tbody>
								<?php foreach ($applicants as $app):?>
									<?php
										echo "<tr>";
											$applicantName = $app['first_name'].' '.$app['last_name'];
											echo "<td><button class='link-button' name='addApp' value='$app[applicant_id]'>Add</button></td>";
											echo "<td>$applicantName</td>";
											echo "<td>$app[phone_number]</td>";
											echo "<td>$app[email_address]</td>";
											echo "<td>$app[position]</td>";
											echo "<td>$app[department]</td>";
										echo "</tr>";
									?>
								<?php endforeach ?>
							</tbody>
							<?php echo form_close(); ?>
						</table>
					</section>
					<section id="newofficer" class="5u 6u$(mobile) center">
						<script> window.location.hash = "newofficer"; </script>
						<?php echo form_open("$designation/create_officer") ?>
							<?php 
								echo "<label>Officer ID: <br><input required type='text' name='create-officer-id' class='size-input' value=''></label>";
								echo "<label>Employment Date: <br><input required type='text' name='create-date-of-emp' class='size-input' id='datepickr' value=''></label>";
								echo "<label>Date of Birth: <br><input type='text' name='create-date-of-birth' class='size-input' id='datepickr' value=''></label>";
								echo "<label>First Name: <br><input readonly required type='text' name='create-first-name' class='size-input' value='$selected_applicant[first_name]'></label>";
								echo "<label>Middle Name: <br><input readonly type='text' name='create-middle-name' class='size-input' value='$selected_applicant[middle_name]'></label>";
								echo "<label>Last Name: <br><input readonly required type='text' name='create-last-name' class='size-input' value='$selected_applicant[last_name]'></label>";
								echo "<label>Gender: <br><select required name='create-gender' class='size-input'>
										<option value='' disabled selected>Select: </option>
										<option value='Male'>Male</option>
										<option value='Female'>Female</option>
									</select></label>";
								echo "<label>Rank: <br><input readonly required type='text' name='create-rank' class='size-input' value='$selected_applicant[position]'></label>";
								echo "<label>Department: <br><input readonly type='text' name='create-department' class='size-input' value='$selected_applicant[department]'></label>";
								echo "<label>Password: <br><input readonly type='text' name='create-password' class='size-input' value='pass'></label>";
								echo "<input type='hidden' name='create-applicant-id' value='$selected_applicant[applicant_id]'>";
								echo "<input type='submit' name='creOff' id='creOff' value='Create Officer'>";
							?>
						<?php echo form_close(); ?>
					</section>
				</section>
			</div>
	</section>
</div>