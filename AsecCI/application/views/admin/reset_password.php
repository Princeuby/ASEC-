				<header>
					<h2 class="alt">Reset <strong>Password</strong></h2>
				</header>
				<section class="row">
					<div id="officer_search" class="6u 12u$(mobile) center">
						<?php echo form_open("$designation/reset_password"); ?>
							<label class='8u center'>Officer ID:<br>
							<input type="text" class='size-input' placeholder='P.123' name='id-officer'
								required></label>
						<button name='get-officer' value='get'>Get</button><br><br>
						<?php echo form_close(); ?>
					</div>
				</section>
				<section class="center">
					<section id="reset_officer_password">
						<?php if ($details_officer) { ?>
							<script type="text/javascript">window.location.hash = 'reset_officer_password';</script>
							<?php echo form_open("$designation/reset_password"); ?>
								<hr><br>
								<table>
									<thead>
										<tr>
											<th></th>
											<th>Officer ID</th>
											<th>Officer Name</th>
											<th>Gender</th>
											<th>Rank</th>
											<th>Department</th>
											<th>Default Password</th>
										</tr>
									</thead>
									<tbody>
										<tr>
										<?php
											 echo "<td><button class='link-button' name='reset-password' value='$details_officer[officer_id]'>
												Reset to Default</button></td>";
											echo "<td>$details_officer[officer_id]</td>";
											echo "<td>$details_officer[officer_name]</td>";
											echo "<td>$details_officer[gender]</td>";
											echo "<td>$details_officer[rank]</td>";
											echo "<td>$details_officer[dept_name]</td>";
											echo "<td>pass</td>";
										?>
										</tr>
									</tbody>
								</table>
							<?php echo form_close(); ?>
						<?php } ?>
					</section>
				</section>
			</div>
	</section>
</div>	