<?php 
require 'cso_model.php';

class Admin_Model extends CSO_Model {

	public function get_success_applicants($applicantID = False) {
		if ($applicantID === False) {
			$conditions = array(
				'applicant_success' => '1',
				'applicant_added' => '0'
			);
			$this->db->order_by('date_of_application');
			$query = $this->db->get_where('application', $conditions);
			return $query->result_array();
		}
		$conditions = array(
			'applicant_id' => $applicantID,
			'applicant_success' => '1',
			'applicant_added' => '0'
		);
		$this->db->order_by('date_of_application');
		$query = $this->db->get_where('application', $conditions);
		return $query->row_array();
	}

	public function get_vacancy($vacancyID) {
		$query = $this->db->get_where('vacancy', array(
			'vacancy_id' => $vacancyID
		));
		return $query->row_array();
	}

	public function reset_officer_password($officerID) {
		$password = password_hash('pass', PASSWORD_DEFAULT);
		$data = array(
			'password' => $password
		);
		$this->db->update('security_officer', $data, "officer_id = '$officerID'");
	}
}
?>