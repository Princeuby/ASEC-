		<style> /* I had to do this */
			#leaverequests { display: <?php echo $display_requests; ?>; }
			#addRecommendation { display: None;}
		</style>
		<script>
			function setFocus() {
			    document.getElementById("addRecommendation").style.display = 'block';
			    document.getElementsByName("buttonValue").value = document.getElementById("recCom").value;
			    window.location.hash = "addRecommendation";
			}
		</script>
			<header>
				<h2 class="alt">Your Leaves <strong>Records</strong></h2>
			</header>
			<section class="center">
				<?php echo "<span><h3>$no_requests</h3></span>"; ?>
				<section id="leaverequests">
					<h3>Pending Leave Requests</h3>
					<hr>
					<table class="6u 12u$(mobile) center">
						<tbody>
							<tr>
								<th>Officer Name</th>
								<th>Officer Rank</th>
								<th>Leave Type</th>
								<th>Proceeding Date</th>
								<th>Recommendation</th>
							</tr>
							<?php foreach ($leave_requests as $requests):?>
								<?php
								echo "<tr>";
									$officer_name = $requests['first_name'] . " " . $requests['last_name'];
									echo "<td>$officer_name</td>";
									echo "<td>$requests[rank]</td>";
									echo "<td>$requests[leave_type]</td>";
									echo "<td>$requests[proceeding_date]</td>";
									echo "<td><button id='recCom' onclick='setFocus()' value='$requests[leaves_id]'>Add Recommendation</button></td>";
								 echo "</tr>";
								 ?>
							<?php endforeach ?>
						</tbody>
					</table>
				</section>
				<?php echo "<span><h3>$failed_recommendation</h3></span>"; ?>
				<section id="addRecommendation" class="6u 12u$(mobile) center">
					<?php echo form_open("$designation/add_recommendation") ?>
						<label>Entilted Days: <input required type="number" min="1" max="365" name="recommendation-days" class="size-input"></label>
						<label>Comments: <textarea required name="recommendation-comment" placeholder="I think the leave is desired for the days specified above"></textarea></label><br>
						<input type="hidden" name="buttonValue" value="">
						<input type="submit" name="submit" id="addRec" value="Add Recommendation">
					</form>
				</section>
			</section>

		</div>
	</section>
</div>
