		<style> /* I had to do this */
			#leaverequests { display: <?php echo $display_requests; ?>; }
			#addRecommendation { display: <?php echo $display_recommendation; ?>;}
		</style>
			<header>
				<h2 class="alt">Your Leaves <strong>Records</strong></h2>
			</header>
			<section class="center">
				<?php echo "<span><h3>$no_requests</h3></span>"; ?>
				<p class="error"><?php echo $this->session->flashdata('failed_recommendation'); ?></p>
				<section id="leaverequests">
					<h3>Pending Leave Requests</h3>
					<hr><br>
					<table class="10u 12u$(mobile) center">
						<thead>
							<tr>
								<th>Recommendation</th>
								<th>Officer Name</th>
								<th>Officer Rank</th>
								<th>Department</th>
								<th>Leave Type</th>
								<th>Proceeding Date</th>
							</tr>
						</thead>
						<?php echo form_open("$designation/leave_requests") ?>
						<tbody>
							<?php foreach ($leave_requests as $requests):?>
								<?php
								echo "<tr>";
									$officer_name = $requests['first_name'] . " " . $requests['last_name'];
									echo "<td><button class='link-button' name='recCom' value='$requests[leaves_id]'>Add</button></td>";
									echo "<td>$officer_name</td>";
									echo "<td>$requests[rank]</td>";
									echo "<td>$requests[dept_name]</td>";
									echo "<td>$requests[leave_type]</td>";
									echo "<td>$requests[proceeding_date]</td>";
								 echo "</tr>";
								 ?>
							<?php endforeach ?>
						</tbody>
						</form>
					</table>
				</section>
				<section id="addRecommendation" class="10u 12u$(mobile) center">
					<script> window.location.hash = "addRecommendation"; </script>
					<p class="10u 12u$(mobile) center">
					<section id="incidents"><div class="10u 12u$(mobile) center"><article>
						<header>
							<strong>Officer: </strong><span class="blue-text"><?php $officerName = $selected_officer['first_name'] . " " . $selected_officer['last_name']; 
								echo $officerName;?></span><br>
							<strong>Rank: </strong><span class="blue-text"><?php echo $selected_officer['rank'];?></span><br>
							<strong>Leave Type: </strong><span class="blue-text"><?php echo $selected_leave['leave_type'];?></span><br>
							<strong>Proceeding Date: </strong><span class="blue-text"><?php echo $selected_leave['proceeding_date'];?></span><br>
						</header>
						<strong>Reason For Leave: </strong><span class="blue-text"><?php echo $selected_leave['leave_comment'];?></span><br>
					</article></div></section>
					</p>
					<?php echo form_open("$designation/add_recommendation") ?>
						<label>Entilted Days: <br><input required type="number" min="1" max="365" name="recommendation-days" class="size-input"></label>
						<label>Comments: <textarea name="recommendation-comment"></textarea></label><br>
						<?php echo "<input type='hidden' id='buttonLeaveId' name='buttonLeaveId' value='$selected_leave[leaves_id]'>"; ?>
						<input type="submit" name="submit" id="addRec" value="Add Recommendation">
					</form>
				</section>
			</section>

		</div>
	</section>
</div>
