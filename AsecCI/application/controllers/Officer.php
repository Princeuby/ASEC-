<?php
class Officer extends CI_Controller {
	
	public function index() {
		$data = $this->set_data();
	    $this->load->view('templates/header', $data);
	    $this->load->view('templates/nav', $data);
	    $this->load->view('officer/index');
	    $this->load->view('templates/footer');
	}
	
	private function set_data($page='Home') { // sets the data variables to avoid repition
		$this->load->library('session');
		$data['title'] = 'Officer';
	    $data['page'] = $page;
		$data['name'] = $this->session->userdata('officerFullName');
		$data['rank'] = $this->session->userdata('officerRank');
		$data['functions'] = ['home', 'schedule', 'test', 'test3', 'activity report'];
		
		return $data;
	}
	
	public function home() {
		redirect('/officer');
	}
	
	public function activity_report() {
		$data = $this->set_data('Activity Report');
		$this->load->helper('form');
	    $this->load->library('form_validation');
		
		$this->form_validation->set_rules('incident', 'Username', 'required');
	    $this->form_validation->set_rules('details', 'Text', 'required');

		$this->load->view('templates/header', $data);
		$this->load->view('templates/nav', $data);
			
		if ($this->form_validation->run() === FALSE) {
		    $this->load->view('officer/activity_report');
	    }
		else {
	    	$this->load->view('officer/activity_success');
		}
		
	    $this->load->view('templates/footer');
	}
}	
	
?>