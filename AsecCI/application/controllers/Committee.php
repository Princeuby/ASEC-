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

	public function scheduled_interview() {
		$data = $this->set_data('Scheduled Interview');
		$this->load->helper('form');
		$data['selected_scheduledInterview'] = '';

		$data['display_scheduledInterview'] = '';
		$data['no_scheduledInterview'] = '';
		$data['interview_applicant'] = 'None';
		$data['job_position'] = $this->session->userdata('vacancy_position');

		if ($this->session->userdata('vacancy_id')) {
			$data['selected_scheduledInterview'] = $this->{$this->session->userdata('model')}->
				get_applicants_interview($this->session->userdata('vacancy_id'));

			$this->session->set_userdata('vacancies', $this->session->userdata('vacancy_id'));
			// print_r($data['selected_applicantsReview']); die();
			if (empty($data['selected_scheduledInterview'])) {
				$data['display_scheduledInterview'] = 'None';
				$data['no_scheduledInterview'] = 'There are no pending applicants to interview';
			}

			if ($this->input->post('intApp')) {
				// echo "in the review button"; die();
				$data['selected_scheduledInterview'] = $this->{$this->session->userdata('model')}->
					get_applicants_interview($this->session->userdata('vacancy_id'));

				$data['selected_applicant'] = $this->{$this->session->userdata('model')}->
					get_applicant($this->input->post('intApp'));

				$data['interview_applicant'] = 'block';
			}
		}
		else {
			redirect('committee');
		}

		$this->load->view('templates/header', $data);
	    $this->load->view('templates/nav');
	    $this->load->view('committee/scheduled_interview');
	    $this->load->view('templates/footer');
	}

	public function add_applicant_interview() {
		$this->load->helper('form');
	    $this->load->library('form_validation');

		$this->form_validation->set_rules('applicant-training-status', 'text', 'required');

	    if ($this->form_validation->run() === TRUE) {
			$applicantID = strip_tags($this->input->post('buttonAppID'));
			$applicant_IntDate = $this->{$this->session->userdata('model')}->get_applicant($applicantID);

			// echo "in the first condition"; die();

			if (strtotime($applicant_IntDate['interview_date']) <= strtotime(date('Y-m-d'))) {
				// echo "in the second condition"; die();
				$trainingStatus = strip_tags($this->input->post('applicant-training-status'));
		    	if ($trainingStatus === "Approved") {
					$this->form_validation->set_rules('applicant-training-date', 'date', 'required');
					$this->form_validation->set_rules('applicant-training-location', 'text', 'required');
					if ($this->form_validation->run() === TRUE) {
						$trainingStatus = '1';
					}
					else{
						redirect($this->session->userdata('home').'/scheduled_interview');
					}
		    	}
		    	elseif ($trainingStatus === "Not Approved") {
		    		$trainingStatus = '0';
		    	}
		    	$trainingDate = strip_tags($this->input->post('applicant-training-date'));
		    	$trainingLocation = strip_tags($this->input->post('applicant-training-location'));
		    	
		    	$this->{$this->session->userdata('model')}->set_applicant_training($applicantID, $trainingStatus, $trainingDate, $trainingLocation);
		    	redirect($this->session->userdata('home').'/scheduled_interview');
			}
			else {
				$this->session->set_flashdata('can_interview', 'Sorry, you have to interview applicant before you can review!');
			}
		}
		redirect($this->session->userdata('home').'/scheduled_interview');
	}

	public function scheduled_training() {
		$data = $this->set_data('Scheduled Training');
		$this->load->helper('form');
		$data['selected_scheduledTraining'] = '';

		$data['display_scheduledTraining'] = '';
		$data['no_scheduledTraining'] = '';
		$data['training_applicant'] = 'None';
		$data['job_position'] = $this->session->userdata('vacancy_position');

		if ($this->session->userdata('vacancy_id')) {
			$data['selected_scheduledTraining'] = $this->{$this->session->userdata('model')}->
				get_applicants_training($this->session->userdata('vacancy_id'));

			$this->session->set_userdata('vacancies', $this->session->userdata('vacancy_id'));
			// print_r($data['selected_applicantsReview']); die();
			if (empty($data['selected_scheduledTraining'])) {
				$data['display_scheduledTraining'] = 'None';
				$data['no_scheduledTraining'] = 'There are no pending applicants for training';
			}

			if ($this->input->post('traApp')) {
				// echo "in the review button"; die();
				$data['selected_scheduledTraining'] = $this->{$this->session->userdata('model')}->
					get_applicants_training($this->session->userdata('vacancy_id'));

				$data['selected_applicant'] = $this->{$this->session->userdata('model')}->
					get_applicant($this->input->post('traApp'));

				$data['training_applicant'] = 'block';
			}
		}
		else {
			redirect('committee');
		}

		$this->load->view('templates/header', $data);
	    $this->load->view('templates/nav');
	    $this->load->view('committee/scheduled_training');
	    $this->load->view('templates/footer');
	}

	public function add_applicant_training() {
		$this->load->helper('form');
	    $this->load->library('form_validation');

		$this->form_validation->set_rules('applicant-success-status', 'text', 'required');

		if ($this->form_validation->run() === TRUE) {
			$applicantID = strip_tags($this->input->post('buttonAppID'));
			$applicant_TraDate = $this->{$this->session->userdata('model')}->get_applicant($applicantID);

			// echo "in the first condition"; die();

			if (strtotime($applicant_TraDate['training_date']) <= strtotime(date('Y-m-d'))) {
				// echo "in the second condition"; die();
				$successStatus = strip_tags($this->input->post('applicant-success-status'));
		    	if ($successStatus === "Approved") {
					$successStatus = '1';
		    	}
		    	elseif ($successStatus === "Not Approved") {
		    		$successStatus = '0';
		    	}
		    	
		    	$this->{$this->session->userdata('model')}->set_applicant_success($applicantID, $successStatus);
		    	redirect($this->session->userdata('home').'/scheduled_training');
			}
			else {
				$this->session->set_flashdata('can_training', 'Sorry, you have to train applicant before you can review!');
			}
		}
		redirect($this->session->userdata('home').'/scheduled_training');
	}
}
?>