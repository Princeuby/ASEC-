		<style> /* I had to do this */
			#leaves_record { display: <?php echo $display_leaves; ?>; }
			#request_leave { display: <?php echo $display_request; ?>; }
			#leave_view { display: <?php echo $display_one_leave; ?>; }
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
					<p class="error"><?php echo $this->session->flashdata('leave_create'); ?></p>
					<?php echo "<span><h3>$no_leaves</h3></span>"; ?>
					<section id="leaves_record">
						<?php echo form_open("$designation/leaves"); ?>
						<h3>Leave Details</h3>
						<hr><br>
						<table class="10u 12u$(mobile) center">
							<thead>
								<tr>
									<th>Leave Type</th>
									<th>Proceeding Date</th>
									<th>Returning Date</th>
									<th>Supervisor Name</th>
									<th>Approval Status</th>
									<th></th>
								</tr>
							</thead>
							<tbody>
								<?php foreach ($leaves as $leave):?>
									<?php
									echo "<tr>";
										echo "<td>$leave[leave_type]</td>";
										echo "<td>$leave[proceeding_date]</td>";
										echo "<td>$leave[returning_date]</td>";
										$supervisor_name = $leave['first_name'] . " " . $leave['last_name'];
										echo "<td>$supervisor_name</td>";
										echo "<td>$leave[approved_status]</td>";
										echo "<td><button class='link-button' name='view-leave' value='$leave[leaves_id]'>
												View Leave</button></td>";
									 echo "</tr>";
									 ?>
								<?php endforeach ?>
							</tbody>
						</table>
						<?php echo form_close(); ?>
					</section>
					<section id="request_leave" class="6u 12u$(mobile) center">
						<?php echo $go_to; ?>
						<!--<script>window.location.hash = 'request_leave';</script>-->
						<?php echo form_open("$designation/add_leave") ?>
							<?php
								echo "<label>Leave Type: <select required name='leave-type' class='size-input'>
									<option value='' disabled selected>Choose Type:</option>
									<option value='Annual' $disable_annual>Annual</option>
									<option value='Burial'>Burial</option>
									<option value='Sick'>Sick</option>
									<option value='Other'>Other</option>
								</select></label>";	
							?>
							<label>Reason For Leave: <textarea name="reason-for-leave"></textarea></label><br>
						    <label>Proceeding date: <input type="date" name="proceeding-date" min="<?php echo date('Y-m-d'); ?>" class="size-input"></label><br>
						    <input type="submit" name="submit" value="Request Leave">
						</form>
					</section>
					<?php echo form_open("$designation/leaves") ?>
					<section id="leave_view">
						<!--<script type="text/javascript">window.location.hash = 'leave_view';</script>-->
							<hr>
							<p class="10u 12u$(mobile) center">
							<section id="incidents"><div class="10u 12u$(mobile) center"><article>
								<header>
									<strong>Leave Type: </strong><span class="blue-text"><?php echo $one_leave_selected['leave_type'];?></span><br>
									<strong>Proceeding Date: </strong><span class="blue-text"><?php echo $one_leave_selected['proceeding_date'];?></span><br>
									<strong>Returning Date: </strong><span class="blue-text"><?php echo $one_leave_selected['returning_date'];?></span><br>
									<strong>Approval Status: </strong><span class="blue-text"><?php echo $one_leave_selected['approved_status'];?></span><br>
									<strong>Supervisor Name: </strong><span class="blue-text"><?php echo $leave_supervisor; ?></span><br>
								</header>
								<strong>Reason For Leave: </strong><span class="blue-text"><?php echo $one_leave_selected['leave_comment'];?></span><br>
								<strong>Comments: </strong><span class="blue-text"><?php echo $one_leave_selected['comments'];?></span><br>
								<button class='center' name='close-leave' value='$one_leave_selected[leaves_id]'>Close Leave</button>
							</article></div></section>
							</p>
					</section>
					<?php echo form_close(); ?>
				</section>

		</div>
	</section>
</div>