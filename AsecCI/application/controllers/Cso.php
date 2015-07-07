<?php
require_once 'Officer.php';

class Cso extends Officer {
	
	// Prevents other user types from coming to this page
	protected function protectPage() {
		return ($this->session->userdata('home') === 'cso');
	}
	
	protected function set_data($page='Home') { // sets the data variables to avoid repition
		$data = parent::set_data($page);
		$data['functions'] = ['home', 'pending leaves', 'view leaves', 'vacancy', 'view activity reports'];
		$data['weekStart'] = date('Y-m-d', strtotime("this Sunday"));			
		if ($data['weekStart'] === date('Y-m-d'))
			$data['weekStart'] = date('Y-m-d', strtotime("next Sunday"));
		return $data;
	} 
	
	public function index() {
		$data = $this->set_data();
		$data['not_approved'] = $this->{$this->session->userdata('model')}->get_schedules(0, $data['weekStart']);
		$data['pending'] = $this->{$this->session->userdata('model')}->get_schedules(null, $data['weekStart']);
		$data['approved'] = $this->{$this->session->userdata('model')}->get_schedules(1, $data['weekStart']);

		$data['display_n'] = '';
		$data['display_p'] = '';
		$data['display_a'] = '';
		
		if (empty($data['not_approved']))
			$data['display_n'] = 'None';
		if (empty($data['pending']))
			$data['display_p'] = 'None';
		if (empty($data['approved']))
			$data['display_a'] = 'None';
		
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
	    	$data['selected_leave'] = $this->{$this->session->userdata('model')}->
	    		get_leave_record($this->input->post('setApp'));

	    	$data['selected_officer'] = $this->{$this->session->userdata('model')}->
	    		get_officer_details($data['selected_leave']['officer_id']);

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
	    		$this->form_validation->set_rules('approval-comment', 'Text', 'required');
			    if ($this->form_validation->run() === TRUE) {
		    		$approvedStatus = '0';
		    	}
		    	else {
					$this->session->set_flashdata('failed_approve', "Failed to approve leave, please try again!");
					redirect($this->session->userdata('home').'/pending_leaves');
				}
	    	}
	    	$comments = strip_tags($this->input->post('approval-comment'));
	    	$this->{$this->session->userdata('model')}->set_approval_status($leaveID, $proceedingDate, $entitledDays, $approvedStatus, $comments);
	    	redirect($this->session->userdata('home').'/pending_leaves');
		}
		else {
			$this->session->set_flashdata('failed_approve', "Failed to approve leave, please try again!");
		}
		redirect($this->session->userdata('home').'/pending_leaves');
 	}

 	public function view_leaves() {
 		$data = $this->set_data('View Leaves');
 		$model = $this->session->userdata('model');
 		$data['all_leaves'] = $this->{$model}->get_all_leaves();

		for ($i = 0; $i < count($data['all_leaves']); $i ++) {
			if ($data['all_leaves'][$i]['returning_date'] === Null) {
				$data['all_leaves'][$i]['returning_date'] = "Not Assigned";
			}
			if ($data['all_leaves'][$i]['approved_status'] === '1') {
				$data['all_leaves'][$i]['approved_status'] = "Approved";
			}
			elseif ($data['all_leaves'][$i]['approved_status'] === '0') {
				$data['all_leaves'][$i]['approved_status'] = "Not Approved";
			}
			else {
				$data['all_leaves'][$i]['approved_status'] = "Pending";
			}
			$officerInfo = $this->{$model}->get_officer_details($data['all_leaves'][$i]['officer_id']);

			$officerInfoName = $this->{$model}->get_officer_name($data['all_leaves'][$i]['officer_id']);
			$supervisorInfoName = $this->{$model}->get_officer_name($data['all_leaves'][$i]['supervisor_id_leaves']);

			$data['all_leaves'][$i]['officer_name'] = $officerInfoName;
			$data['all_leaves'][$i]['officer_rank'] = $officerInfo['rank'];
			$data['all_leaves'][$i]['supervisor_name'] = $supervisorInfoName;

 		}

 		$data['display_leave_records'] = '';
		$data['no_record'] = '';
		$data['display_a_leave'] = 'None';

		if (empty($data['all_leaves'])) {
			//No Leave history
			$data['display_leave_records'] = 'None';
			$data['no_record'] = "There is no leave record to show";
		}

		$data['officer_leave'] = '';

		$this->load->helper('form');

	    if ($this->input->post('view-one-leave')) {
			$data['officer_leave'] = $this->{$model}->
				get_all_leaves($this->input->post('view-one-leave'));
				
			if ($data['officer_leave']['returning_date'] === Null) {
				$data['officer_leave']['returning_date'] = "Not Assigned";	
			} 
			if ($data['officer_leave']['approved_status'] === "1") {
				$data['officer_leave']['approved_status'] = "Approved";
			}
			else if ($data['officer_leave']['approved_status'] === "0") {
				$data['officer_leave']['approved_status'] = "Not Approved";
			}
			else {
				$data['officer_leave']['approved_status'] = "Pending";	
			}

			$officer_Info = $this->{$model}->get_officer_details($data['officer_leave']['officer_id']);

			$officer_InfoName = $this->{$model}->get_officer_name($data['officer_leave']['officer_id']);
			$supervisor_InfoName = $this->{$model}->get_officer_name($data['officer_leave']['supervisor_id_leaves']);

			$data['officer_leave']['officer_name'] = $officer_InfoName;
			$data['officer_leave']['officer_rank'] = $officer_Info['rank'];
			$data['officer_leave']['supervisor_name'] = $supervisor_InfoName;

			$data['display_a_leave'] = 'block';
		}

		if ($this->input->post('close-one-leave')) {
	    	$data['display_a_leave'] = 'None';
	    }
	    
	    $this->load->view('templates/header', $data);
	    $this->load->view('templates/nav', $data);
	    $this->load->view($this->session->userdata('home').'/view_leaves', $data);
	    $this->load->view('templates/footer');

 	}

	public function show_schedule() {
		if ($this->input->post('show-schedule')) {
			$data = $this->set_data();
			list($data['location'], $data['selected_shift']) = explode('.', $this->input->post('show-schedule'));	
			$shifts = ["Morning"=>"Afternoon", "Afternoon"=>"Night", "Night"=>"Morning"];
			$status = $this->{$this->session->userdata('model')}->get_schedule_status(
					$data['location'], $data['selected_shift'], $data['weekStart']);
			$data['status'] = $status['approved'];
			
			if ($data['status'] == 1)
				$officers = $this->{$this->session->userdata('model')}->get_approved_officers_schedule(
					$data['location'], $data['selected_shift'], $data['weekStart']);
			else
				$officers = $this->{$this->session->userdata('model')}->get_officers_schedule(
					$data['location'], $shifts[$data['selected_shift']], $data['weekStart']);

			$data['days'] = $this->get_working_days($officers);
			
			$this->load->view('templates/header', $data);
		    $this->load->view('templates/nav');
		    $this->load->view($this->session->userdata('home').'/schedule');
		    $this->load->view('templates/footer');
		}
		else
			redirect($this->session->userdata('home'));
	}
	
	public function set_schedule() {
		$weekStart = date('Y-m-d', strtotime("this Sunday"));	
		if ($weekStart === date('Y-m-d'))
			$weekStart = date('Y-m-d', strtotime("next Sunday"));
			
		if ($this->input->post('yes')) {
			list($location, $shift) = explode('.', $this->input->post('yes'));
			$this->{$this->session->userdata('model')}->set_schedule_status(
					$location, $shift, 1, $weekStart);
			// Rotating algorithm
			$shifts = ["Morning"=>"Afternoon", "Afternoon"=>"Night", "Night"=>"Morning"];
		
			$officers = $this->{$this->session->userdata('model')}->get_officers($location, $shifts[$shift]);
			foreach ($officers as $officer) 
				$this->{$this->session->userdata('model')}->set_last_shift($officer['officer_id'], $shift);

		}
		elseif ($this->input->post('no')) {
			list($location, $shift) = explode('.', $this->input->post('no'));
			$this->{$this->session->userdata('model')}->set_schedule_status(
					$location, $shift, 0, $weekStart, strip_tags($this->input->post('comment'),
	    		"<ul><ol><li><span><strong><em><h1><h2><h3><h4><h5><h6><blockquote><pre>"));
		}
		redirect($this->session->userdata('home'));
	}

	public function vacancy() {
		$data = $this->set_data('Vacancy');

		$this->load->view('templates/header', $data);
	    $this->load->view('templates/nav', $data);
	    $this->load->view($this->session->userdata('home').'/vacancy', $data);
	    $this->load->view('templates/footer');

	}

	public function add_vacancy() {
		$this->load->helper('form');
		$this->load->library('form_validation');

		$this->form_validation->set_rules('vacant-position', 'Text', 'required');
		$this->form_validation->set_rules('vacant-summary', 'date', 'required');
		$this->form_validation->set_rules('vacant-department', 'Text', 'required');
		$this->form_validation->set_rules('vacant-education-level', 'Text', 'required');
		$this->form_validation->set_rules('vacant-working-experience', 'Text', 'required');
		$this->form_validation->set_rules('vacant-other-specifications', 'Text', 'required');
		$this->form_validation->set_rules('vacant-closing-date', 'date', 'required');


	    if ($this->form_validation->run() === TRUE) {
	    	$position = strip_tags($this->input->post('vacant-position'));
	    	$summary = strip_tags($this->input->post('vacant-summary'));
	    	$department = strip_tags($this->input->post('vacant-department'));
	    	$educationLevel = strip_tags($this->input->post('vacant-education-level'));
	    	$workingExperience = strip_tags($this->input->post('vacant-working-experience'),
	    		"<ul><ol><li><span><strong><em><h1><h2><h3><h4><h5><h6><blockquote><pre>");
	    	$otherSpecifications = strip_tags($this->input->post('vacant-other-specifications'),
	    		"<ul><ol><li><span><strong><em><h1><h2><h3><h4><h5><h6><blockquote><pre>");
	    	$openingDate = date('Y-m-d');
	    	$closingDate = strip_tags($this->input->post('vacant-closing-date'));

	    	$this->{$this->session->userdata('model')}->create_vacancy($position, $summary, $department, $educationLevel, 
	    		$workingExperience, $otherSpecifications, $openingDate, $closingDate);
	    	redirect($this->session->userdata('home'));
	    }
	    else {
			$this->session->set_flashdata('vacancy_failed', "Failed to create vacancy, please try again!");
		}
		redirect($this->session->userdata('home').'/vacancy');
	}
}
?>