<?php
require_once 'Supervisor.php';

class Other extends Supervisor {

	protected function set_data($page='Home') { // sets the data variables to avoid repition
		$data = parent::set_data($page);
		$data['functions'] = ['home', 'schedule', 'activity report', 'view activity reports', 'leaves'];

		return $data;
	} 
}
?>