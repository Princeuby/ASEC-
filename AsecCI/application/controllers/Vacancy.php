<?php
class Vacancy extends CI_Controller {

	public function __construct() {
		parent::__construct();
		$this->load->model('vacancy_model');
		$this->load->library('session');
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

	public function index() {
		$this->load->helper('form');
		$data = $this->set_data();
		$data['vacancies'] = $this->vacancy_model->get_vacancies();
		$data['no_vacancy'] = '';

		if (empty($data['vacancies'])) {
			$data['no_vacancy'] = "There is currently no open vacancy";
		}

		if ($this->input->post('viewVac')) {
			$this->session->set_userdata('application_vacancy_id', $this->input->post('viewVac'));

			redirect('vacancy/view_vacancy');
		}

		$this->load->view('templates/header', $data);
	    $this->load->view('templates/nav', $data);
	    $this->load->view('vacancy/index');
	    $this->load->view('templates/footer');
	}

	public function view_vacancy() {
		$data = $this->set_data();
		$this->load->helper('form');
		$data['selected_vacancy'] = '';

		if ($this->session->userdata('application_vacancy_id')) {
			$data['selected_vacancy'] = $this->vacancy_model->
				get_vacancies($this->session->userdata('application_vacancy_id'));
			
			$this->session->set_userdata('application_position', $data['selected_vacancy']['position']);
		}
		else {
			redirect('vacancy');
		}

		$this->load->view('templates/header', $data);
	    $this->load->view('templates/nav');
	    $this->load->view('vacancy/view_vacancy');
	    $this->load->view('templates/footer');
	}

	public function applicants() {
		$data = $this->set_data();
		$this->load->helper('form');
		
		$data['position'] = $this->session->userdata('application_position');

		if($this->session->userdata('application_vacancy_id')) {
			$data['vacancyID'] = $this->session->userdata('application_vacancy_id');
			
		}
		else {
			redirect('vacancy');
		}
		
		$this->load->view('templates/header', $data);
	    $this->load->view('templates/nav');
	    $this->load->view('vacancy/applicants');
	    $this->load->view('templates/footer');
	}

	public function add_application() {
		$this->load->helper('form');
	    $this->load->library('form_validation');

	    $this->form_validation->set_rules('applicant-firstName', 'Text', 'required');
		$this->form_validation->set_rules('applicant-lastName', 'Text', 'required');
		$this->form_validation->set_rules('applicant-phoneNumber', 'Text', 'required');
		$this->form_validation->set_rules('applicant-email', 'Text', 'required');
		$this->form_validation->set_rules('applicant-applicationLetter', 'file', 'required');
		$this->form_validation->set_rules('applicant-curriculumVitae', 'file', 'required');

		if ($this->form_validation->run() === TRUE) {
			$first_name = strip_tags($this->input->post('applicant-firstName'));
			$middle_name = strip_tags($this->input->post('applicant-middleName'));
			$last_name = strip_tags($this->input->post('applicant-lastName'));
			$phone_number = strip_tags($this->input->post('applicant-phoneNumber'));
			$email = strip_tags($this->input->post('applicant-email'));
			$application_letter = $this->input->post('applicant-applicationLetter');
			$curriculum_vitae = $this->input->post('applicant-curriculumVitae');

			$this->vacancy_model->create_application($this->session->userdata('application_vacancy_id'), $first_name, 
				$middle_name, $last_name, $phone_number, $email, $application_letter,
				$curriculum_vitae);
				
			redirect('vacancy');
		}
		else {
			$this->session->set_flashdata('failed_create', "Failed to create application, please try again!");
		}
		redirect('vacancy/applicants');
	}
}
?>