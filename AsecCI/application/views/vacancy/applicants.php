			<header>
				<h2 class="alt">Create <strong>Vacancy</strong></h2>
			</header>
			<section class="center">
				<?php //echo "<span><h3>$failed_create</h3></span>"; ?>
				<section id="createvacancy">
					<hr/>
					<?php echo form_open("vacancy/applicants"); ?>
						<!-- <input id="SnapHostID" name="SnapHostID" type="hidden" value="78QNNFDX7SNS" /> -->
						<table border="0" cellpadding="0" cellspacing="0">
							<tr>
								<td style="width:50%">
									<b>First name *</b><br/>
									<input name="First_Name" type="text" maxlength="50" style="width:260px" />
								</td>
								<td style="width:50%">
									<b>Last name *</b><br />
									<input name="Last_Name" type="text" maxlength="50" style="width:260px" />
								</td>
							</tr>
							<tr>
								<td colspan="2">
									<b>Email *</b><br />
									<input name="Email_Address" type="text" maxlength="100" style="width:535px" />
								</td>
							</tr>
							<tr>
								<td colspan="2">
									<b>Portfolio website</b><br />
									<input name="Portfolio" type="text" maxlength="255" value="http://" style="width:535px" />
								</td>
							</tr>
							<tr>
								<td colspan="2">
									<b>Position you are applying for *</b><br />
									<input name="Position" type="text" maxlength="100" style="width:535px" />
								</td>
							</tr>
							<tr>
								<td style="width:50%">
									<b>Salary requirements</b><br />
									<input name="Salary" type="text" maxlength="50" style="width:260px" />
								</td>
								<td style="width:50%">
									<b>When can you start?</b><br />
									<input name="StartDate" type="text" maxlength="50" style="width:260px" />
								</td>
							</tr>
							<tr>
								<td style="width:50%">
									<b>Phone *</b><br />
									<input name="Phone" type="text" maxlength="50" style="width:260px" />
								</td>
								<td style="width:50%">
									<b>Fax</b><br />
									<input name="Fax" type="text" maxlength="50" style="width:260px" />
								</td>
							</tr>
							<tr>
								<td colspan="2">
									<b>Are you willing to relocate?</b><br />
									<input name="Relocate" type="radio" value="Yes" checked="checked" /> Yes &nbsp; &nbsp; &nbsp;
									<input name="Relocate" type="radio" value="No" /> No &nbsp; &nbsp; &nbsp;
									<input name="Relocate" type="radio" value="NotSure" /> Not sure
								</td>
							</tr>
							<tr>
								<td colspan="2">
									<b>Last company you worked for</b><br />
									<input name="Organization" type="text" maxlength="100" style="width:535px" />
								</td>
							</tr>
							<tr>
								<td colspan="2">
									<b>Reference / Comments / Questions</b><br />
									<textarea name="Reference" rows="7" cols="40" style="width:535px"></textarea>
								</td>
							</tr>
						</table>
					</form>
				</section>
				<input name="Submit" type="submit" value="Create Vacancy" />
			</section>

		</div>
	</section>
</div>
