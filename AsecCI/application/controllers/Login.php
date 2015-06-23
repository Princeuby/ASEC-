<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Login extends CI_Controller {
	public function __construct() {
            parent::__construct();
            $this->load->model('login_model');
    }

	public function index() {
	    $this->load->helper('form');
	    $this->load->library('form_validation');
	    $this->load->library('session');

	    $data['title'] = 'Login';

	    $this->form_validation->set_rules('id', 'Username', 'required');
	    $this->form_validation->set_rules('password', 'Password', 'required');

	    if ($this->form_validation->run() === FALSE) {
	        $this->load->view('templates/header', $data);
	        $this->load->view('index');

	    }
	    else { // Redirects to correct controller after validation
			$user = $this->input->post('id');
			$pass = $this->input->post('password');
			$data['officer'] = $this->login_model->get_officer($user);
			if (empty($data['officer'])) 
            	show_404();
            
            if (($user == $data['officer']['officer_id']) &&
				 (password_verify($pass, $data['officer']['password']))) {
				$officerFullName = $data['officer']['first_name'] . " " .
								   $data['officer']['last_name'];
				$newdata = array(
        			'officerID'  => $data['officer']['officer_id'],
        			'officerFullName'     => $officerFullName,
        			'officerRank' => $data['officer']['rank']
				);
				$this->session->set_userdata($newdata);
				redirect('/officer');
			}
			else {
				$this->load->view('templates/header', $data);
	        	$this->load->view('index');
			}	
	    }
	}
	
	public function logout() {
		$this->load->library('session');
		$this->session->sess_destroy();
		redirect('');
	}
}	
	
?>