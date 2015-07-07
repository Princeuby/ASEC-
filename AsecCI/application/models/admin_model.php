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

	public function create_officer($officerID, $dateOfEmp, $dateOfBirth, $firstName, 
		$middleName, $lastName, $gender, $rank, $department, $applicantID) {

		$password = password_hash('pass', PASSWORD_DEFAULT);
		$designation = $rank;

		$designation_list = array('Supervisor', 'CSO', 'ACSO', 'Scheduler', 'Committee', 'AVP', 'Admin', 'Senior Supervisor');
		if (!in_array($designation, $designation_list)  ) {
			$designation = "Rank and File";
		}

		$data = array( // Data for insert statement
			'officer_id' => $officerID,
			'date_of_emp' => $dateOfEmp,
			'date_of_birth' => $dateOfBirth,
			'first_name' => $firstName,
			'middle_name' => $middleName,
			'last_name' => $lastName,
			'gender' => $gender,
			'rank' => $rank,
			'dept_name' => $department,
			'designation' => $designation,
			'leave_status' => '0',
			'officer_status' => '1',
			'password' => $password			
		);
		
		$this->db->update('application', array('applicant_added' => '1'), "applicant_id = '$applicantID'");
		$this->db->insert('security_officer', $data);
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