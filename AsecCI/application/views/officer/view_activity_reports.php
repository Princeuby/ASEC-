	    <style> /* I had to do this */
			.reports { display: <?php echo $display_reports; ?>; }
			#report { display: <?php echo $display_report; ?>; }
		</style>
			<header>
				<h2 class="alt">View Activity Report<strong> Details</strong></h2>
			</header>
			<?php echo form_open("$designation/view_activity_reports") ?>
				<table class="8u center size-table">
					<thead>
						<tr>
							<th>Day</th>
							<th>Shift</th>
							<th>Results</th>
							<th></th>
						</tr>
					</thead>
					<tbody>	
					    <tr>
							<td class="t25"><input type="date" name="day"></td>					
							<td class="t40"><select name='shift'>
								<option value='%'>All</option>
								<?php foreach ($shifts as $shift) {
									$shift = $shift['shift']; // Bad stuff
									if ($shift === $selected_shift)
										echo "<option value='$shift' selected>$shift</option>";
									else
										echo "<option value='$shift'>$shift</option>";
										
								} ?>
								</select></td>		
							<td class="t25"><input required type="number" name="limit" min="1" value="<?php echo $limit; ?>"></td>
							<td class="t10"><button class='link-button' name='filter' value='filter'>
								Filter</button></td>
						</tr>
					</tbody>
				</table>
				<table class="reports">
					<thead>
						<tr>
							<th>Time Started</th>
							<th>Officer</th>
							<th>Shift</th>
							<th>Previous Officer</th>
							<th>Next Officer</th>
							<th>Time Ended</th>
							<th></th>
						</tr>
					</thead>
					<tbody>
					<?php if ($display_reports !== 'None') {
						 foreach ($reports as $report) {
							echo "<tr>";
								echo "<td>$report[date_timeIn]</td>";
								echo "<td>$report[officer_name]</td>";
								echo "<td>$report[shift]</td>";
								echo "<td>$report[previous_officer_name]</td>";
								echo "<td>$report[next_officer_name]</td>";
								echo "<td>$report[date_timeOut]</td>";
								echo "<td><button class='link-button' name='report_id' value='$report[report_id]'>
								View</button></td>";
							 echo "</tr>";
						 }
					 }?>
					</tbody>
				</table>
			</form>
			<section id="report">
				<script>window.location.hash = 'report';</script>
				<hr>
				<p class="10u 12u$(mobile) center">
				Officer: <span class="blue-text"><?php echo "$officer_name";?></span><br>
				Time Started: <span class="blue-text"><?php echo $selected_report['date_timeIn'];?></span><br>
				Shift: <span class="blue-text"><?php echo $selected_report['shift'];?></span><br>
				Previous Officer: <span class="blue-text"><?php echo "$previous_officer_name";?></span><br>
				Next Officer: <span class="blue-text"><?php echo "$next_officer_name";?></span></p>
				<section id="incidents">
					<div class="10u 12u$(mobile) center">
						<?php foreach ($incidents as $incident):?>
							<article>
								<header>
									<h4>Incident: <span class="blue-text"><?php echo $incident['incident_type'];?></span></h4>
									<span>Time: <span class="blue-text"><?php echo $incident['incident_time'];?></span></span>
								</header>
								<p><?php echo $incident['entry_report'];?></p>
							</article>
						<?php endforeach ?>
					</div>
				</section>
			</section>
		</div>
	</section>
</div>