	    <style> /* I had to do this */
			#new-report { display: <?php echo $display_create; ?>; }
			#not-new {	display: <?php echo $display_report; ?>; }
		</style>
		<!--<span id="disp"></span>-->
		<!--<script>setInterval(clk, 100);</script>-->
			<header>
				<h2 class="alt">Your Activity <strong>Report</strong></h2>
			</header>
			<section class="center">
				<section id="new-report">
					<?php echo form_open('officer/new_activity_report') ?>
					    <label><input type="text" name="prevID" placeholder="Previous Officer ID" class="size-input"></label>					
						<input type="submit" name="submit" value="Create New Report">
					</form>
				</section>
				<section id="not-new">
					<span>Report Details</span>
					<hr>
					<table class="6u 12u$(mobile) center">
						<tbody>
							<tr>
								<td>Report Created</td>
								<td><?php echo $report['date_timeIn'];?></td>
							</tr>
							<tr>
								<td>Shift</td>
								<td><?php echo $report['shift'];?></td>
							</tr>
							<tr>
								<td>Previous Officer</td>
								<td><?php echo "$previous_officer_name 
									($report[previous_officer_id])";?></td>
							</tr>
						</tbody>
					</table>
					<h3>Incidents</h3><hr>
					<div class="row">
						<?php foreach ($incidents as $incident):?>
							<div class="6u 12u$(mobile)">
								<article class="item blue">
									<header><h3><?php echo $incident['incident_type'];?></h3></header>
									<p><?php echo $incident['entry_report'];?></p>
								</article>
							</div>
						<?php endforeach ?>
					</div>
					<?php echo form_open('officer/activity_report') ?>
					    <label><input type="text" name="incident-type" placeholder="Incident" class="size-input"></label>
					    <label><textarea name="incident-details" placeholder="I found a missing dog" class="size-inpu"></textarea></label><br>
					    <input type="submit" name="submit" value="Add Incident">
					</form>
				</section>
			</section>
			
		</div>
	</section>
</div>