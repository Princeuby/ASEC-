<?php
class Officer extends CI_Controller {
	
	public function __construct() {
        parent::__construct();
        $this->load->model('officer_model');
		$this->load->library('session');
		if ($this->session->userdata('officerID') === null) 
			redirect('login/logout');
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
		$data['previous_officer_name'] = $this->officer_model->get_officer_name($data['report']['previous_officer_id']);
		$data['display_create'] = 'None'; // Sets CSS display rule of create activity report form in the view
		$data['display_report'] = 'block'; // Sets CSS display rule of new created report in the view
		$data['display_incidents'] = 'block'; // Sets CSS display rule of incident section in the view
		$data['incidents'] = $this->officer_model->get_incidents($data['report']['report_id']);
		// Checks if activity report has been created
		if (empty($data['report'])) {
			// Creates new activity report
			$data['display_create'] = 'block'; // Makes new activity report form visible
			$data['display_report'] = 'None'; // Hides the new incident report form
		}
		if (empty($data['incidents'])) {
			$data['display_incidents'] = 'None'; // Hides the incident lines
		}
		
		$this->load->helper('form');
	    $this->load->library('form_validation');
		
		$this->form_validation->set_rules('incident-type', 'Text', 'required');
	    $this->form_validation->set_rules('incident-details', 'Text', 'required');

		$this->load->view('templates/header', $data);
		$this->load->view('templates/nav', $data);
			
		if ($this->form_validation->run() === TRUE) {
			$incidentType = strip_tags($this->input->post('incident-type'));
			$incidentDetails = strip_tags($this->input->post('incident-details'));
			$this->officer_model->create_incidents($data['report']['report_id'],
			$incidentType, $incidentDetails);
			redirect('/officer/activity_report');
		}

		$this->load->view('officer/activity_report');
	    $this->load->view('templates/footer');
		
	}
	
	// Creates new activity report from form
	public function new_activity_report() {
		$this->load->helper('form');
	    $this->load->library('form_validation');
		$this->form_validation->set_rules('prevID', 'Username', 'required');
		
		if ($this->form_validation->run() === TRUE) {
			$previousOfficerID = strip_tags($this->input->post('prevID'));
			$officerID = $this->session->userdata('officerID');
			$this->officer_model->create_activity_report($officerID,$previousOfficerID); 
		}
		redirect('/officer/activity_report');;		
	}
	
	// Closes an activity report
	public function close_activity_report() {
		$this->load->helper('form');
	    $this->load->library('form_validation');
		$this->form_validation->set_rules('nextID', 'Username', 'required');
		
		if ($this->form_validation->run() === TRUE) {
			$report = $this->officer_model->get_activity_report(
				$this->session->userdata('officerID'));
			$nextOfficerID = strip_tags($this->input->post('nextID'));
			$this->officer_model->close_activity_report($report['report_id'],$nextOfficerID); 
		}
		redirect('/officer/activity_report');;		
	}
}	
	
?>