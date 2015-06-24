<?php
require_once 'Officer.php';

class Supervisor extends Officer {

	public function __construct() {
            parent::__construct();
            $this->load->model('supervisor_model');
            
    }
	
	public function index() {
		$data = $this->set_data();
	    $this->load->view('templates/header', $data);
	    $this->load->view('templates/nav', $data);
	    $this->load->view($this->session->userdata('home').'/index');
	    $this->load->view('templates/footer');
	}

	protected function set_data($page='Home') { // sets the data variables to avoid repition
		$data = parent::set_data($page);
		$data['functions'] = ['home', 'schedule', 'leaves', 'leave request', 'activity report'];

		return $data;
	} 

	public function home() {
		parent::home();
	}

	public function activity_report() {
		parent::activity_report();
	} 

	public function leaves() {
		parent::leaves();
	}

}
?>