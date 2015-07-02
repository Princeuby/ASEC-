			<style>
				.display_s { display: <?php echo $display_s; ?> }	
				.display_l { display: <?php echo $display_l; ?> }	
			</style>
			<header>
				<h2 class="alt">Officer <strong>Schedule</strong></h2>
				<p>Select a location and shift to create a schedule<br>
				   Week: <span class='blue-text'><?php echo date('d/m/Y', strtotime('this Sunday'))
					   . " - " . date('d/m/Y', strtotime('this Saturday + 1 week')); ?></span>
				</p>
			</header>
			
			<?php echo form_open("scheduler/index") ?>
				<table class="8u center size-table">
					<thead>
						<tr>
							<th>Location</th>
							<th>Shift</th>
							<th></th>
						</tr>
					</thead>
					<tbody>	
					    <tr>
							<td class="t40"><select name='location'>
								<?php foreach ($locations as $location) {
									$location = $location['location']; // Bad stuff
									if ($location === $selected_location)
										echo "<option value='$location' selected>$location</option>";
									else
										echo "<option value='$location'>$location</option>";
								} ?>
								</select></td>				
							<td class="t40"><select name='shift'>
								<?php foreach ($shifts as $shift) {
									$shift = $shift['shift']; // Bad stuff
									if ($shift === $selected_shift)
										echo "<option value='$shift' selected>$shift</option>";
									else
										echo "<option value='$shift'>$shift</option>";
								} ?>
								</select></td>		
							<td class="t10"><button class='link-button' name='get-schedule' value='schedule'>
								Schedule</button></td>
						</tr>
					</tbody>
				</table>
			</form>
			<?php echo form_open("scheduler/index") ?>
				<table class="display_s 10u center size-table">
					<thead>
						<tr>
							<th>ID</th>
							<th>Officer Name</th>
							<th>Last Shift</th>
							<th>Off Days</th>
							<!--<th></th>-->
						</tr>
					</thead>
					<tbody>	
						<?php foreach ($schedule_officers as $officer): ?>
					    <tr>
							<td class='t10'><?php echo $officer['officer_id'];?></td>
							<td class='t25'><?php echo $officer['officer_name'];?></td>
							<td class='2u'><?php echo $last_shift;?></td>
							<td><select class="ts" name="off-day-1[]">
								<?php for ($i = 0; $i < count($workdays); $i++) {
									if ($workdays[$i] == $officer['off_day_1'])
										echo "<option value='$i' selected>$workdays[$i]</option>";
									else
										echo "<option value='$i'>$workdays[$i]</option>";
								} ?>
								</select>
								<select class="ts" name="off-day-2[]">
								<?php for ($i = 0; $i < count($workdays); $i++) {
									if ($workdays[$i] == $officer['off_day_2'])
										echo "<option value='$i' selected>$workdays[$i]</option>";
									else
										echo "<option value='$i'>$workdays[$i]</option>";
								} ?>
								</select></td>
						</tr>
						<?php endforeach ?>
					</tbody>
				</table>
				<section class='display_s t25 center button-label'>
					<button class='link-button t40' name='set-schedule' value='schedule'>Set Schedule</button>
					<button type='button' class='link-button t40' name='show-schedule' value='schedule'
							onclick="location.href='<?php echo base_url('scheduler/show_schedule'); ?>'">
							Show Schedule</button>
				</section>
				
				<hr class="display_l">
			</form>
			<table class="display_l 6u center size-table">
				<caption>Officers on Leave</caption>
				<thead>
					<tr>
						<th>ID</th>
						<th>Officer Name</th>
						<th>Returning Date</th>
					</tr>
				</thead>
				<tbody>	
					<?php foreach ($unavailable_officers as $officer): ?>
				    <tr>
						<td class='t10'><?php echo $officer['officer_id'];?></td>
						<td class='t25'><?php echo $officer['officer_name'];?></td>
						<td class='t25'><?php echo $officer['returning_date'];?></td>
					</tr>
					<?php endforeach ?>
				</tbody>
			</table>
		</div>
	</section>
</div>