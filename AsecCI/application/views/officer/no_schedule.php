			<header>
				<h2 class="alt">Your <strong>Schedule</strong></h2>
				<p>Week: <span class='blue-text'><?php echo date('d/m/Y', strtotime($weekStart))
					   . " - " . date('d/m/Y', strtotime($weekStart .' + 1 week - 1 day')); ?></span>
				</p>
			</header>
			
			<h3>No schedule this week</h3>
		</div>
	</section>
</div>