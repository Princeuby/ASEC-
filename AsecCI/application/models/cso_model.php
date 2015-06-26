<?php
require_once 'supervisor_model.php';
class CSO_Model extends Supervisor_Model {

	public function __construct() {
		parent::__construct();
	}

	public function get_activity_report($officerID) {
		parent::get_activity_report();
	}

	public function create_activiy_report($officerID, $previousOfficerID) {
		parent::create_activity_report();
	}

	public function get_shift() {
		parent::get_shift();
	}

	public function get_supervisor($officerID) {
		parent::get_supervisor();
	}

	public function get_officer_details($officerID) {
		$query = $this->db->get_where('security_officer', 
			array('officer_id' => $officerID))->row_array();
		return $query->row_array();
	}

	public function get_leave_record($leavesID) {
		$query = $this->db->get_where('leaves', array('leaves_id' => $leavesID));
		return $query->row_array();
	}

	public function get_all_leave_requests() {
		$query = $this->db->query("SELECT first_name, last_name, rank, dept_name,
			leaves_id, leave_type, proceeding_date, entitled_days, recommendation
		FROM security_officer, leaves
		WHERE security_officer.officer_id = leaves.officer_id AND approved_status IS NULL 
		AND (low_rank ='0' OR recommendation IS NOT NULL) 
		ORDER BY proceeding_date DESC"
		);
		return $query->result_array();
	}

	public function set_approval_status($leavesID, $proceedingDate, $entitledDays, $approvedStatus, $comments) {
		$daysToAdd = $entitledDays . " Days";
		$returningDate = date_add(date_create($proceedingDate), date_interval_create_from_date_string($daysToAdd));
		$returningDate = date_format($returningDate,"Y-m-d");
		$data = array(//Data for update statement
			'entitled_days' => $entitledDays,
			'returning_date' => $returningDate,
			'approved_status' => $approvedStatus,
			'approved_date' => date('Y-m-d'),
			'comments' => $comments
		);
		$this->db->update('leaves', $data, "leaves_id = $leaveID");
	}
}
?>