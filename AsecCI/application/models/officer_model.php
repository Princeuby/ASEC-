<?php
class Officer_Model extends CI_Model {
	
	public function __construct() {
        $this->load->database();
		date_default_timezone_set('Africa/Lagos'); // Sets current timezone
    }
	
	// Gets single activity report
	public function get_activity_report($officerID, $current_day,
		 $shift, $reportID='%') {		
		$conditions = array( // Conditions to find the correct activity report
			'officer_id LIKE' => $officerID,
			'date_timeIn LIKE' => $current_day . '%', 
			'shift LIKE' => $shift,
			'report_id LIKE' => $reportID);
		// Current activity report
		$query = $this->db->get_where('activity_report', $conditions);
		return $query->row_array();
	}
	
	// Gets activity reports
	public function get_activity_reports($officerID, $current_day, $shift, $limit=6) {
		
		$conditions = array( // Conditions to find the correct activity report
			'officer_id' => $officerID,
			'date_timeIn LIKE' => $current_day . '%', 
			'shift LIKE' => $shift);
		$this->db->order_by('date_timeIn DESC');
		// Current activity report
		$this->db->limit($limit);
		$query = $this->db->get_where('activity_report', $conditions);
		return $query->result_array();
	}
	
	// Creates a new activity report
	public function create_activity_report($officerID, $previousOfficerID) {
		$current_day = date('Y-m-d'); // Current day
		$shift = $this->get_shift();
		$row = $this->get_activity_reports($officerID, $current_day, $shift);
		if (!empty($row)) // Restricts to one activity report per shift, per person
			return;
		$data = array( // Data for insert statement
			'officer_id' => $officerID,
			'date_timeIn' => date('Y-m-d H:i:s'),
			'shift' => $this->get_shift(),
			'previous_officer_id' => $previousOfficerID,
		);
		$this->db->insert('activity_report', $data);
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
	
	// Gets all the shifts allowed
	public function get_shifts() {
		return $this->db->query("SELECT DISTINCT(shift) FROM shifts")->result_array();
	}

	// Gets leave records for the officer
	public function get_officer_leaves($officerID) {
		$query = $this->db->query("SELECT * FROM 
			(SELECT security_officer.officer_id, leaves_id, leave_type, leave_comment, first_name, last_name, proceeding_date, returning_date, comments, approved_status
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

	//Checks if officer has already had an annual leave
	public function check_annual_leave($officerID) {
		$query = $this->db->query("SELECT * FROM leaves 
			WHERE officer_id = '$officerID' AND leave_type = 'annual' 
			AND approved_status = '1' 
			AND YEAR(proceeding_date) = YEAR(CURDATE())");
		return $query->num_rows();
	}

	//Creates a new Leave Request
	public function create_officer_leave($officerID, $leaveType, $leaveComment, $proceedingDate, $supervisorID) {
		$data = array( // Data for insert statement
			'leave_type' => $leaveType,
			'leave_comment' => $leaveComment,
			'officer_id' => $officerID,
			'proceeding_date' => $proceedingDate,
			'supervisor_id_leaves' => $supervisorID,
			'low_rank' => 1			
		);
		$this->db->insert('leaves', $data);
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
		// echo $incidentDetails; die();
		$data = array( // Data for insert statement
			'incident_type' => $incidentType,
			'incident_time' => date('Y-m-d H:i:s'),	
			'entry_report' => $incidentDetails,
			'report_id' => $reportID			
		);
		$this->db->insert('incident', $data);
	}
	
	// Closes an activity report by setting the 'time out' and 'next officer'
	public function close_activity_report($reportID, $nextOfficerID) {
		$data = array( // Data for update statement
			'next_officer_id' => $nextOfficerID,
			'date_timeOut' => date('Y-m-d H:i:s')	
		);
		$this->db->update('activity_report', $data, "report_id = $reportID");
	} 
	
	// Gets the schedule of the officer for a particular officer and week
	public function get_schedule($officerID, $weekStart, $approved=1) {
		$conditions = array(
			'officer_id' => $officerID,
			'week_start' => $weekStart
		);
		if ($approved === 1)
			$conditions['approved'] = 1;
		
		return $this->db->get_where('scheduling', $conditions)->row_array();
	}

	public function get_officer_leave($leaveID) {
		$query = $this->db->get_where('leaves', array('leaves_id' => $leaveID));
		return $query->row_array();
	}
}