<?php
require 'Officer.php';
class Scheduler extends Officer {
	
	public function set_data($page='Schedule') {
		$data = parent::set_data($page);
		$data['functions'] = ['Schedule', 'Created Schedules', 'Alter Schedule'];
		return $data;
	}
	
	public function index() {
		$data = $this->set_data();	
		$this->load->helper('form');
		$data['locations'] = $this->{$this->session->userdata('model')}->get_locations();
		$data['shifts'] = $this->{$this->session->userdata('model')}->get_shifts();
		$data['officers'] = [];
		$data['unavailable_officers'] = [];
		$data['schedule_officers'] = [];
		$data['display_s'] = "None";
		$data['display_l'] = "None";
		$data['disabled'] = '';
		$data['color_class'] = '';
		$data['status'] = '';
		// Rotating algorithm
		$shifts = ["Morning"=>"Afternoon", "Afternoon"=>"Night", "Night"=>"Morning"];
		$data['workdays'] = ['None', 'Sunday', 'Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday', 'Saturday'];
		
		// Sets officer's off days		
		if ($this->input->post('set-schedule')) {
			$off_days_1 = $this->input->post('off-day-1');
			$off_days_2 = $this->input->post('off-day-2');
			$officers = $this->{$this->session->userdata('model')}->get_officers_schedule(
				$this->session->userdata('location'), $this->session->userdata('last_shift'));
			for ($i = 0; $i < count($officers); $i++) {
				if ($officers[$i]['approved'] == 1) 
					break; // If the schedule has already been approved
				$off_days_1[$i] = intval($off_days_1[$i]) % count($data['workdays']); 
				$off_days_2[$i] = intval($off_days_2[$i]) % count($data['workdays']); 
				$this->{$this->session->userdata('model')}->update_officer_schedule($officers[$i]['officer_id'],
					$data['workdays'][$off_days_1[$i]], $data['workdays'][$off_days_2[$i]]);
			}
		}
		
		// Checks if the form was submitted or the session variables were set
		$getSchedule = false; 
		if ($this->input->post('get-schedule')) {
			$data['selected_location'] = $this->input->post('location');
			$data['selected_shift'] = $this->input->post('shift');
			$data['last_shift'] = $shifts[$data['selected_shift']];
			$getSchedule = true; 
		}
		else if ($this->session->userdata('location') && $this->session->userdata('last_shift')) {
			$data['selected_location'] = $this->session->userdata('location');
			$data['selected_shift'] = $this->session->userdata('selected_shift');
			$data['last_shift'] = $this->session->userdata('last_shift');
			$getSchedule = true;
		}
		
		if ($getSchedule) {	
			// Session variables for some sort of security
			$this->session->set_userdata('location', $data['selected_location']);
			$this->session->set_userdata('last_shift', $data['last_shift']);
			$this->session->set_userdata('selected_shift', $data['selected_shift']);
			
			$data['officers'] = $this->{$this->session->userdata('model')}->get_officers($data['selected_location'],
			 	$data['last_shift']);
			
			$weekStart = date('Y-m-d', strtotime("this Sunday"));			
			$weekEnd = date('Y-m-d', strtotime($weekStart." + 1 week - 1 day"));
			$num_officers = count($data['officers']); // To prevent everything from breaking
			if (!(empty($data['officers']))) {
				for ($i = 0; $i < $num_officers; $i++) {
					$officerID = $data['officers'][$i]['officer_id'];
					$data['officers'][$i]['officer_name'] = $this->{$this->session->userdata('model')}->get_officer_name(
						$officerID);
					$leaveStatus = $this->{$this->session->userdata('model')}->get_leave_status($officerID);
					$leaves = $this->{$this->session->userdata('model')}->get_officer_leaves($officerID);
					if ($leaveStatus['leave_status'] == 0) {
						for ($j = 0; $j < count($leaves); $j++) {
							// Checks if the officer should be marked as being on leave or as returned
							if ($this->isNotAvailable($leaves[$j], $weekStart, $weekEnd)) {
								$this->{$this->session->userdata('model')}->set_leave_status($officerID, 1);
								$data['officers'][$i]['returning_date'] = $leaves[$j]['returning_date'];
								$data['unavailable_officers'][] = $data['officers'][$i];
								$this->{$this->session->userdata('model')}->delete_officer_schedule($officerID, $data['selected_location'],
									 $data['selected_shift'], $weekStart);
								unset($data['officers'][$i]);
								break;
							}
						}
					}					
					else { 
						for ($j = 0; $j < count($leaves); $j++) {
							// Checks if the officer should be marked as being on leave or as returned
							$available = $this->isNotAvailable($leaves[$j], $weekStart, $weekEnd);
							if ($available) {
								$returningDate = $leaves[$j]['returning_date'];
								break;
							 }
						}		
						
						if (!$available) 
							$this->{$this->session->userdata('model')}->set_leave_status($officerID, 0);	
						else {
							$this->{$this->session->userdata('model')}->set_leave_status($officerID, 1);
							$data['officers'][$i]['returning_date'] = $returningDate;
							$data['unavailable_officers'][] = $data['officers'][$i];
							$this->{$this->session->userdata('model')}->delete_officer_schedule($officerID, $data['selected_location'],
								 $data['selected_shift'], $weekStart);
							unset($data['officers'][$i]);
							break;
						}
					}
				}
			} 
			// For the officer schedule... It's confusing
			$data['schedule_officers'] = $this->{$this->session->userdata('model')}->get_officers_schedule($data['selected_location'],
					 $data['last_shift']);
					 
			if (count($data['schedule_officers']) < count($data['officers'])) {
				foreach ($data['officers'] as $officer) {
					$officerID = $officer['officer_id'];
					echo $officerID ."<br>"; 
					$leaveStatus = $this->{$this->session->userdata('model')}->get_leave_status($officerID);
					if (empty($this->{$this->session->userdata('model')}->get_schedule($officerID, $weekStart, 0)))
						$this->{$this->session->userdata('model')}->create_officer_schedule($officerID, $data['selected_location'],
							 $data['selected_shift'], $weekStart);
				}
				$data['schedule_officers'] = $this->{$this->session->userdata('model')}->get_officers_schedule($data['selected_location'],
					 $data['last_shift']);
			}
			
			// Set the status and disabled property of the set schedule form
			if (!empty($data['schedule_officers'])) {
				$status = $this->{$this->session->userdata('model')}->get_schedule_status(
					$data['selected_location'], $data['selected_shift']);
				if ($status['approved'] === null) {
					$data['color_class'] = 'blue-text';
					$data['status'] = 'Pending';
				}
				else if ($status['approved'] == 0) {
					$data['status'] = 'Not Approved';
					$data['color_class'] = 'red-text';
				}
				else if ($status['approved'] == 1) {
					$data['disabled'] = 'disabled';
					$data['status'] = 'Approved';
					$data['color_class'] = 'green-text';
				}
			}
			
			// Gives the officers names
			for($k = 0; $k < count($data['schedule_officers']); $k++)
				$data['schedule_officers'][$k]['officer_name'] = $this->{$this->session->userdata('model')}->get_officer_name(
						$data['schedule_officers'][$k]['officer_id']);
		}
		
		$data['display_s'] = (empty($data['officers'])) ? $data['display_s'] : "";
		$data['display_l'] = (empty($data['unavailable_officers'])) ? $data['display_l'] : "";
		
		$this->load->view('templates/header', $data);
	    $this->load->view('templates/nav');
	    $this->load->view($this->session->userdata('home').'/index');
	    $this->load->view('templates/footer');
	}
	
	public function schedule() {
		redirect($this->session->userdata('home'));
	}
	
	// Shows the schedule
	public function show_schedule() {
		$data = $this->set_data();
		$data['location'] = $this->session->userdata('location');
		$data['selected_shift'] = $this->session->userdata('selected_shift');

		$officers = $this->{$this->session->userdata('model')}->get_officers_schedule(
				$data['location'], $this->session->userdata('last_shift'));
		$data['days'] = $this->get_working_days($officers);
		
		$this->load->view('templates/header', $data);
	    $this->load->view('templates/nav');
	    $this->load->view($this->session->userdata('home').'/schedule');
	    $this->load->view('templates/footer');
	}
	
	public function created_schedules() {
		$data = $this->set_data('Created Schedules');
		$this->load->helper('form');		
		$data['not_approved'] = $this->{$this->session->userdata('model')}->get_schedules(0);
		$data['approved'] = $this->{$this->session->userdata('model')}->get_schedules(1);
		$data['pending'] = $this->{$this->session->userdata('model')}->get_schedules();
		
		// For showing or hiding the tables
		$data['display_n'] = '';
		$data['display_a'] = '';
		$data['display_p'] = '';
		
		if (empty($data['not_approved']))
			$data['display_n'] = 'None';
		if (empty($data['approved']))
			$data['display_a'] = 'None';
		if (empty($data['pending']))
			$data['display_p'] = 'None';
			
		$clicked = false;
		if ($this->input->post('fix-schedule')) {
			list($location, $shift) = explode('.', $this->input->post('fix-schedule'));			
			$redirect = $this->session->userdata('home');
			$clicked = true;
		} 
		
		else if ($this->input->post('show-schedule')) {
			list($location, $shift) = explode('.', $this->input->post('show-schedule'));
			$redirect = $this->session->userdata('home').'/show_schedule';
			$clicked = true;			
		}
		
		if ($clicked) {
			$shifts = ["Morning"=>"Afternoon", "Afternoon"=>"Night", "Night"=>"Morning"];
			$this->session->set_userdata('location', $location);
			$this->session->set_userdata('selected_shift', $shift);
			$this->session->set_userdata('last_shift',$shifts[$shift]);
			
			redirect($redirect);
		}
			
		$this->load->view('templates/header', $data);
	    $this->load->view('templates/nav');
	    $this->load->view($this->session->userdata('home').'/created_schedules');
	    $this->load->view('templates/footer');
	}
	
	// Checks if an officer is available
	protected function isNotAvailable($leave, $weekStart, $weekEnd) {
		return ($leave['approved_status'] == 1 &&
			   ((strtotime($weekEnd) >= strtotime($leave['proceeding_date']) &&
				 strtotime($leave['proceeding_date']) >= strtotime($weekStart)) ||
			    (strtotime($weekEnd) >= strtotime($leave['returning_date']) && 
			     strtotime($leave['returning_date']) >= strtotime($weekStart))  ||
				(strtotime($leave['returning_date']) >= strtotime($weekEnd) && 
			     strtotime($leave['proceeding_date']) <= strtotime($weekStart))));
	}	
}