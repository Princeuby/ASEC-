<?php
class Officer extends CI_Controller {
	
	public function __construct() {
            parent::__construct();
            $this->load->model('officer_model');
    }
	
	public function index() {
		$data = $this->set_data();
	    $this->load->view('templates/header', $data);
	    $this->load->view('templates/nav', $data);
	    $this->load->view($this->session->userdata('home').'/index');
	    $this->load->view('templates/footer');
	}
	
	private function set_data($page='Home') { // sets the data variables to avoid repition
		$this->load->library('session');
		$data['title'] = 'Officer';
	    $data['page'] = $page;
		$data['name'] = $this->session->userdata('officerFullName');
		$data['rank'] = $this->session->userdata('officerRank');
		$data['id'] = $this->session->userdata('officerID');
		$data['functions'] = ['home', 'schedule', 'test', 'test3', 'activity report'];
		
		return $data;
	}
	
	public function home() {
		redirect('/'.$this->session->userdata('home');
	}
	
	public function activity_report() {
		$data = $this->set_data('Activity Report');
		// Gets activity report for current shift
		$data['report'] = $this->officer_model->get_activity_report($data['id']);
		// Checks if activity report has been created
		if (empty($data['report'])) {
			// Creates new activity report **Uses wrong previous ID**
			$data['report'] = $this->officer_model->create_activity_report(
				$data['id'],$data['id']); 
			$data['report'] = $this->officer_model->get_activity_report($data['id']);
		}
		
		// $this->load->view('templates/header', $data);
		// $this->load->view('templates/nav', $data);
		// $this->load->view('officer/activity_report', $data);
	    // $this->load->view('templates/footer');
		$this->load->helper('form');
	    $this->load->library('form_validation');
		
		$this->form_validation->set_rules('incident', 'Username', 'required');
	    $this->form_validation->set_rules('details', 'Text', 'required');

		$this->load->view('templates/header', $data);
		$this->load->view('templates/nav', $data);
			
		if ($this->form_validation->run() === FALSE) {
		    $this->load->view($this->session->userdata('home').
		    	'/activity_report');
	    }
		else {
	    	$this->load->view($this->session->userdata('home').
	    		'/activity_success');
		}
		
	    $this->load->view('templates/footer');
		
	}
	
	public function incident() {
		$data = $this->set_data('Activity Report');
		$this->load->helper('form');
	    $this->load->library('form_validation');
		
		$this->form_validation->set_rules('incident', 'Username', 'required');
	    $this->form_validation->set_rules('details', 'Text', 'required');

		$this->load->view('templates/header', $data);
		$this->load->view('templates/nav', $data);
			
		if ($this->form_validation->run() === FALSE) {
		    $this->load->view($this->session->userdata('home').
		    	'/activity_report');
	    }
		else {
	    	$this->load->view($this->session->userdata('home').
	    		'/activity_success');
		}
		
	    $this->load->view('templates/footer');
	}
}	
	
?>