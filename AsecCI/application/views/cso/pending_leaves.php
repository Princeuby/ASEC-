		<style> /* I had to do this */
			#leaveapproval { display: <?php echo $display_all_leaves; ?>; }
			#setApproval { display: <?php echo $display_approval; ?>; }
		</style>
			<header>
				<h2 class="alt">Leave <strong>Approval</strong></h2>
			</header>
			<section class="center">
				<?php echo "<span><h3>$no_leave_requests</h3></span>"; ?>
				<section id="leaveapproval">
					<h3>Pending Leave Approval</h3>
					<hr>
					<table>
						<thead>
							<tr>
								<th>Officer Name</th>
								<th>Officer Rank</th>
								<th>Department</th>
								<th>Leave Type</th>
								<th>Reason For Leave</th>
								<th>Proceeding Date</th>
								<th>Entitled Days</th>
								<th>Supervisor Recommendation</th>
								<th>Approval Status</th>
							</tr>
						</thead>
						<?php echo form_open("$designation/pending_leaves") ?>
						<tbody>
							<?php foreach ($pending_leaves as $requests):?>
								<?php 
								echo "<tr>";
									$officer_name = $requests['first_name'] . " " . $requests['last_name'];
									echo "<td>$officer_name</td>";
									echo "<td>$requests[rank]</td>";
									echo "<td>$requests[dept_name]</td>";
									echo "<td>$requests[leave_type]</td>";
									echo "<td>$requests[leave_comment]</td>";
									echo "<td>$requests[proceeding_date]</td>";
									echo "<td>$requests[entitled_days]</td>";
									echo "<td>$requests[recommendation]</td>";
									echo "<td><button class='link-button' name='setApp' value='$requests[leaves_id]'>Set Approval</button></td>";
								 echo "</tr>";
								 ?>
							<?php endforeach ?>
						</tbody>
						</form>
					</table>
				</section>
				<?php echo "<span><h3>$failed_approval</h3></span>"; ?>
				<section id="setApproval" class="10u 12u$(mobile) center">
					<script> window.location.hash = "setApproval"; </script>
					<p class="10u 12u$(mobile) center">
					Officer: <span class="blue-text"><?php $officerName = $selected_officer['first_name'] . " " . $selected_officer['last_name']; 
						echo $officerName;?></span><br>
					Rank: <span class="blue-text"><?php echo $selected_officer['rank'];?></span><br>
					Department: <span class="blue-text"><?php echo $selected_officer['dept_name'];?></span><br>
					Leave Type: <span class="blue-text"><?php echo $selected_leave['leave_type'];?></span><br>
					Proceeding Date: <span class="blue-text"><?php echo $selected_leave['proceeding_date'];?></span><br>
					Reason For Leave: <span class="blue-text"><?php echo $selected_leave['leave_comment'];?></span><br>
					Recommendation: <span class="blue-text"><?php echo $selected_leave['recommendation'];?></span><br>
					<?php echo form_open("$designation/leave_approval") ?>
						<?php 
							echo "<label>Entilted Days: <input required type='number' min='1' max='365' id='approval-days' name='approval-days' 
							class='size-input' value='$selected_leave[entitled_days]'></label>";
							echo "<label>Approval Status: <select required name='approval-status' class='size-input'>
									<option value='Not Approved' selected>Not Approved</option>
									<option value='Approved'>Approved</option>
								</select></label>";
							echo "<label>Comments: <textarea name='approval-comment'></textarea></label><br>";
							echo "<input type='hidden' name='buttonLeaveId' value='$selected_leave[leaves_id]'>";
							echo "<input type='hidden' name='buttonProceedingDate' value='$selected_leave[proceeding_date]'>";
							echo "<input type='submit' name='submit' id='leaApp' value='Set Approval'>";
						?>
					</form>
				</section>
			</section>

		</div>
	</section>
</div>
