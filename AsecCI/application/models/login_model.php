<?php
class Login_model extends CI_Model {

    public function __construct() {
        $this->load->database();
    }

    public function get_officer($officerID) {
        $query = $this->db->get_where('security_officer', array(
        	'officer_id' => $officerID,
        	'officer_status' => '1'));
        return $query->row_array();
    }
}
?>