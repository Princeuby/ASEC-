<?php
require_once 'Supervisor.php';
class Other_Model extends Supervisor_Model {

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


	//Adds supervisor recommendation for leave
	public function set_recommendation($leaveID, $entitledDays, $recommendation) {
		$data = array( // Data for update statement
			'leaves_id' => $leaveID,
			'entitled_days' => $entitledDays,
			'recommendation' => $recommendation
		);
		$this->db->update('leaves', $data, "leaves_id = $leaveID");
	}
}
?>