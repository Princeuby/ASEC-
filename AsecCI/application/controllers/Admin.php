<?php
require_once 'Officer.php';

class Admin extends Officer {

	protected function protectPage() {
		return ($this->session->userdata('home') === 'admin');
	}

	protected function set_data($page='Home') { // sets the data variables to avoid repition
		$data = parent::set_data($page);
		$data['functions'] = ['home', 'add officer', 'reset password'];
		return $data;
	} 

	public function index() {
		$data = $this->set_data();
		redirect($this->session->userdata('home').'/add_officer');
	}

	public function add_officer() {
		$data = $this->set_data('Add Officer');
		$model = $this->session->userdata('model');

		$data['applicants'] = $this->{$model}->get_success_applicants();
		$data['display_success_applicants'] = 'block';
		$data['no_applicants'] = '';
		$data['add_new_officer'] = 'None';

		for ($i = 0; $i < count($data['applicants']); $i++) {
			$vacancy_details = $this->{$model}->get_vacancy($data['applicants'][$i]['vacancy_id']);
			$data['applicants'][$i]['position'] = $vacancy_details['position'];
			$data['applicants'][$i]['department'] = $vacancy_details['department'];
		}	

		if (empty($data['applicants'])) {
			$data['display_success_applicants'] = 'None';
			$data['no_applicants'] = "There are no applicants to be added";
		}

		$this->load->helper('form');

		$this->load->view('templates/header', $data);
	    $this->load->view('templates/nav', $data);

	    if ($this->input->post('addApp')) {
	    	$data['selected_applicant'] = $this->{$model}->
	    		get_success_applicants($this->input->post('addApp'));

			$data['add_new_officer'] = 'block';
	    }

	    $this->load->view($this->session->userdata('home').'/add_officer', $data);
	    $this->load->view('templates/footer');	
	}

	public function reset_password() {
		$this->load->helper('form');
		$data = $this->set_data('Reset Password');	
		$model = $this->session->userdata('model');
		$data['details_officer'] ='';

		if ($this->input->post('get-officer')) {
			$data['details_officer'] = $this->{$model}->
				get_officer_details($this->input->post('id-officer'));

			if (empty($data['details_officer'])) {
				$this->session->set_flashdata('failed_add', 'ID not found!');

				redirect($this->session->userdata('home').'/reset_password');
			}

			$data['details_officer']['officer_name'] = $this->{$model}->get_officer_name(
				$this->input->post('id-officer'));
		}

		if ($this->input->post('reset-password')) {
			$this->{$model}->reset_officer_password($this->input->post('reset-password'));

			redirect($this->session->userdata('home').'/reset_password');
		}

		$this->load->view('templates/header', $data);
	    $this->load->view('templates/nav');
	    $this->load->view($this->session->userdata('home').'/reset_password');
	    $this->load->view('templates/footer');

	}

}
?>