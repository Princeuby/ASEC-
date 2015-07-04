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

		$this->load->helper('form');

		if ($this->input->post('viewAct')) {
			$this->session->set_userdata('vacancy_id', $this->input->post('viewAct'));
			$this->session->set_userdata('vacancy_position', $this->{$this->session->userdata('model')}->
				get_vacancy_position($this->input->post('viewAct')));
			redirect('committee/applicants_review');
		}

		$data['can_end'] = '';
		if ($this->input->post('closeAct')) {
			$current_vacancy = $this->{$this->session->userdata('model')}->
				get_active_vacancies($this->input->post('closeAct'));
			if ((strtotime($current_vacancy['closing_date']) < strtotime(date('Y-m-d'))) && 
					($this->{$this->session->userdata('model')}->count_active_applicants($this->input->post('closeAct')) == 0)) {
				$this->{$this->session->userdata('model')}->
					close_active_vacancy($this->input->post('closeAct'));
				redirect('committee/index');
			}
			else {
				$data['can_end'] = "Sorry, you cannot end the review now!";
			}
		}

		$this->load->view('templates/header', $data);
	    $this->load->view('templates/nav', $data);
	    $this->load->view($this->session->userdata('home').'/index');
	    $this->load->view('templates/footer');
	}

	public function applicants_review() {
		$data = $this->set_data('Applicants Review');
		$this->load->helper('form');
		$data['selected_applicantsReview'] = '';

		$data['display_applicantsReview'] = '';
		$data['no_applicantsReview'] = '';
		$data['review_applicant'] = 'None';
		$data['job_position'] = $this->session->userdata('vacancy_position');

		if ($this->session->userdata('vacancy_id')) {
			$data['selected_applicantsReview'] = $this->{$this->session->userdata('model')}->
				get_applicants_review($this->session->userdata('vacancy_id'));

			$this->session->set_userdata('vacancies', $this->session->userdata('vacancy_id'));
			// print_r($data['selected_applicantsReview']); die();
			if (empty($data['selected_applicantsReview'])) {
				$data['display_applicantsReview'] = 'None';
				$data['no_applicantsReview'] = 'There are no pending applicants to review';
			}

			if ($this->input->post('revApp')) {
				// echo "in the review button"; die();
				$data['selected_applicantsReview'] = $this->{$this->session->userdata('model')}->
					get_applicants_review($this->session->userdata('vacancy_id'));

				$data['selected_applicant'] = $this->{$this->session->userdata('model')}->
					get_applicant($this->input->post('revApp'));

				$data['review_applicant'] = 'block';
			}
		}
		else {
			redirect('committee');
		}

		$this->load->view('templates/header', $data);
	    $this->load->view('templates/nav');
	    $this->load->view('committee/applicants_review');
	    $this->load->view('templates/footer');
	}

	public function add_applicant_review() {
		$this->load->helper('form');
	    $this->load->library('form_validation');

		$this->form_validation->set_rules('applicant-interview-status', 'text', 'required');

	    if ($this->form_validation->run() === TRUE) {
			$applicantID = strip_tags($this->input->post('buttonAppID'));
	    	$interviewStatus = strip_tags($this->input->post('applicant-interview-status'));
	    	if ($interviewStatus === "Approved") {
				$this->form_validation->set_rules('applicant-interview-date', 'date', 'required');
				$this->form_validation->set_rules('applicant-interview-location', 'text', 'required');
				if ($this->form_validation->run() === TRUE) {
					$interviewStatus = '1';
				}
				else{
					redirect($this->session->userdata('home').'/applicants_review');
				}
	    	}
	    	elseif ($interviewStatus === "Not Approved") {
	    		$interviewStatus = '0';
	    	}
	    	$interviewDate = strip_tags($this->input->post('applicant-interview-date'));
	    	$interviewLocation = strip_tags($this->input->post('applicant-interview-location'));
	    	
	    	$this->{$this->session->userdata('model')}->set_applicant_interview($applicantID, $interviewStatus, $interviewDate, $interviewLocation);
	    	redirect($this->session->userdata('home').'/applicants_review');
		}
		redirect($this->session->userdata('home').'/applicants_review');
	} 
}
?>