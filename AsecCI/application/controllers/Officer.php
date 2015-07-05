<?php
class Officer extends CI_Controller {
	
	public function __construct() {
        parent::__construct();
		$this->load->library('session');
		if ($this->session->userdata('officerID') === null) 
			redirect('login/logout');
		$this->session->set_userdata('model', $this->session->userdata('home').'_model');
        $this->load->model($this->session->userdata('model'));
    }
	
	public function index() {
		$data = $this->set_data();
		$data['weekStart'] = $this->get_week_start();
		$data['schedule'] = $this->{$this->session->userdata('model')}->get_schedule($data['id'], 
			$data['weekStart']);
		$officer_schedule[] = $data['schedule'];
		$data['days'] = $this->get_working_days($officer_schedule);
	    $this->load->view('templates/header', $data);
	    $this->load->view('templates/nav');
		if (empty($data['schedule']))
		    $this->load->view($this->session->userdata('home').'/no_schedule');
		else
		    $this->load->view($this->session->userdata('home').'/index');
	    $this->load->view('templates/footer');
	}
	
	protected function set_data($page='Home') { // sets the data variables to avoid repition
		$this->load->library('session');
		$data['title'] = ucwords($this->session->userdata('home'));
	    $data['page'] = $page;
		$data['name'] = $this->session->userdata('officerFullName');
		$data['rank'] = $this->session->userdata('officerRank');
		$data['id'] = $this->session->userdata('officerID');
		$data['functions'] = ['home', 'activity report', 'view activity reports', 'leaves'];
		$data['designation'] = $this->session->userdata('home');
		return $data;
	}
	
	// Gets the start of the week for finding the correct schedule
	private function get_week_start() {
		$today = date('Y-m-d');

		if (date('N', strtotime($today)) == 7)
			return $today;
		else
			return date('Y-m-d', strtotime('last Sunday'));
	}
	
	// Gets all the working days of an officer
	public function get_working_days($officers) {
		$days = ['Sunday'=>[], 'Monday'=>[], 'Tuesday'=>[], 'Wednesday'=>[], 'Thursday'=>[],
			 'Friday'=>[], 'Saturday'=>[]];

		// Adds officers to days that are not their off days
		foreach ($days as $day => $schedule) {
			for ($j = 0; $j < count($officers); $j++) {
				if ($day != $officers[$j]['off_day_1'] && $day != $officers[$j]['off_day_2'])
					$days[$day][] = $this->{$this->session->userdata('model')}
						->get_officer_name($officers[$j]['officer_id']);
			}
		}
		return $days;
	} 
	
	public function home() {
		redirect($this->session->userdata('home'));
	}
	
	public function activity_report() {
		$data = $this->set_data('Activity Report');
		$model = $this->session->userdata('model');
		// Gets activity report for current shift
		$current_day = date('Y-m-d'); // Current day
		$shift = $this->{$model}->get_shift(); // Current shift
		$data['report'] = $this->{$model}->get_activity_report($data['id'], $current_day, $shift);
		$data['previous_officer_name'] = $this->{$model}->get_officer_name($data['report']['previous_officer_id']);
		$data['display_create'] = 'None'; // Sets CSS display rule of create activity report form in the view
		$data['display_report'] = 'block'; // Sets CSS display rule of new created report in the view
		$data['display_incidents'] = 'block'; // Sets CSS display rule of incident section in the view
		$data['incidents'] = $this->{$model}->get_incidents($data['report']['report_id']);
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
			// Keeps relevant tags for html formatting
			$incidentDetails = strip_tags($this->input->post('incident-details'),
				"<p><ul><ol><li><span><strong><em><h1><h2><h3><h4><h5><h6><blockquote><pre>");
			$this->{$model}->create_incidents($data['report']['report_id'],
			$incidentType, $incidentDetails);
			redirect($this->session->userdata('home').'/activity_report');
		}

		$this->load->view($this->session->userdata('home').'/activity_report');
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
			$this->{$this->session->userdata('model')}->create_activity_report($officerID,$previousOfficerID); 
		}
		redirect($this->session->userdata('home').'/activity_report');		
	}
	
	// Closes an activity report
	public function close_activity_report() {
		$this->load->helper('form');
	    $this->load->library('form_validation');
		$this->form_validation->set_rules('nextID', 'Username', 'required');
		$model = $this->session->userdata('model');
		
		if ($this->form_validation->run() === TRUE) {
			$current_day = date('Y-m-d'); // Current day
			$shift = $this->{$model}->get_shift(); // Current shift
			$report = $this->{$model}->get_activity_report(
				$this->session->userdata('officerID'), $current_day, $shift);
			$nextOfficerID = strip_tags($this->input->post('nextID'));
			$this->{$model}->close_activity_report($report['report_id'],$nextOfficerID); 
		}
		redirect($this->session->userdata('home').'/activity_report');	
	}
	
	public function view_activity_reports() {
		$data = $this->set_data('View Activity Reports');	
		$officerID = $this->session->userdata('officerID');
		$model = $this->session->userdata('model');
		$this->load->helper('form');
		
		$data['limit'] = 6; // Limits the number of results on the page
		$day = '%';
		$shift = '%';
		$data['shifts'] = $this->{$model}->get_shifts();
		$data['selected_shift'] = '%';
		if ($this->input->post('filter')) {
			$data['limit'] = $this->input->post('limit');
			$day = $this->input->post('day');
			$data['selected_shift'] = $this->input->post('shift');
		}
		
		$data['reports'] = $this->{$model}->get_activity_reports($officerID,
			$day, $data['selected_shift'], $data['limit']);
		for ($i = 0; $i < count($data['reports']); $i ++) {
			$data['reports'][$i]['officer_name'] = $this->{$model}->get_officer_name(
				$data['reports'][$i]['officer_id']);
			$data['reports'][$i]['previous_officer_name'] = $this->{$model}->get_officer_name(
				$data['reports'][$i]['previous_officer_id']);
			$data['reports'][$i]['next_officer_name'] = $this->{$model}->get_officer_name(
				$data['reports'][$i]['next_officer_id']);
		}
		$data['display_reports'] = ''; // For table css display property
		$data['display_report'] = 'None'; // For single report section css display property
		
		if (empty($data['reports']))
			$data['display_reports'] = 'None';
		$this->load->view('templates/header', $data);
		$this->load->view('templates/nav', $data);
		
		if ($this->input->post('report_id')) {
			$data['selected_report'] = $this->{$model}->get_activity_report('%','%','%',
				$this->input->post('report_id'));
				
			$data['previous_officer_name'] = $this->{$model}->get_officer_name(
				$data['selected_report']['previous_officer_id']);
			$data['officer_name'] = $this->{$model}->get_officer_name(
				$data['selected_report']['officer_id']);
			$data['next_officer_name'] = $this->{$model}->get_officer_name(
				$data['selected_report']['next_officer_id']);
			$data['incidents'] = $this->{$model}->get_incidents(
				$data['selected_report']['report_id']);
			$data['display_report'] = 'block';
		}		
		$this->load->view($this->session->userdata('home').'/view_activity_reports', $data);
	    $this->load->view('templates/footer');
	}

	public function leaves() {
		$data = $this->set_data('Leaves');	
		$model = $this->session->userdata('model');
		//Gets leave information for officer
		$data['leaves'] = $this->{$model}->get_officer_leaves($data['id']);
		for ($i = 0; $i < count($data['leaves']); $i ++) {
			if ($data['leaves'][$i]['returning_date'] === Null) {
				$data['leaves'][$i]['returning_date'] = "Not Assigned";
			}
			if ($data['leaves'][$i]['approved_status'] === '1') {
				$data['leaves'][$i]['approved_status'] = "Approved";
			}
			elseif ($data['leaves'][$i]['approved_status'] === '0') {
				$data['leaves'][$i]['approved_status'] = "Not Approved";
			}
			else {
				$data['leaves'][$i]['approved_status'] = "Pending";
			}
		}

		$data['display_leaves'] = '';
		$data['no_leaves'] = '';
		$data['display_request'] = 'None';

		//Check if there is leave history
		if (empty($data['leaves'])) {
			//No Leave history
			$data['display_leaves'] = 'None';
			$data['no_leaves'] = "Sorry, you have no leave record";
		}

		$data['disable_annual'] = '';
		$data['annual_leave'] = $this->{$model}->check_annual_leave($data['id']);
		if ($data['annual_leave'] != 0) {
			$data['disable_annual'] = 'disabled';
		}

		$data['one_leave_selected'] = '';
		$data['leave_supervisor'] = '';
		$data['display_one_leave'] = 'None';
		$data['go_to'] = "";

		$this->load->helper('form');

		if ($this->input->post('apply-leave')) {
			$data['go_to'] = "<script>window.location.hash = 'request_leave';</script>";
	    	$data['display_request'] = 'block';
	    }

	    if ($this->input->post('view-leave')) {
			$data['go_to'] = "<script>window.location.hash = 'leave_view';</script>";

	    	$data['one_leave_selected'] = $this->{$this->session->userdata('model')}->
				get_officer_leave($this->input->post('view-leave'));

			if ($data['one_leave_selected']['returning_date'] === Null) {
				$data['one_leave_selected']['returning_date'] = "Not Assigned";	
			} 
			if ($data['one_leave_selected']['approved_status'] === "1") {
				$data['one_leave_selected']['approved_status'] = "Approved";
			}
			else if ($data['one_leave_selected']['approved_status'] === "0") {
				$data['one_leave_selected']['approved_status'] = "Not Approved";
			}
			else {
				$data['one_leave_selected']['approved_status'] = "Pending";	
			}

			$data['leave_supervisor'] = $this->{$this->session->userdata('model')}->
				get_officer_name($data['one_leave_selected']['supervisor_id_leaves']);
			// print_r($data['leave_supervisor']); die();

	    	$data['display_one_leave'] = 'block';
	    }

	    if ($this->input->post('close-leave')) {
	    	$data['display_one_leave'] = 'None';
	    }

	    $this->load->library('form_validation');
		
		$this->form_validation->set_rules('leave-type', 'Text', 'required');
	    $this->form_validation->set_rules('proceeding-date', 'Date', 'required');

	    $this->load->view('templates/header', $data);
	    $this->load->view('templates/nav', $data);

	    if ($this->form_validation->run() === TRUE) {
	    	$leaveType = strip_tags($this->input->post('leave-type'));
	    	$leaveComment = strip_tags($this->input->post('reason-for-leave'));
	    	$proceedingDate = strip_tags($this->input->post('proceeding-date'));
	    	$data['supervisor'] = $this->{$model}->get_supervisor($data['id']);
	    	$this->{$model}->create_officer_leave($data['id'], $leaveType, $leaveComment,
	    		$proceedingDate, $data['supervisor']['officer_id']);
			redirect($this->session->userdata('home').'/leaves');
	    }

	    $this->load->view($this->session->userdata('home').'/leaves', $data);
	    $this->load->view('templates/footer');
	}
}	
	
?>