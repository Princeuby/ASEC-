<?php
require_once 'Officer.php';

class Supervisor extends Officer {

	protected function set_data($page='Home') { // sets the data variables to avoid repition
		$data = parent::set_data($page);
		$data['functions'][] = 'leave requests';
		return $data;
	} 
	
	public function leave_requests() {
		$data = $this->set_data('Leave Requests');	
		//Gets leave request information for supervisor
		$data['leave_requests'] = $this->{$this->session->userdata('model')}->get_leave_requests($data['id']);
		$data['display_requests'] = 'block';
		$data['no_requests'] = '';
		$data['failed_recommendation'] = '';
		$data['display_recommendation'] = 'None';

		//Check if there is leave request
		if (empty($data['leave_requests'])) {
			//No Pending Requests
			$data['display_requests'] = 'None';
			$data['no_requests'] = "There are currently no pending leave requests";
		}

		$this->load->helper('form');

	    $this->load->view('templates/header', $data);
	    $this->load->view('templates/nav', $data);
	    
	    if ($this->input->post('recCom')) {
	    	$data['selected_leave'] = $this->{$this->session->userdata('model')}->
	    		get_leave_record($this->input->post('recCom'));

	    	$data['selected_officer'] = $this->{$this->session->userdata('model')}->
	    		get_officer_details($data['selected_leave']['officer_id']);

	    	$data['display_recommendation'] = 'block';
	    }

	    $this->load->view($this->session->userdata('home').'/leave_requests', $data);
	    $this->load->view('templates/footer');
	}

	public function add_recommendation() {
		$this->load->helper('form');
	    $this->load->library('form_validation');

		$this->form_validation->set_rules('recommendation-days', 'Number', 'required');
	    $this->form_validation->set_rules('recommendation-comment', 'Text', 'required');

	    if ($this->form_validation->run() === TRUE) {
			$leaveID = strip_tags($this->input->post('buttonLeaveId'));
	    	$entitledDays = strip_tags($this->input->post('recommendation-days'));
	    	$recommendation = strip_tags($this->input->post('recommendation-comment'));
	    	$this->{$this->session->userdata('model')}->set_recommendation($leaveID, $entitledDays, $recommendation);
	    	redirect($this->session->userdata('home').'/leave_requests');
		}
		$data['failed_recommendation'] = "Failed to add recommendation, Please try again!";
		redirect($this->session->userdata('home').'/leave_requests');
	}
}
?>