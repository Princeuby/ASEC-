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
			'officer_id' => $officerID,
			'date_timeIn' => date('Y-m-d H:i:s'),
			'shift' => $this->get_shift(),
			'previous_officer_id' => $previousOfficerID,
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

	// Gets leave records for the officer
	public function get_officer_leaves($officerID) {
		$query = $this->db->query("SELECT * FROM 
			(SELECT security_officer.officer_id, leaves_id, leave_type, first_name, last_name, proceeding_date, returning_date, comments, approved_status
			 FROM security_officer, leaves 
			WHERE security_officer.officer_id = leaves.officer_id) s1
			
			INNER JOIN

			(SELECT officer_id, first_name, last_name, dept_name, designation 
			FROM security_officer 
			WHERE designation = 'Supervisor' AND dept_name IN 
				(SELECT dept_name FROM security_officer WHERE officer_id = '$officerID')) s2

			ON s1.officer_id = '$officerID'
			ORDER BY s1.proceeding_date DESC, s1.returning_date DESC"
			);
		return $query->result_array();
	}

	//Creates a new Leave Request
	public function create_officer_leave($officerID, $leaveType, $proceedingDate, $supervisorID) {
		$data = array( // Data for insert statement
			'leave_type' => $leaveType,
			'officer_id' => $officerID,
			'proceeding_date' => $proceedingDate,
			'supervisor_id_leaves' => $supervisorID,
			'low_rank' => 1			
		);
		$query = $this->db->insert('leaves', $data);
	}

	public function get_supervisor($officerID) {
		$query = $this->db->query("SELECT officer_id
			FROM security_officer
			WHERE designation = 'Supervisor' AND dept_name IN
				(SELECT dept_name FROM security_officer WHERE officer_id = '$officerID')");
		return $query->row_array();
	}
	
	// Gets the incidents recorded in a report
	public function get_incidents($reportID) {
		$query = $this->db->get_where('incident', array('report_id' => $reportID));
		return $query->result_array();
	}
	
	// Creates new incidents in a report
	public function create_incidents($reportID, $incidentType, $incidentDetails) {
		$data = array( // Data for insert statement
			'incident_type' => $incidentType,
			'incident_time' => date('Y-m-d H:i:s'),	
			'entry_report' => $incidentDetails,
			'report_id' => $reportID			
		);
		$query = $this->db->insert('incident', $data);
	}
	
	// Closes an activity report by setting the 'time out' and 'next officer'
	public function close_activity_report($reportID, $nextOfficerID) {
		$data = array( // Data for insert statement
			'next_officer_id' => $nextOfficerID,
			'date_timeOut' => date('Y-m-d H:i:s')	
		);
		$query = $this->db->update('activity_report', $data, "report_id = $reportID");
	} 
>>>>>>> origin/pseudo_master
}