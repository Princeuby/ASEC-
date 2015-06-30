<?php
require_once 'officer_model.php';
class Scheduler_Model extends Officer_Model {
	
	public function __construct() {
        $this->load->database();
		date_default_timezone_set('Africa/Lagos'); // Sets current timezone
    }
	
	// Get all locations
	public function get_locations() {
		return $this->db->get('locations')->result_array();
	}
	
	// Gets all officers based on location and last shift
	public function get_officers($location, $shift) {
		return $this->db->query("SELECT * FROM scheduling WHERE shift='$shift' 
			AND officer_id in (SELECT officer_id FROM officer_locations
			 WHERE officer_location='$location')")->result_array();
	}
	
	// Updates the leave status
	public function set_leave_status($officerID, $status) {
		$data = array('leave_status' => $status);
		$this->db->update('security_officer', $data, "officer_id = '$officerID'");
	}
	
	// Gets the officer's leave status
	public function get_leave_status($officerID) {
		$this->db->select('leave_status');
		$data = array('officer_id' => $officerID);
		return $this->db->get_where('security_officer', $data)->row_array();
	}
	
	// Gets the officer's most recent leave
	public function get_most_recent_leave($officerID) {
		$this->db->order_by('returning_date DESC');
		$data = array(
			'officer_id' => $officerID,
			'approved_status' => 1);
		return $this->db->get_where('leaves', $data)->row_array();
	}
}