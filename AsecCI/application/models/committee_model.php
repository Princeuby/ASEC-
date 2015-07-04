<?php
require_once 'officer_model.php';
class Committee_Model extends Officer_Model {

	public function get_active_vacancies($vacancyID = FALSE) {
		if ($vacancyID === FALSE) {
			$query = $this->db->get_where('vacancy', array(
			'vacancy_status' => '1'));

			return $query->result_array();
		}
		$query = $this->db->get_where('vacancy', array(
			'vacancy_id' => $vacancyID,
			'vacancy_status' => '1'));

		return $query->row_array();
	}

	public function close_active_vacancy($vacancyID) {
		$data = array( // Data for update statement
			'vacancy_status' => '0'
		);
		$this->db->update('vacancy', $data, "vacancy_id = $vacancyID");
	}

	public function count_active_applicants($vacancyID) {
			$query = $this->db->get_where('application', array(
			'vacancy_id' => $vacancyID,
			'application_status' => '1'));

			return $query->num_rows();
	}

	public function get_applicants_review($vacancyID) {
		$interviewStatus = null;
		$conditions = array(
			'vacancy_id' => $vacancyID,
			'application_status' => '1',
			'interview_status' => $interviewStatus
		);
		if ($interviewStatus === null) {
			unset($conditions['interview_status']);
			$conditions['interview_status IS null'] = null;
		}
		$this->db->order_by('date_of_application');
		return $this->db->get_where('application', $conditions)->result_array();
	}

	public function get_vacancy_position($vacancyID) {
		$query = $this->db->get_where('vacancy', array(
			'vacancy_id' => $vacancyID));
		// print_r($query->row_array()); die();
		return $query->row_array();
	}

	public function get_applicant($applicantID) {
		$query = $this->db->get_where('application', array(
			'applicant_id' => $applicantID));

		return $query->row_array();
	}

	public function set_applicant_interview($applicantID, $interviewStatus, $interviewDate, $interviewLocation) {
		if ($interviewStatus === '1') {
			$data = array( // Data for update statement
			'interview_status' => $interviewStatus,
			'interview_date' => $interviewDate,
			'interview_location' => $interviewLocation
			);
			$this->db->update('application', $data, "applicant_id = $applicantID");
		}
		else {
			$data = array( // Data for update statement
			'interview_status' => $interviewStatus,
			'application_status' => '0'
			);
			$this->db->update('application', $data, "applicant_id = $applicantID");
		}
	}

	public function get_applicants_interview($vacancyID) {

	}

	public function set_applicant_training($applicantID, $trainingStatus, $trainingDate, $trainingLocation) {
		if ($trainingStatus === '1') {
			$data = array( // Data for update statement
			'training_status' => $trainingStatus,
			'training_date' => $interviewDate,
			'training_location' => $trainingLocation
			);
			$this->db->update('application', $data, "applicant_id = $applicantID");
		}
		else {
			$data = array( // Data for update statement
			'training_status' => $trainingStatus,
			'application_status' => '0'
			);
			$this->db->update('application', $data, "applicant_id = $applicantID");
		}
	}
}
?>