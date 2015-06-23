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
		$report = $query->row_array();
		// Gets record of previous officer from security_officer table
		$prev = $query = $this->db->get_where('security_officer', 
			array('officer_id' => $report['previous_officer_id']))->row_array();
		// Name of previous officer
		$report['previous_officer_name'] = $prev['first_name'] . " " . $prev['last_name'];  
		return $report;
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
}