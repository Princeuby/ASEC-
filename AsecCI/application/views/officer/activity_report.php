	    <style> /* I had to do this */
			#new-report { display: <?php echo $display; ?>; }
			.not-new {	display: <?php echo $display_incident; ?>; }
		</style>
		<!--<span id="disp"></span>-->
		<!--<script>setInterval(clk, 100);</script>-->
			<header>
				<h2 class="alt">Your Activity <strong>Report</strong></h2>
			</header>
			<section class="8u center size-panel">
				<section id="new-report">
					<?php echo form_open('officer/new_activity_report') ?>
					    <label><input type="text" name="prevID" placeholder="Previous Officer ID" class="size-input"></label>					
						<input type="submit" name="submit" value="Create New Report">
					</form>
				</section>
				<section class="not-new">
					<span>Report Details</span>
					<hr>
					<table>
						<tbody>
							<tr>
								<td>Report Created </td>
								<td><?php echo $report['date_timeIn'];?></td>
							</tr>
							<tr>
								<td>Previous Officer </td>
								<td><?php echo $report['previous_officer_id'];?></td>
							</tr>
							<tr>
								<td>Shift </td>
								<td><?php echo $report['shift'];?></td>
							</tr>
						</tbody>
					</table>
					<?php echo form_open('officer/activity_report') ?>
					    <label><input type="text" name="incident" placeholder="Incident" class="size-input"></label>
					    <label><textarea name="details" placeholder="I found a missing dog" class="size-inpu"></textarea></label><br>
					    <input type="submit" name="submit" value="Add Incident">
					</form>
				</section>
			</section>
			
		</div>
	</section>
</div>