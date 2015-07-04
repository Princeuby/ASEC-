<?php
require_once 'Supervisor.php';

class Other extends Supervisor {

	protected function set_data($page='Home') { // sets the data variables to avoid repition
		$data = parent::set_data($page);
		$data['functions'] = ['activity report', 'view activity reports', 'leaves'];

		return $data;
	} 

	public function index() {
		redirect($this->session->userdata('home').'/activity_report');
	}
}
?>