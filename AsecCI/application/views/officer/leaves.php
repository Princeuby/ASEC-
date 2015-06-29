		<style> /* I had to do this */
			#leaves_record { display: <?php echo $display_leaves; ?>; }
			#request_leave { display: <?php echo $display_request; ?>; }
		</style>	
				<header>
					<h2 class="alt">Your Leaves <strong>Records</strong></h2>
				</header>
				<section class="center">
					<?php echo form_open("$designation/leaves"); ?>
					<?php
						echo "<input type='submit' name='apply-leave' value='Request Leave'><br>";
					?>
					</form>
					<?php echo "<span><h3>$no_leaves</h3></span>"; ?>
					<section id="leaves_record">
						<h3>Leave Details</h3>
						<hr>
						<table class="10u 12u$(mobile) center">
							<thead>
								<tr>
									<th>Leave Type</th>
									<th>Reason For Leave</th>
									<th>Proceeding Date</th>
									<th>Returning Date</th>
									<th>Supervisor Name</th>
									<th>Approval Status</th>
									<th>Comments</th>
								</tr>
							</thead>
							<tbody>
								<?php foreach ($leaves as $leave):?>
									<?php
									echo "<tr>";
										echo "<td>$leave[leave_type]</td>";
										echo "<td>$leave[leave_comment]</td>";
										echo "<td>$leave[proceeding_date]</td>";
										echo "<td>$leave[returning_date]</td>";
										$supervisor_name = $leave['first_name'] . " " . $leave['last_name'];
										echo "<td>$supervisor_name</td>";
										echo "<td>$leave[approved_status]</td>";
										echo "<td>$leave[comments]</td>";
									 echo "</tr>";
									 ?>
								<?php endforeach ?>
							</tbody>
						</table>
					</section>
					<section id="request_leave" class="6u 12u$(mobile) center">
						<script>window.location.hash = 'request_leave';</script>
						<?php echo form_open("$designation/leaves") ?>
							<?php
								echo "<label>Leave Type: <select required name='leave-type' class='size-input'>
									<option value='' disabled selected>Choose Type:</option>
									<option value='Annual' $disable_annual>Annual</option>
									<option value='Burial'>Burial</option>
									<option value='Sick'>Sick</option>
								</select></label>";	
							?>
							<label>Reason For Leave: <textarea name="reason-for-leave"></textarea></label><br>
						    <label>Proceeding date: <input type="date" name="proceeding-date" min="<?php echo date('Y-m-d'); ?>" class="size-input"></label><br>
						    <input type="submit" name="submit" value="Request Leave">
						</form>
					</section>
				</section>

		</div>
	</section>
</div>