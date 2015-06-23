<?php
class Officer extends CI_Controller {
	
	public function __construct() {
        parent::__construct();
        $this->load->model('officer_model');
		$this->load->library('session');
    }
	
	public function index() {
		$data = $this->set_data();
	    $this->load->view('templates/header', $data);
	    $this->load->view('templates/nav', $data);
	    $this->load->view('officer/index');
	    $this->load->view('templates/footer');
	}
	
	private function set_data($page='Home') { // sets the data variables to avoid repition
		$data['title'] = 'Officer';
	    $data['page'] = $page;
		$data['name'] = $this->session->userdata('officerFullName');
		$data['rank'] = $this->session->userdata('officerRank');
		$data['id'] = $this->session->userdata('officerID');
		$data['functions'] = ['home', 'schedule', 'test', 'test3', 'activity report'];
		
		return $data;
	}
	
	public function home() {
		redirect('/officer');
	}
	
	public function activity_report() {
		$data = $this->set_data('Activity Report');
		// Gets activity report for current shift
		$data['report'] = $this->officer_model->get_activity_report($data['id']);
		$data['display'] = 'None'; // Sets CSS display rule of create activity report form in view
		$data['display_incident'] = 'block'; // Sets CSS display rule of new incident form in view
		// Checks if activity report has been created
		if (empty($data['report'])) {
			// Creates new activity report **Uses wrong previous ID**
			$data['display'] = 'block'; // Makes new activity report form visible
			$data['display_incident'] = 'None'; // Hides the new incident report form
		}
	
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
	
	// Creates new activity report from form
	public function new_activity_report() {
		$this->load->helper('form');
	    $this->load->library('form_validation');
		$this->form_validation->set_rules('prevID', 'Username', 'required');
		
		if ($this->form_validation->run() === TRUE) {
			$previousOfficerID = $user = $this->input->post('prevID');
			$officerID = $this->session->userdata('officerID');
			$this->officer_model->create_activity_report($officerID,$previousOfficerID); 
		}
		$this->activity_report();		
	}
}	
	
?>