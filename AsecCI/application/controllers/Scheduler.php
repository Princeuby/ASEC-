<?php
class Scheduler extends CI_Controller {
	public function __construct() {
        parent::__construct();
		$this->load->library('session');
		if ($this->session->userdata('officerID') === null) 
			redirect('login/logout');
        $this->load->model('scheduler_model');
    }
	
	public function set_data() {
		$data['title'] = 'Scheduler';
	    $data['page'] = 'Schedule';
		$data['name'] = 'Schedule Officer';
		$data['rank'] = '';
		$data['functions'] = ['Schedule', 'Alter Schedule'];
		return $data;
	}
	
	public function index() {
		$data = $this->set_data();	
		$this->load->helper('form');
		$data['locations'] = $this->scheduler_model->get_locations();
		$data['shifts'] = $this->scheduler_model->get_shifts();
		$data['officers'] = [];
		$data['display_s'] = "None";
		// Rotating algorithm
		$shifts = ["Morning"=>"Afternoon", "Afternoon"=>"Night", "Night"=>"Morning"];
		
		// The beginning of the process
		if ($this->input->post('get-schedule')) {
			$data['selected_location'] = $this->input->post('location');
			$data['selected_shift'] = $this->input->post('shift');
			$data['last_shift'] = $shifts[$data['selected_shift']];
			$data['officers'] = $this->scheduler_model->get_officers($data['selected_location'],
				 $data['last_shift']);
			if (!(empty($data['officers']))) {
				for ($i = 0; $i < count($data['officers']); $i ++) {
					$data['officers'][$i]['officer_name'] = $this->scheduler_model->get_officer_name(
						$data['officers'][$i]['officer_id']);
				}
				$data['display_s'] = "";
			}
		}
		$this->load->view('templates/header', $data);
	    $this->load->view('templates/nav');
	    $this->load->view('scheduler/index');
	    $this->load->view('templates/footer');
	}
	
	public function schedule() {
		redirect('scheduler');
	}
	
	public function add_schedule() {
		$this->load->helper('form');
	}
	
}