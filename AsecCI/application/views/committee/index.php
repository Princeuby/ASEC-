			<header>
				<h2 class="alt">Active <strong>Vacancies</strong></h2>
			</header>
			<?php
				echo "<span><h3>$none_active</h3></span>";
				echo form_open("committee/index");
				foreach ($active_vacancies as $active): 
					echo "<section id='incidents'><div class='10u 12u$(mobile) center'><article>
							<header>
								<h3>$active[position]</h3>
								<span>Closing On: <span class='blue-text'>$active[closing_date]</span></span><br>
								<span>Number of Pending Applicants: <span class='blue-text'>$active[applicant_count]</span></span><br>
							</header>
							$active[summary]
							<br><button class='center' name='viewAct' 
								value='$active[vacancy_id]'>Review</button>
							<button class='center' name='closeAct' 
								value='$active[vacancy_id]'>End Review</button></p>
						</article></div></section>";
				endforeach;
				echo form_close();
			?>

		</div>
	</section>
</div>