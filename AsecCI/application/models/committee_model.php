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
}
?>