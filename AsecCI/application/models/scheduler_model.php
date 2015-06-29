<?php
require_once 'officer_model.php';
class Scheduler_Model extends Officer_Model {
	
	public function __construct() {
        $this->load->database();
		date_default_timezone_set('Africa/Lagos'); // Sets current timezone
    }
	
	// Get all locations
	public function get_locations() {
		return $this->db->get('location')->result_array();
	}
	
	// Gets all officers based on location and last shift
	public function get_officers($location, $shift) {
		// $shift = 'Night'; // For testing 
		$conditions = array(
			'location' => $location,
			'shift' => $shift
		);
		return $this->db->get_where('scheduling', $conditions)->result_array();
	}
}