	    <style> /* I had to do this */
			#new-report { display: <?php echo $display_create; ?>; }
			#not-new {	display: <?php echo $display_report; ?>; }
			#incidents { display: <?php echo $display_incidents; ?>; }
		</style>
			<header>
				<h2 class="alt">View Activity Report<strong> Details</strong></h2>
			</header>
			<table>
				<thead>
					<tr>
						<th>Time Started</th>
						<th>Officer</th>
						<th>Shift</th>
						<th>Previous Officer</th>
						<th>Next Officer</th>
						<th>Time Ended</th>
					</tr>
				</thead>
				<tbody>
					<?php foreach ($reports as $report):?>
						<?php
						echo "<tr>";
							echo "<td>$report[date_timeIn]</td>";
							echo "<td>$report[officer_name] ($report[officer_id])</td>";
							echo "<td>$report[shift]</td>";
							echo "<td>$report[previous_officer_name] ($report[previous_officer_id])</td>";
							echo "<td>$report[next_officer_name] ($report[next_officer_id])</td>";
							echo "<td>$report[date_timeOut]</td>";
						 echo "</tr>";
						 ?>
					<?php endforeach ?>
				</tbody>
			</table>
			<section id="report">
				<hr>
				<p class="10u 12u$(mobile) center">
				Time Started: <span class="blue-text"><?php echo $report['date_timeIn'];?></span><br>
				Shift: <span class="blue-text"><?php echo $report['shift'];?></span><br>
				Previous Officer: <span class="blue-text"><?php echo "$previous_officer_name 
							($report[previous_officer_id])";?></span></p>
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
				<hr id="incidents"><br>
				<hr><br>
			</section>
		</div>
	</section>
</div>