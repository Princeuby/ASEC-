			<style> /* I had to do this */
				#successapplicants { display: <?php echo $display_success_applicants; ?>; }
				#newofficer { display: <?php echo $add_new_officer; ?>; }
			</style>
				<header>
					<h2 class="alt">Add<strong> Officer</strong></h2>
				</header>
				<section class="center">
					<p class="error"><?php echo $this->session->flashdata('failed_add'); ?></p>
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
					<section id="newofficer">
						
					</section>
				</section>
			</div>
	</section>
</div>