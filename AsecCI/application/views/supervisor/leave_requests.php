		<style> /* I had to do this */
			#leaverequests { display: <?php echo $display_requests; ?>; }
			#addRecommendation { display: <?php echo $display_recommendation; ?>;}
		</style>
			<header>
				<h2 class="alt">Your Leaves <strong>Records</strong></h2>
			</header>
			<section class="center">
				<?php echo "<span><h3>$no_requests</h3></span>"; ?>
				<section id="leaverequests">
					<h3>Pending Leave Requests</h3>
					<hr>
					<table class="10u 12u$(mobile) center">
						<thead>
							<tr>
								<th>Officer Name</th>
								<th>Officer Rank</th>
								<th>Leave Type</th>
								<th>Reason For Leave</th>
								<th>Proceeding Date</th>
								<th>Recommendation</th>
							</tr>
						</thead>
						<?php echo form_open("$designation/leave_requests") ?>
						<tbody>
							<?php foreach ($leave_requests as $requests):?>
								<?php
								echo "<tr>";
									$officer_name = $requests['first_name'] . " " . $requests['last_name'];
									echo "<td>$officer_name</td>";
									echo "<td>$requests[rank]</td>";
									echo "<td>$requests[leave_type]</td>";
									echo "<td>$requests[leave_comment]</td>";
									echo "<td>$requests[proceeding_date]</td>";
									echo "<td><button class='link-button' name='recCom' value='$requests[leaves_id]'>Add</button></td>";
								 echo "</tr>";
								 ?>
							<?php endforeach ?>
						</tbody>
						</form>
					</table>
				</section>
				<?php echo "<span><h3>$failed_recommendation</h3></span>"; ?>
				<section id="addRecommendation" class="6u 12u$(mobile) center">
					<script> window.location.hash = "addRecommendation"; </script>
					<p class="10u 12u$(mobile) center">
					Officer: <span class="blue-text"><?php $officerName = $selected_officer['first_name'] . " " . $selected_officer['last_name']; 
						echo $officerName;?></span><br>
					Rank: <span class="blue-text"><?php echo $selected_officer['rank'];?></span><br>
					Leave Type: <span class="blue-text"><?php echo $selected_leave['leave_type'];?></span><br>
					Reason For Leave: <span class="blue-text"><?php echo $selected_leave['leave_comment'];?></span><br>
					Proceeding Date: <span class="blue-text"><?php echo $selected_leave['proceeding_date'];?></span><br>
					<?php echo form_open("$designation/add_recommendation") ?>
						<label>Entilted Days: <input required type="number" min="1" max="365" name="recommendation-days" class="size-input"></label>
						<label>Comments: <textarea name="recommendation-comment"></textarea></label><br>
						<?php echo "<input type='hidden' id='buttonLeaveId' name='buttonLeaveId' value='$selected_leave[leaves_id]'>"; ?>
						<input type="submit" name="submit" id="addRec" value="Add Recommendation">
					</form>
				</section>
			</section>

		</div>
	</section>
</div>
