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

	public function create_application($vacancy_id, $first_name, 
				$middle_name, $last_name, $phone_number, $email, $application_letter,
				$curriculum_vitae) {

		$data = array( // Data for insert statement
			'date_of_application' => date('Y-m-d H:i:s'),
			'first_name' => $first_name,
			'middle_name' => $middle_name,
			'last_name' => $last_name,
			'phone_number' => $phone_number,
			'email_address' => $email,
			'application_letter' => $application_letter,
			'curriculum_vitae' => $curriculum_vitae,
			'vacancy_id' => $vacancy_id,
			'application_status' => '1',
			'applicant_added' => '0'			
		);
		$this->db->insert('application', $data);
	}
}
?>