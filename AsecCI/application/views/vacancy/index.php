			<header>
				<h2 class="alt">Job <strong>Vacancies</strong></h2>
			</header>
			<?php
				echo "<span><h3>$no_vacancy</h3></span>";
				echo form_open("vacancy/view_vacancy");
				foreach ($vacancies as $vacancy): 
					echo "<section id='incidents'><div class='10u 12u$(mobile) center'><article>
							<header>
								<h3>$vacancy[position]</h3>
								<span>Created On: <span class='blue-text'>$vacancy[opening_date]</span></span><br>
								<span>Closing On: <span class='blue-text'>$vacancy[closing_date]</span></span>
							</header>
							$vacancy[summary]
							<br><button class='center' name='viewVac' 
								value='$vacancy[vacancy_id]'>Click to View/Apply</button></p>
						</article></div></section>";
				endforeach;
				echo form_close();
			?>

		</div>
	</section>
</div>