<?php
require_once 'officer_model.php';
class Supervisor_Model extends Officer_Model {
	public function get_officer_leaves($officerID) {
		$query = $this->db->query("SELECT security_officer.officer_id, leaves_id, leave_type, leave_comment, 
			first_name, last_name, proceeding_date, returning_date, comments, approved_status
			FROM security_officer, leaves 
			WHERE security_officer.officer_id = leaves.officer_id AND security_officer.officer_id = '$officerID'
			ORDER BY proceeding_date DESC, returning_date DESC
			");
		return $query->result_array();
	}

	public function create_officer_leave($officerID, $leaveType, $leaveComment, $proceedingDate, $supervisorID) {
		$data = array( // Data for insert statement
			'leave_type' => $leaveType,
			'officer_id' => $officerID,
			'leave_comment' => $leaveComment,
			'proceeding_date' => $proceedingDate,
			'supervisor_id_leaves' => $supervisorID,
			'low_rank' => 0			
		);
		$query = $this->db->insert('leaves', $data);
	}

	//Gets all pending leave requests
	public function get_leave_requests($officerID) {
		$query = $this->db->query("SELECT first_name, last_name, rank, leaves_id, leave_type, 
			leave_comment, proceeding_date, recommendation
			FROM security_officer, leaves
			WHERE security_officer.officer_id = leaves.officer_id AND supervisor_id_leaves = '$officerID' 
			AND recommendation IS NULL AND low_rank = '1' AND approved_status IS NULL
			ORDER BY proceeding_date;"
		);
		return $query->result_array();
	}

	//Get information of an officer
	public function get_officer_details($officerID) {
		$query = $this->db->get_where('security_officer', 
			array('officer_id' => $officerID));
		return $query->row_array();
	}

	public function get_leave_record($leavesID) {
		$query = $this->db->get_where('leaves', array('leaves_id' => $leavesID));
		return $query->row_array();
	}
	
	//Adds supervisor recommendation for leave
	public function set_recommendation($leaveID, $entitledDays, $recommendation) {
		$data = array( // Data for update statement
			'leaves_id' => $leaveID,
			'entitled_days' => $entitledDays,
			'recommendation' => $recommendation
		);
		$this->db->update('leaves', $data, "leaves_id = $leaveID");
	}
	
	// Gets activity reports
	public function get_activity_reports($supervisorID, $current_day, $shift, $limit=6) {
		$query = $this->db->query("SELECT * FROM activity_report 
			WHERE date_timeIn LIKE '$current_day%' AND shift LIKE '$shift' AND officer_id IN (
			SELECT officer_id FROM security_officer WHERE dept_name IN
		 (SELECT dept_name FROM security_officer WHERE officer_id='$supervisorID')) 
		 ORDER BY date_timeIn DESC LIMIT 0, $limit");
		return $query->result_array();
	}
}
?>