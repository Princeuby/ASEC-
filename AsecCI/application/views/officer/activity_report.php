	    <style> /* I had to do this */
			#new-report { display: <?php echo $display_create; ?>; }
			#not-new {	display: <?php echo $display_report; ?>; }
			#incidents { display: <?php echo $display_incidents; ?>; }
		</style>
			<header>
				<h2 class="alt">Activity Report<strong> Details</strong></h2>
			</header>
			<?php if ($onDuty) { ?>
			<section id="new-report" class="4u 12u$(mobile) center">
				<?php echo form_open("$designation/new_activity_report") ?>
					<label>Previous Officer<br><select name="prevID" required>	
					<option value='' Selected>Choose Officer</option>
					<?php foreach ($previous_officers as $officers) {
						echo "<option value='$officers[officer_id]'>$officers[officer_name]</option>"; 
					}?>				
					</select></label>	
					<button class='ts' name='submit' value='new-report'>
								New Report</button>
				</form>
			</section>
			<section id="not-new">
				<hr>
				<section id="report">
					<p class="10u 12u$(mobile) center">
					Time Started: <span class="blue-text"><?php echo $report['date_timeIn'];?></span><br>
					Shift: <span class="blue-text"><?php echo $report['shift'];?></span><br>
					Previous Officer: <span class="blue-text"><?php echo "$previous_officer_name 
								($report[previous_officer_id])";?></span></p>
				</section>
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
				<hr><br>
				<section class="10u 12u$(mobile) center">
					<?php echo form_open("$designation/activity_report") ?>
					    <label class="6u center">Incident Type<input type="text" name="incident-type" placeholder="Inventory" required></label>
					    <label class="center">Incident Details<textarea name="incident-details"></textarea></label><br>
					    <input type="submit" name="submit" value="Add Incident">
					</form>
				</section>
				<hr><br>
				<section id="next-officer" class="4u 12u$(mobile) center">
					<?php echo form_open("$designation/close_activity_report") ?>
						<label>Next Officer<br><select name="nextID" required>	
						<option value='' Selected>Choose Officer</option>
						<?php foreach ($next_officers as $officers) {
							echo "<option value='$officers[officer_id]'>$officers[officer_name]</option>"; 
						}?>				
						</select></label>	
						<button class='ts' name='submit' value='new-report'>Close Report</button>
					</form>
				</section>
				<!--<section id="next-officer" class="6u 12u$(mobile) center">
					<?php echo form_open("$designation/close_activity_report") ?>
					    <label><input type="text" name="nextID" placeholder="Next Officer ID" class="size-input"></label>					
						<input type="submit" name="submit" value="Close Report">
					</form>
				</section>-->
			</section>
			<?php } else {
				echo "<br><br><h3 class='8u center'>You are only allowed to create reports
				 during your scheduled shift</h3>";
			} ?>
		</div>
	</section>
</div>