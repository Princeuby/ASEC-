<?php
class Vacancy extends CI_Controller {

	public function __construct() {
		parent::__construct();
		$this->load->model('vacancy_model');
	}

	public function index() {
		$this->load->helper('form');
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

	public function view_vacancy() {
		$data = $this->set_data();
		$this->load->helper('form');
		$data['selected_vacancy'] = '';

		if ($this->input->post('viewVac')) {
			$data['selected_vacancy'] = $this->vacancy_model->
				get_vacancies($this->input->post('viewVac'));

			$this->load->view('templates/header', $data);
		    $this->load->view('templates/nav', $data);
		    $this->load->view('vacancy/view_vacancy', $data);
		    $this->load->view('templates/footer');

		}
		else {
			redirect('vacancy');
		}
	}

	public function applicants() {
		$data = $this->set_data();
		$this->load->helper('form');
		$this->load->library('session');
		$data['vacancyID'] = '';

		if($this->input->post('apply-now')) {
			$data['vacancyID'] = $this->input->post('apply-now');
			$this->session->set_userdata('vacancyID', $data['vacancyID']);
			
			$this->load->view('templates/header', $data);
		    $this->load->view('templates/nav', $data);
		    $this->load->view('vacancy/applicants', $data);
		    $this->load->view('templates/footer');

		}
		// else {
		// 	redirect('vacancy');
		// }

		if($this->input->post('applicant-apply')) {
			$this->load->library('form_validation');

			$this->form_validation->set_rules('applicant-firstName', 'Text', 'required');
			$this->form_validation->set_rules('applicant-lastName', 'Text', 'required');
			$this->form_validation->set_rules('applicant-phoneNumber', 'Text', 'required');
			$this->form_validation->set_rules('applicant-email', 'Text', 'required');
			$this->form_validation->set_rules('applicant-applicationLetter', 'file', 'required');
			$this->form_validation->set_rules('applicant-curriculumVitae', 'file', 'required');

			// echo "AT the beginning"; die();

			if ($this->form_validation->run() === TRUE) {
				$first_name = strip_tags($this->input->post('applicant-firstName'));
				$middle_name = strip_tags($this->input->post('applicant-middleName'));
				$last_name = strip_tags($this->input->post('applicant-lastName'));
				$phone_number = strip_tags($this->input->post('applicant-phoneNumber'));
				$email = strip_tags($this->input->post('applicant-email'));
				$application_letter = $this->input->post('applicant-applicationLetter');
				$curriculum_vitae = $this->input->post('applicant-curriculumVitae');

				$this->vacancy_model->create_application($this->session->userdata('vacancyID'), $first_name, 
					$middle_name, $last_name, $phone_number, $email, $application_letter,
					$curriculum_vitae);
				// echo "AT the end"; die();
				redirect('vacancy');
			}

			$this->load->view('templates/header', $data);
		    $this->load->view('templates/nav', $data);
		    $this->load->view('vacancy/applicants', $data);
		    $this->load->view('templates/footer');

		}

		//$date_of_application, $first_name, $middle_name, $last_name
		//$phone_number, $email, $application_letter, $curriculum_vitae
		//$vacancy_id, $application_status, $applicant_added
	}
}
?>