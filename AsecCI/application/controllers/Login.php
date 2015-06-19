<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Login extends CI_Controller {
	
	public function index() {
	    $this->load->helper('form');
	    $this->load->library('form_validation');

	    $data['title'] = 'Login';

	    $this->form_validation->set_rules('id', 'Username', 'required');
	    $this->form_validation->set_rules('password', 'Password', 'required');

	    if ($this->form_validation->run() === FALSE) {
	        $this->load->view('templates/header', $data);
	        $this->load->view('index');
	        // $this->load->view('templates/footer');

	    }
	    else {
			// redirect
	        $this->load->view('welcome_message');
	    }
	}
}	
	
?>