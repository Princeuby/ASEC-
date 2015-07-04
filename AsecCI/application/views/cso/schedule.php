			<style>
				#not-approved{ display: none; }
			</style>
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
			<?php echo form_open("$designation/set_schedule") ?>
				<section id='question' class="4u 8u$(mobile) center">
					<?php if ($status === null) { ?>
					<h4>Approved?</h4>
					<button class='link-button green-box t25' name='yes' 
						value="<?php echo $location .'.'. $selected_shift; ?>">
						Yes</button>
					<button type="button" class='link-button red-box t25' onclick="showComment();">
						No</button>
					<?php } else {?>
					<a href="<?php echo base_url("$designation"); ?>" class='link-button'>Back</a>
					<?php } ?>
				</section>	
				<section id='not-approved' class="8u 8u$(mobile) center">
					Reason
					<textarea name='comment'></textarea>
					<button class='link-button red-box t25' name='no' 
						value="<?php echo $location .'.'. $selected_shift; ?>">
						Not Approved</button>
				</section>
			</form>	
			<script>
				function showComment() {
					document.getElementById('question').style.display = 'none';
					document.getElementById('not-approved').style.display = 'block';
					window.location.hash = 'not-approved';
				}
			</script>	
		</div>
	</section>
</div>