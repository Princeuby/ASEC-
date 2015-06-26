		<style> /* I had to do this */
			#leaves_record { display: <?php echo $display_leaves; ?>; }
		</style>	
				<header>
					<h2 class="alt">Your Leaves <strong>Records</strong></h2>
				</header>
				<section class="center">
					<?php echo "<span><h3>$no_leaves</h3></span>"; ?>
					<section id="leaves_record">
						<h3>Leave Details</h3>
						<hr>
						<table class="10u 12u$(mobile) center">
							<tbody>
								<tr>
									<th>Leave Type</th>
									<th>Proceeding Date</th>
									<th>Returning Date</th>
									<th>Supervisor Name</th>
									<th>Approval Status</th>
									<th>Comments</th>
								</tr>
								<?php foreach ($leaves as $leave):?>
									<?php
									echo "<tr>";
										echo "<td>$leave[leave_type]</td>";
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
					<section class="6u 12u$(mobile) center">
						<?php echo form_open("$designation/leaves") ?>
						    <label>Leave Type: <input type="text" name="leave-type" placeholder="sick" class="size-input"></label>
						    <label>Proceeding date: <input type="date" name="proceeding-date" min="<?php echo date('Y-m-d'); ?>" class="size-input"></label><br>
						    <input type="submit" name="submit" value="Request Leave">
						</form>
					</section>
				</section>

		</div>
	</section>
</div>