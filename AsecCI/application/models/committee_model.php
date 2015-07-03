<?php
require_once 'officer_model.php';
class Committee_Model extends Officer_Model {

	public function get_active_vacancies() {
		$query = $this->db->get_where('vacancy', array(
			'vacancy_status' => '1'));

		return $query->result_array();
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
		if ($interviewStatus = null) {
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
}
?>