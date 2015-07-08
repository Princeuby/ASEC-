		<style> /* I had to do this */
			#all_leaves { display: <?php echo $display_leave_records; ?>; }
			#one_leave { display: <?php echo $display_a_leave; ?>; }
		</style>
				<header>
					<h2 class="alt">All Leave <strong>Records</strong></h2>
				</header>
				<section class="center">
					<?php echo "<span><h3>$no_record</h3></span>"; ?>
					<section id="all_leaves">
						<?php echo form_open("$designation/view_leaves"); ?>
						<hr><br>
						<table class="12u$(mobile) center">
							<thead>
								<tr>
									<th></th>
									<th>Officer Name</th>
									<th>Officer Rank</th>
									<th>Leave Type</th>
									<th>Proceeding Date</th>
									<th>Returning Date</th>
									<th>Supervisor Name</th>
									<th>Approval Date</th>
									<th>Approval Status</th>
								</tr>
							</thead>
							<tbody>
								<?php foreach($all_leaves as $leaves): ?>
									<?php
										echo "<tr>";
											echo "<td><button class='link-button' name='view-one-leave' value='$leaves[leaves_id]'>
												View Leave</button></td>";
											echo "<td>$leaves[officer_name]</td>";
											echo "<td>$leaves[officer_rank]</td>";
											echo "<td>$leaves[leave_type]</td>";
											echo "<td>$leaves[proceeding_date]</td>";
											echo "<td>$leaves[returning_date]</td>";
											echo "<td>$leaves[supervisor_name]</td>";
											echo "<td>$leaves[approved_date]</td>";
											echo "<td>$leaves[approved_status]</td>";
										echo "</tr>";
									?>
								<?php endforeach ?>
							</tbody>
						</table>
						<?php echo form_close(); ?>
					</section>
					<?php echo form_open("$designation/view_leaves") ?>
					<section id="one_leave">
						<script type="text/javascript">window.location.hash = 'one_leave';</script>
						<hr>
						<p class="10u 12u$(mobile) center">
						<section id="incidents"><div class="10u 12u$(mobile) center"><article>
							<header>
									<strong>Officer Name: </strong><span class="blue-text"><?php echo $officer_leave['officer_name'];?></span><br>
									<strong>Officer Rank: </strong><span class="blue-text"><?php echo $officer_leave['officer_rank'];?></span><br>
									<strong>Leave Type: </strong><span class="blue-text"><?php echo $officer_leave['leave_type'];?></span><br>
									<strong>Proceeding Date: </strong><span class="blue-text"><?php echo $officer_leave['proceeding_date'];?></span><br>
									<strong>Returning Date: </strong><span class="blue-text"><?php echo $officer_leave['returning_date'];?></span><br>
									<strong>Supervisor Name: </strong><span class="blue-text"><?php echo $officer_leave['supervisor_name']; ?></span><br>
									<strong>Approval Date: </strong><span class="blue-text"><?php echo $officer_leave['approved_date']; ?></span><br>
									<strong>Approval Status: </strong><span class="blue-text"><?php echo $officer_leave['approved_status']; ?></span><br>
							</header>
							<strong>Reason For Leave: </strong><span class="blue-text"><?php echo $officer_leave['leave_comment'];?></span><br>
							<strong>Supervisor Recommendation: </strong><span class="blue-text"><?php echo $officer_leave['recommendation'];?></span><br>
							<strong>Your Comment: </strong><span class="blue-text"><?php echo $officer_leave['comments'];?></span><br>
							<button class='center' name='close-one-leave' value='$officer[leaves_id]'>Close Leave</button>
						</article></div></section>
						</p>
					</section>
					<?php echo form_close(); ?>
				</section>
		</div>
	</section>
</div>