<?php
class Vacancy extends CI_Controller {

	public function __construct() {
		parent::__construct();
		$this->load->model('vacancy_model');
		$this->load->library('session');
		$this->load->helper(array('form', 'url'));
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
	    $this->load->view('vacancy/applicants', array('error' => ' ' ));
	    $this->load->view('templates/footer');
	}

	public function add_application() {
		$this->load->helper('form');
	    $this->load->library('form_validation');

	    $this->form_validation->set_rules('applicant-firstName', 'Text', 'required');
		$this->form_validation->set_rules('applicant-lastName', 'Text', 'required');
		$this->form_validation->set_rules('applicant-phoneNumber', 'Text', 'required');
		$this->form_validation->set_rules('applicant-email', 'Text', 'required');

		if ($this->form_validation->run() === TRUE) {
			$AL = $this->check_upload('applicant-applicationLetter');
			// print_r('AL: '.$AL); die();
			
			$CV = $this->check_upload('applicant-curriculumVitae');
			// print_r('CV: '.$CV); die();

			$first_name = strip_tags($this->input->post('applicant-firstName'));
			$middle_name = strip_tags($this->input->post('applicant-middleName'));
			$last_name = strip_tags($this->input->post('applicant-lastName'));
			$phone_number = strip_tags($this->input->post('applicant-phoneNumber'));
			$email = strip_tags($this->input->post('applicant-email'));

			$applicant_id = $this->vacancy_model->create_application($this->session->userdata('application_vacancy_id'), 
				$first_name, $middle_name, $last_name, $phone_number, $email);
			
			// print_r('Applicant ID: '.$applicant_id); die();
			
			$application_letter = $this->file_upload('applicant-applicationLetter', $applicant_id.'_'.$AL);
			// print_r('application_letter: '.$application_letter); die();
			
			$curriculum_vitae = $this->file_upload('applicant-curriculumVitae', $applicant_id.'_'.$CV);
			// print_r('curriculum_vitae: '.$curriculum_vitae); die();

			$this->vacancy_model->add_upload_files($applicant_id, $application_letter, $curriculum_vitae);	
			
			redirect('vacancy');
		}
		else {
			$this->session->set_flashdata('failed_create', "Failed to create application, please try again!");
		}
		redirect('vacancy/applicants');
	}

	protected function check_upload($fieldName) {
		// $data = $this->set_data();
		
		$path = "assets/uploads";

	    if(!is_dir($path)) //create the folder if it's not already exists
	    {
	      mkdir($path,0755,TRUE);
	    } 
        $config['upload_path']          = 'assets/uploads/';
        $config['allowed_types']        = 'doc|docx|pdf';
        $config['max_size']             = 2000;
       
        $this->load->library('upload', $config);

        if (!$this->upload->do_upload($fieldName)) {
            $error = $this->upload->display_errors();
            $this->session->set_flashdata('failed_create', $error);

			redirect('vacancy/applicants');
        }
        else{
        	// $data = array('upload_data' => $this->upload->data());
	        $file_is_named = $this->upload->data('file_name');
	        unlink($config['upload_path'].$file_is_named);
	        return  $file_is_named;
        }
	}

	protected function file_upload($fieldName, $fileName) {
		$config['upload_path']          = 'assets/uploads/';
        $config['allowed_types']        = 'doc|docx|pdf';
        $config['max_size']             = 2000;
        $config['overwrite']			= 1;
        $config['file_name']			= $fileName;
        
        $this->upload->initialize($config);

        // $this->load->library('upload', $config);

        $this->upload->do_upload($fieldName);

        $data = array('upload_data' => $this->upload->data());
        
        // $this->upload->data('file_name') = $this->upload->data('file_name') . $fileName;
        $filename = $this->upload->data('file_name');
        // $uploadPath = $this->upload->data('upload_path');

        return $config['upload_path'].$filename;
	}
}
?>
