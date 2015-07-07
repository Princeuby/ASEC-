<?php
require_once 'Cso.php';

class AVP extends Cso {
	
	// Prevents other user types from coming to this page
	protected function protectPage() {
		return ($this->session->userdata('home') === 'avp');
	}
	
	protected function set_data($page='Home') { // sets the data variables to avoid repition
		$data = parent::set_data($page);
		$data['functions'] = ['officer leaves', 'view activity reports'];
		return $data;
	} 
}