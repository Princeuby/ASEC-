<?php
require_once 'Officer.php';

class Cso extends Officer {
	
	protected function set_data($page='Home') { // sets the data variables to avoid repition
		$data = parent::set_data($page);
		$data['functions'] = ['home', 'pending leaves', 'view activity reports'];

		return $data;
	} 
	
	public function index() {
		$data = $this->set_data();
		$data['not_approved'] = $this->{$this->session->userdata('model')}->get_schedules(0);
		$data['pending'] = $this->{$this->session->userdata('model')}->get_schedules();

		$data['display_n'] = '';
		$data['display_p'] = '';
		
		if (empty($data['not_approved']))
			$data['display_n'] = 'None';
		if (empty($data['pending']))
			$data['display_p'] = 'None';
		
		$this->load->view('templates/header', $data);
	    $this->load->view('templates/nav');
	    $this->load->view($this->session->userdata('home').'/index');
	    $this->load->view('templates/footer');
	}

	public function pending_leaves() {
		$data = $this->set_data('Pending Leaves');
		//Gets all the request for leave
		$data['pending_leaves'] = $this->{$this->session->userdata('model')}->get_all_leave_requests();
		$data['display_all_leaves'] = 'block';
		$data['no_leave_requests'] = '';
		$data['display_approval'] = 'None';
		$data['failed_approval'] = '';

		//Check if there are pending leave requests
		if (empty($data['pending_leaves'])) {
			//No unattended leave requests
			$data['display_all_leaves'] = 'None';
			$data['no_leave_requests'] = "There are currently no unapproved leave requests";
		}

		$this->load->helper('form');

	    $this->load->view('templates/header', $data);
	    $this->load->view('templates/nav', $data);
	    
	    if ($this->input->post('setApp')) {
	    	$data['selected_leave'] = $this->{$this->session->userdata('model')}->get_leave_record($this->input->post('setApp'));
	    	$data['display_approval'] = 'block';
	    }

	    $this->load->view($this->session->userdata('home').'/pending_leaves', $data);
	    $this->load->view('templates/footer');
	}
 
 	public function leave_approval() {
 		$this->load->helper('form');
	    $this->load->library('form_validation');

		$this->form_validation->set_rules('approval-days', 'Number', 'required');
	    $this->form_validation->set_rules('approval-status', 'Text', 'required');

	    if ($this->form_validation->run() === TRUE) {
			$leaveID = strip_tags($this->input->post('buttonLeaveId'));
			$proceedingDate = strip_tags($this->input->post('buttonProceedingDate'));
	    	$entitledDays = strip_tags($this->input->post('approval-days'));
	    	$approvedStatus = strip_tags($this->input->post('approval-status'));
	    	if ($approvedStatus === "Approved") {
	    		$approvedStatus = '1';
	    	}
	    	elseif ($approvedStatus === "Not Approved") {
	    		$approvedStatus = '0';
	    	}
	    	$comments = strip_tags($this->input->post('approval-comment'));
	    	$this->{$this->session->userdata('model')}->set_approval_status($leaveID, $proceedingDate, $entitledDays, $approvedStatus, $comments);
	    	redirect($this->session->userdata('home').'/pending_leaves');
		}
		$data['failed_approval'] = "Failed to approve leave, Please try again!";
		redirect($this->session->userdata('home').'/pending_leaves');
 	}
	 
	public function show_schedule() {
		$data = $this->set_data();
		if ($this->input->post('show-schedule')) {
			list($data['location'], $data['selected_shift']) = explode('.', $this->input->post('show-schedule'));	
			$shifts = ["Morning"=>"Afternoon", "Afternoon"=>"Night", "Night"=>"Morning"];
			$officers = $this->{$this->session->userdata('model')}->get_officers_schedule(
					$data['location'], $shifts[$data['selected_shift']]);
			$data['days'] = $this->get_working_days($officers);
			
			$this->load->view('templates/header', $data);
		    $this->load->view('templates/nav');
		    $this->load->view($this->session->userdata('home').'/schedule');
		    $this->load->view('templates/footer');
		}
		else
			redirect($this->session->userdata('home'));
	}
}
?>