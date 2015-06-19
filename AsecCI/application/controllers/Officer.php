<?php
class Officer extends CI_Controller {
	
	public function index() {

	    $data['title'] = 'Officer';
		$data['name'] = 'Alice Raymond';
		$data['rank'] = 'Supervisor';
		$data['functions'] = ['schedule', 'test', 'test3'];
		

		$this->load->view('templates/header', $data);
	    $this->load->view('templates/nav', $data);
	    $this->load->view('officer/index');
	    $this->load->view('templates/footer');
	}
}	
	
?>