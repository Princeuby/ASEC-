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
		$row = $this->get_activity_report($officerID);
		if (!empty($row)) // Restricts to one activity report per shift, per person
			return;
		$data = array( // Data for insert statement
			'report_id' => null, // Autoincrement column
			'officer_id' => $officerID,
			'date_timeIn' => date('Y-m-d H:i:s'),
			'date_timeOut' => null,
			'shift' => $this->get_shift(),
			'previous_officer_id' => $previousOfficerID,
			'next_officer_id' => null			
		);
		$query = $this->db->insert('activity_report', $data);
	}
	
	// Gets record of previous officer from security_officer table
	public function get_officer_name($officerID) {
		$query = $this->db->get_where('security_officer', 
			array('officer_id' => $officerID))->row_array();
		// Name of officer
		return $query['first_name'] . " " . $query['last_name'];
	}
	
	// Gets the current shift based on time
	public function get_shift() {
		$current_time = date('H:i:s'); // Current time
		$query = $this->db->get_where('shifts', array('start_time <' => $current_time, 
			'end_time > ' => $current_time)); // Current shift
		return $query->row_array()['shift'];
	}
	
	// Gets the incidents recorded in a report
	public function get_incidents($reportID) {
		$query = $this->db->get_where('incident', array('report_id' => $reportID));
		return $query->result_array();
	}
	
	// Creates new incidents in a report
	public function create_incidents($reportID, $incidentType, $incidentDetails) {
		$data = array( // Data for insert statement
			'incident_id' => null, // Autoincrement column
			'incident_type' => $incidentType,
			'entry_report' => $incidentDetails,
			'report_id' => $reportID			
		);
		$query = $this->db->insert('incident', $data);
	}
}