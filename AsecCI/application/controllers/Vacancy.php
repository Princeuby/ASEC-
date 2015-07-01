<?php
class Vacancy extends CI_Controller {

	public function __construct() {
		parent::__construct();
		$this->load->model('vacancy_model');
	}

	public function index() {
		$data = $this->set_data();
		$data['vacancies'] = $this->vacancy_model->get_vacancies();
		$data['no_vacancy'] = '';

		if (empty($data['vacancies'])) {
			$data['no_vacancy'] = "There is currently no open vacancy";
		}

		$this->load->view('templates/header', $data);
	    $this->load->view('templates/nav', $data);
	    $this->load->view('vacancy/index');
	    $this->load->view('templates/footer');
	}

	public function set_data() {
		$data['title'] = ucwords('Vacancy');
		$data['page'] = 'Vacancy';
		$data['name'] = "Applicant";
		$data['rank'] = '';
		$data['functions'] = ['vacancy'];
		return $data;
	}

	public function vacancy() {
		redirect('vacancy');
	}
}
?>