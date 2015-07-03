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
	public function get_officers_schedule($location, $shift) {
		$weekStart = date('Y-m-d', strtotime('this Sunday'));
		return $this->db->query("SELECT * FROM scheduling WHERE 
			officer_id in (SELECT officer_id FROM officer_locations
			 WHERE officer_location='$location' AND last_shift='$shift') 
			 AND week_start = '$weekStart'")->result_array();
	}
	
	// Gets all the schedules
	public function get_schedules($approved=null) {
		$conditions = array(
			'week_start' => date('Y-m-d', strtotime("this Sunday")),
			'approved' => $approved
		);
		if ($approved === null) {
			unset($conditions['approved']);
			$conditions['approved IS null'] = null;
		}
		// print_r($conditions);
		$this->db->group_by(array('location', 'shift'));
		return $this->db->get_where('scheduling', $conditions)->result_array();
	}
	
	// Gets all officers based on location and last shift
	public function get_officers($location, $shift) {
		$conditions = array(
			'officer_location' => $location,
			'last_shift' => $shift
		);
		return $this->db->get_where('officer_locations', $conditions)->result_array();
	}
	
	// Creates an based on location and last shift
	public function create_officer_schedule($officerID, $location, $shift, $weekStart) {
		$data = array(
			'officer_id' => $officerID,
			'location' => $location,
			'shift' => $shift,
			'week_start' => $weekStart
		);
		$this->db->insert('scheduling', $data);
	}
	
	// Updates an officer's schedule
	public function update_officer_schedule($officerID, $offDay1, $offDay2) {
		$data = array(
			'off_day_1' => $offDay1,
			'off_day_2' => $offDay2
		);
		$this->db->update('scheduling', $data, "officer_id = '$officerID'");
	}
	
	// Deletes an based on location and last shift
	public function delete_officer_schedule($officerID, $location, $shift, $weekStart) {
		$data = array(
			'officer_id' => $officerID,
			'location' => $location,
			'shift' => $shift,
			'week_start' => $weekStart
		);
		$this->db->delete('scheduling', $data);
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