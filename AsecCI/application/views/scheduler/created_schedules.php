			<style>
				#not-approved { display: <?php echo $display_n; ?> }	
				#approved { display: <?php echo $display_a; ?> }	
				#pending { display: <?php echo $display_p; ?> }	
			</style>
			<header>
				<h2 class="alt">Created <strong>Schedules</strong></h2>
				<p>Week: <span class='blue-text'><?php echo date('d/m/Y', strtotime('this Sunday'))
					   . " - " . date('d/m/Y', strtotime('this Saturday + 1 week')); ?></span>
				</p>
			</header>
			<section>
				<?php echo form_open("scheduler/created_schedules") ?>
					<table id="not-approved" class="8u center size-table">
						<caption class='red-text'>Not Approved</caption>
						<thead>
							<tr>
								<th>Location</th>
								<th>Shift</th>
								<th>Comments</th>
								<th></th>
								<th></th>
							</tr>
						</thead>
						<tbody>	
							<?php foreach ($not_approved as $schedule): ?>
						    <tr>
								<td class="t"><?php echo $schedule['location']; ?></td>				
								<td class="t"><?php echo $schedule['shift']; ?></td>		
								<td class="t40"><?php echo $schedule['comments']; ?></td>		
								<td class="t10"><button class='link-button' name='fix' value="">
									Fix</button></td>
								<td class="t10"><button class='link-button' name='show-schedule' value="">
									Show</button></td>
							</tr>
							<?php endforeach ?>
						</tbody>
					</table>
					<section class="row">
						<div id="pending" class="6u 12u$(mobile) center">
							<table>
								<caption class='blue-text'>Pending</caption>
								<thead>
									<tr>
										<th>Location</th>
										<th>Shift</th>
										<th></th>
									</tr>
								</thead>
								<tbody>	
									<?php foreach ($pending as $schedule): ?>
								    <tr>
										<td class="t"><?php echo $schedule['location']; ?></td>				
										<td class="t"><?php echo $schedule['shift']; ?></td>		
										<td class="t10"><button class='link-button' name='show-schedule' value="">
											Show</button></td>
									</tr>
									<?php endforeach ?>
								</tbody>
							</table>
						</div>
						<div id="approved" class="6u 12u$(mobile) center">
							<table>
								<caption class='green-text'>Approved</caption>
								<thead>
									<tr>
										<th>Location</th>
										<th>Shift</th>
										<th></th>
									</tr>
								</thead>
								<tbody>	
									<?php foreach ($approved as $schedule): ?>
								    <tr>
										<td class="t"><?php echo $schedule['location']; ?></td>				
										<td class="t"><?php echo $schedule['shift']; ?></td>		
										<td class="t10"><button class='link-button' name='show-schedule' value="">
											Show</button></td>
									</tr>
									<?php endforeach ?>
								</tbody>
							</table>
						</div>
					</section>
				</form>
			</section>
		</div>
	</section>
</div>