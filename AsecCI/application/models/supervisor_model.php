<?php
require_once 'officer_model.php';
class Supervisor_Model extends Officer_Model {

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

	public function get_officer_leaves($officerID) {
		parent::get_officer_leaves();
	}

	public function create_officer_leaves($officerID, $leaveType, $proceedingDate, $supervisorID) {
		$data = array( // Data for insert statement
			'leave_type' => $leaveType,
			'officer_id' => $officerID,
			'proceeding_date' => $proceedingDate,
			'supervisor_id_leaves' => $supervisorID,
			'low_rank' => 0			
		);
		$query = $this->db->insert('leaves', $data);
	}

	public function get_supervisor($officerID) {
		parent::get_supervisor();
	}
}
?>