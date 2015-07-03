<style>
				#not-approved { display: <?php echo $display_n; ?> }	
				#pending { display: <?php echo $display_p; ?> }	
			</style>
			<header>
				<h2 class="alt">Created <strong>Schedules</strong></h2>
				<p>Week: <span class='blue-text'><?php echo date('d/m/Y', strtotime('this Sunday'))
					   . " - " . date('d/m/Y', strtotime('this Saturday + 1 week')); ?></span>
				</p>
			</header>
			<section>
				<?php echo form_open("$designation/show_schedule") ?>
					<div id="pending" class="8u 12u$(mobile) center">
						<table>
							<caption class='blue-text'><h3>Pending</h3></caption>
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
									<td><?php echo $schedule['location']; ?></td>				
									<td><?php echo $schedule['shift']; ?></td>		
									<td class="t10"><button class='link-button' name='show-schedule' 
										value="<?php echo $schedule['location'] .'.'. $schedule['shift']; ?>">
										Show</button></td>
									<!--<td class="t10"><button class='link-button green-box' name='show-schedule' 
										value="<?php echo $schedule['location'] .'.'. $schedule['shift']; ?>">
										Yes</button></td>
									<td class="t10"><button class='link-button red-box' name='show-schedule' 
										value="<?php echo $schedule['location'] .'.'. $schedule['shift']; ?>">
										No</button></td>-->
								</tr>
								<?php endforeach ?>
							</tbody>
						</table>
					</div>
					<table id="not-approved" class="8u center size-table">
						<caption class='red-text'><h3>Not Approved</h3></caption>
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
								<td><?php echo $schedule['location']; ?></td>				
								<td><?php echo $schedule['shift']; ?></td>		
								<td class="t40"><?php echo $schedule['comments']; ?></td>
								<td class="t10"><button class='link-button' name='show-schedule' 
									value="<?php echo $schedule['location'] .'.'. $schedule['shift']; ?>">
									Show</button></td>
							</tr>
							<?php endforeach ?>
						</tbody>
					</table>
				</form>
			</section>
		</div>
	</section>
</div>