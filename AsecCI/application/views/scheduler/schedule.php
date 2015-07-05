			<header>
				<h2 class="alt"><?php echo 
					"<strong>" .ucwords(strtolower($location)) ." ".
					 $selected_shift ."</strong> Schedule"; ?></h2><hr>
			</header>
			<table class="8u center size-table">
				<thead>
					<tr>
						<th>Day</th>
						<th>Officers</th>
					</tr>
				</thead>
				<tbody>	
					<?php foreach ($days as $day => $officers): ?>
				    <tr>
						<td class="t25"><?php echo $day;?></td>				
						<td class="t40">
							<?php foreach ($officers as $officer) {
								echo $officer . "<br>";
							} ?></td>		
					</tr>
					<?php endforeach ?>
				</tbody>
			</table>
			<a href="<?php echo base_url($designation); ?>" class='link-button'>Back to Scheduling</a><br><br>
			<a href="<?php echo base_url($designation.'/created_schedules'); ?>" class='link-button'>Created Schedules</a>
		</div>
	</section>
</div>