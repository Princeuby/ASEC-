	<script src="<?php echo base_url('assets/js/datepickr.min.js'); ?>"></script>
    <script>
        // Regular datepickr
        datepickr('#datepickr', {dateFormat: 'Y-m-d'});

        // Custom date format
        datepickr('.datepickr', { minDate: new Date().getTime(), dateFormat: 'Y-m-d'});

        // Min and max date
        datepickr('#minAndMax', {
            // few days ago
            minDate: new Date().getTime() - 2.592e8,
            // few days from now
            maxDate: new Date().getTime() + 2.592e8
        });

        // datepickr on an icon, using altInput to store the value
        // altInput must be a direct reference to an input element (for now)
        datepickr('.calendar-icon', { altInput: document.getElementById('calendar-input') });

        // If the input contains a value, datepickr will attempt to run Date.parse on it
        datepickr('[title="parseMe"]');

        // Overwrite the global datepickr prototype
        // Won't affect previously created datepickrs, but will affect any new ones
        datepickr.prototype.l10n.months.shorthand = ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'June', 'July', 'Aug', 'Sept', 'Cct', 'Nov', 'Dec'];
        datepickr.prototype.l10n.months.longhand = ['January', 'February', 'March', 'April', 'May', 'June', 'July', 'August', 'September', 'October', 'November', 'December'];
        datepickr.prototype.l10n.weekdays.shorthand = ['Sun', 'Mon', 'Tue', 'Wed', 'Thur', 'Fri', 'Sat'];
        datepickr.prototype.l10n.weekdays.longhand = ['Sunday', 'Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday', 'Saturday'];
        datepickr('#someEnglish.please', { dateFormat: '\\ j F Y' });
    </script>

	<div class="push"></div>
	</div>
	<div id="footer">
		<!-- Copyright -->
		<ul class="copyright">
			<li>&copy; <a href='http://aun.edu.ng'>American University of Nigeria.</a> All rights reserved.</li><li>Design: <a href="#">ASEC Team</a></li>
		</ul>
	</div>

	<!-- Scripts -->
	<script src="<?php echo base_url('assets/js/jquery.min.js');?>"></script>
	<script src="<?php echo base_url('assets/js/jquery.scrolly.min.js');?>"></script>
	<script src="<?php echo base_url('assets/js/jquery.scrollzer.min.js');?>"></script>
	<script src="<?php echo base_url('assets/js/skel.min.js');?>"></script>
	<script src="<?php echo base_url('assets/js/util.js');?>"></script>
	<!--[if lte IE 8]><script src="<?php echo base_url('assets/js/ie/respond.min.js');?>"></script><![endif]-->
	<script src="<?php echo base_url('assets/js/main.js');?>"></script>
	<script src="<?php echo base_url('assets/js/tinymce/tinymce.min.js');?>"></script>
	<script>tinymce.init({selector:'textarea'});</script>
	</body>
</html>