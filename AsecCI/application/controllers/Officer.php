<?php
class Officer extends CI_Controller {
	
	public function index() {
		$this->load->library('session');
		
	    $data['title'] = 'Officer';
	    $data['page'] = 'Home';
		$data['name'] = $this->session->userdata('officerFullName');
		$data['rank'] = $this->session->userdata('officerRank');
		$data['functions'] = ['home', 'schedule', 'test', 'test3', 'activity report'];
		
		

		$this->load->view('templates/header', $data);
	    $this->load->view('templates/nav', $data);
	    $this->load->view('officer/index');
	    $this->load->view('templates/footer');
	}
}	
	
?>