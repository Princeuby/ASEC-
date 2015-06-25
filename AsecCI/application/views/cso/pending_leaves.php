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
					<table class="6u 12u$(mobile) center">
						<tbody>
							<tr>
								<th>Officer Name</th>
								<th>Officer Rank</th>
								<th>Department</th>
								<th>Leave Type</th>
								<th>Proceeding Date</th>
								<th>Entitled Days</th>
								<th>Supervisor Recommendation</th>
								<th>Approval Status</th>
							</tr>
							<?php form_open("$designation/pending_leaves") ?>
							<?php foreach ($pending_leaves as $requests):?>
								<?php 
								echo "<tr>";
									$officer_name = $requests['first_name'] . " " . $requests['last_name'];
									echo "<td>$officer_name</td>";
									echo "<td>$requests[rank]</td>";
									echo "<td>$requests[dept_name]</td>";
									echo "<td>$requests[leave_type]</td>";
									echo "<td>$requests[proceeding_date]</td>";
									echo "<td>$requests[entitled_days]</td>";
									echo "<td>$requests[recommendation]</td>";
									echo "<td><button name='setApp' value='$requests[leaves_id]'>Set Approval</button></td>";
								 echo "</tr>";
								 ?>
							<?php endforeach ?>
						</form>
						</tbody>
					</table>
				</section>
				<?php echo "<span><h3>$failed_approval</h3></span>"; ?>
				<section id="setApproval" class="6u 12u$(mobile) center">
					<script> window.location.hash = "setApproval"; </script>
					<?php echo form_open("$designation/leave_approval") ?>
						<?php echo "<label>Entilted Days: <input required type='number' min='1' max='365' id='approval-days' name='approval-days' 
						class='size-input' value='$selected_leave[entitled_days]'></label>"; ?>
						<label>Approval Status: <select required name="approval-status" class="size-input">
								<option value="" disabled selected>Set Approval</option>
								<option value="approved">Approved</option>
								<option value="not-approved">Not Approved</option>
							</select></label>
						<label>Comments: <textarea name="approval-comment"></textarea></label><br>
						<input type="hidden" name="buttonLeaveId" value="">
						<input type="hidden" name="buttonProceedingDate" value="">
						<input type="submit" name="submit" id="leaApp" value="Set Approval">
					</form>
				</section>
			</section>

		</div>
	</section>
</div>
