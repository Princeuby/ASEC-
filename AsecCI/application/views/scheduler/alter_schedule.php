			<style>
			</style>
			<header>
				<h2 class="alt">Alter <strong>Schedule</strong></h2>
				<p>Week: <span class='blue-text'><?php echo date('d/m/Y', strtotime($weekStart))
					   . " - " . date('d/m/Y', strtotime($weekStart.' + 1 week - 1 day')); ?></span>
				</p>
			</header>
		    <p><?php echo $this->session->flashdata('success'); ?></p>
			<section class="row">
				<div class="6u 12u$(mobile) center">
					<?php echo form_open("$designation/alter_schedule") ?>
						<label class='8u center'>First Officer ID:<br>
							<input type="text" class='size-input' placeholder='P.123' name='officer-id'
								 value="<?php echo $officerID;?>" required></label>
						<button name='get-schedule' value='get'>Get</button>
					</form>
				</div>
				<?php if ($options) { ?>
					<div id="options" class="6u 12u$(mobile) center">
						<?php echo form_open("$designation/alter_schedule") ?>
							<label class='8u center'>Second Officer<br><select name='second-officer' required>
								<?php foreach ($options as $option) {
									echo "<option value='$option[officer_id]'>$option[officer_name] ($option[officer_id])</option>";
								}?>
							</select></label>
							<label class='center'><button name='get-other-officer' value='get'>Select</button></label>
						</form>
					</div>
				<?php } ?>
			</section>
			<?php if (count($schedules) > 0) {
			echo form_open("$designation/alter_schedule") ?>
				<br>
				<table id="not-approved" class="9u center size-table">
					<caption><h3>Schedules</h3></caption>	
					<thead>
						<tr>
							<th>Officer Name</th>
							<th>Location</th>
							<th>Shift</th>
						</tr>
					</thead>
					<tbody>	
						<?php foreach ($schedules as $schedule): ?>
					    <tr>
							<td><?php echo $schedule['officer_name']; ?></td>				
							<td><?php echo $schedule['location']; ?></td>				
							<td><?php echo $schedule['shift']; ?></td>	
						</tr>
						<?php endforeach ?>
					</tbody>
				</table>
				<label class='center'><button name='swap' value='swap'>Swap</button></label>
			</form>
			<?php } ?>
		</div>
	</section>
</div>