			<header>
				<h2 class="alt">Job <strong>Vacancies</strong></h2>
			</header>
			<?php
				echo "<span><h3>$no_vacancy</h3></span>";
				echo form_open("vacancy/view_vacancy");
				foreach ($vacancies as $vacancy): 
					echo "<section> 
							<h3>$vacancy[position]</h3>
							<p><span>Created on: $vacancy[opening_date]</span><br/>
							$vacancy[department]<br/>
							<button class='2u 12u$(mobile) center' name='viewVac' 
								value='$vacancy[vacancy_id]'>Click to View/Apply</button></p>
						</section>";
				endforeach;
				echo form_close();
			?>

		</div>
	</section>
</div>