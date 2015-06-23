<?php
class Officer_Model extends CI_Model {
	
	public function __construct() {
        $this->load->database();
		date_default_timezone_set('Africa/Lagos'); // Sets current timezone
    }
	
	// Gets the most recent activity report
	public function get_activity_report($officerID) {
		$current_day = date('Y-m-d'); // Current day
		$shift = $this->get_shift();
		$conditions = array( // Conditions to find the correct activity report
			'officer_id' => $officerID,
			'date_timeIn LIKE' => $current_day . '%', 
			'shift' => $shift);
		// Current activity report
		$query = $this->db->get_where('activity_report', $conditions);
		return $query->row_array();
	}
	
	// Creates a new activity report
	public function create_activity_report($officerID, $previousOfficerID) {
		$data = array( // Data for insert statement
			'report_id' => null,
			'officer_id' => $officerID,
			'date_timeIn' => date('Y-m-d H:i:s'),
			'date_timeOut' => null,
			'shift' => $this->get_shift(),
			'previous_officer_id' => $previousOfficerID,
			'next_officer_id' => null			
		);
		$query = $this->db->insert('activity_report', $data);
	}
	
	// Gets the current shift based on time
	public function get_shift() {
		$current_time = date('H:i:s'); // Current time
		$query = $this->db->get_where('shifts', array('start_time <' => $current_time, 
			'end_time > ' => $current_time)); // Current shift
		return $query->row_array()['shift'];
	}

	// Gets leave records for the officer
	public function get_officer_leaves($officerID) {
		$query = $this->db->query("SELECT * FROM 
			(SELECT security_officer.officer_id, leaves_id, leave_type, first_name, last_name, proceeding_date, returning_date, comments, approved_status
			 FROM security_officer, leaves 
			WHERE security_officer.officer_id = leaves.officer_id
			ORDER BY proceeding_date DESC, returning_date DESC) s1

			INNER JOIN

			(SELECT officer_id, first_name, last_name, dept_name, designation 
			FROM security_officer 
			WHERE designation = Supervisor AND dept_name IN 
				(SELECT dept_name FROM security_officer WHERE officer_id = $officerID)) s2

			ON s1.officer_id = $officerID"
			);
		return $query->row_array();
	}

	//Creates a new Leave Request
	public function create_officer_leave($officerID, $leaveType, $proceedingDate, $supervisorID) {
		$data = array( // Data for insert statement
			'leave_type' => $leaveType,
			'officer_id' => $officerID,
			'proceeding_date' => $proceedingDate,
			'supervisor_id_leaves' => $supervisorID,			
		);
		$query = $this->db->insert('leaves', $data);
	}
}