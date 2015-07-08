<?php
require_once 'Supervisor.php';

class Other extends Supervisor {

	// Prevents other user types from coming to this page
	protected function protectPage() {
		return ($this->session->userdata('home') === 'other');
	}
	
	protected function set_data($page='Home') { // sets the data variables to avoid repition
		$data = parent::set_data($page);
		$data['functions'] = ['view activity reports', 'leaves', 'manage account'];

		return $data;
	} 

	public function index() {
		redirect($this->session->userdata('home').'/view_activity_reports');
	}
}
?>