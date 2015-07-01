<?php
class Vacancy_Model extends CI_Model {

	public function __construct() {
		$this->load->database();
		date_default_timezone_set('Africa/Lagos'); // Sets current timezone
	}

	//Gets all the available vacancies
	public function get_vacancies($vacancyID = FALSE) {
		if ($vacancyID === FALSE) {
			$query = $this->db->get_where('vacancy', array(
				'opening_date <=' => date('Y-m-d'),
				'closing_date >=' => date('Y-m-d')));
			return $query->result_array();
		}
		$query = $this->db->get_where('vacancy', array(
			'vacancy_id' => $vacancyID,
			'opening_date <=' => date('Y-m-d'),
			'closing_date >=' => date('Y-m-d')));
		// print_r($query->row_array()); die();
		return $query->row_array();
	}
}
?>