<?php
require_once 'Officer.php';

class Committee extends Officer {

	protected function set_data($page='Home') { // sets the data variables to avoid repition
		$data = parent::set_data($page);
		$data['functions'] = ['home', 'applicants review', 'scheduled interview', 'scheduled training'];
		return $data;
	}

	public function index() {
		$this->load->helper('form');
		$data = $this->set_data();
		$data['active_vacancies'] = $this->{$this->session->userdata('model')}
			->get_active_vacancies();
		
		for ($i = 0; $i < count($data['active_vacancies']); $i++) {
			$data['active_vacancies'][$i]['applicant_count'] = 
			$this->{$this->session->userdata('model')}->count_active_applicants
			($data['active_vacancies'][$i]['vacancy_id']);
		}


		$data['none_active'] = '';

		if (empty($data['active_vacancies'])) {
			$data['none_active'] = "There is currently no active vacancy";
		}

		$this->load->view('templates/header', $data);
	    $this->load->view('templates/nav', $data);
	    $this->load->view($this->session->userdata('home').'/index');
	    $this->load->view('templates/footer');
	} 
}
?>