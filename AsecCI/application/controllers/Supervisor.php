<?php
require_once 'Officer.php';

class Supervisor extends Officer {

	public function __construct() {
            parent::__construct();
            $this->load->model('supervisor_model');
            
    }
	
	public function index() {
		parent::index();
	}

	private function set_data($page='Home') { // sets the data variables to avoid repition
		$data = parent::set_data($page);
		$data['functions'] = ['home', 'schedule', 'leaves', 'leave reports', 'activity report'];

		return $data;
	} 

	public function home() {
		parent::home;
	}
}
?>