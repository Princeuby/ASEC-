			<header>
				<h2 class="alt">Job <strong>Vacancies</strong></h2>
			</header>
			
			<?php
				echo "<span><h3>$no_vacancy</h3></span>";
				foreach ($vacancies as $vacancy): 
					echo "<section> 
							<a href='" . base_url('vacancy/description') . "'><h3>$vacancy[position]</h3></a>
							<p>$vacancy[department]</p>
						</section>";
				endforeach
			?>

		</div>
	</section>
</div>