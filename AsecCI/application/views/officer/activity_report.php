	    <span id="disp"></span>
		<script>setInterval(clk, 100);</script>
			<header>
				<h2 class="alt">Your Activity <strong>Report</strong></h2>
				<p>Don't  forget the small details that no one cares about</p>
			</header>
			<section class="6u center size-panel">
				<?php echo form_open('$designation/activity_report') ?>
				    <label><input type="text" name="incident" placeholder="Incident" class="size-input"></label>
				    <label><textarea name="details" placeholder="I found a missing dog" class="size-inpu"></textarea></label><br>
				    <input type="submit" name="submit" value="Add">
				</form>
			</section>
			
		</div>
	</section>
</div>