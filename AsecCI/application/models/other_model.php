<?php
require_once 'supervisor_model.php';

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

	public function create_officer_leave($officerID, $leaveType, $proceedingDate, $supervisorID) {
		parent::create_officer_leave;
	}

}
?>