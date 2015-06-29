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
		$data['functions'] = ['Schedule', 'Change Location'];
		return $data;
	}
	
	public function index() {
		$data = $this->set_data();
	    $this->load->view('templates/header', $data);
	    $this->load->view('templates/nav', $data);
	    $this->load->view('scheduler/index');
	    $this->load->view('templates/footer');
	}
	
	public function schedule() {
		redirect('scheduler');
	}
	
}