<?php
class Officer extends CI_Controller {
	
	public function __construct() {
            parent::__construct();
            $this->load->model('officer_model');
    }
	
	public function index() {
		$data = $this->set_data();
	    $this->load->view('templates/header', $data);
	    $this->load->view('templates/nav', $data);
	    $this->load->view($this->session->userdata('home').'/index');
	    $this->load->view('templates/footer');
	}
	
	protected function set_data($page='Home') { // sets the data variables to avoid repition
		$this->load->library('session');
		$data['title'] = ucwords($this->session->userdata('home'));
	    $data['page'] = $page;
		$data['name'] = $this->session->userdata('officerFullName');
		$data['rank'] = $this->session->userdata('officerRank');
		$data['id'] = $this->session->userdata('officerID');
		$data['functions'] = ['home', 'schedule', 'test', 'leaves', 'activity report'];
		$data['designation'] = $this->session->userdata('home');
		return $data;
	}
	
	public function home() {
		redirect('/'.$this->session->userdata('home'));
	}
	
	public function activity_report() {
		$data = $this->set_data('Activity Report');
		// Gets activity report for current shift
		$data['report'] = $this->officer_model->get_activity_report($data['id']);
		// Checks if activity report has been created
		if (empty($data['report'])) {
			// Creates new activity report **Uses wrong previous ID**
			$data['report'] = $this->officer_model->create_activity_report(
				$data['id'],$data['id']); 
			$data['report'] = $this->officer_model->get_activity_report($data['id']);
		}
		
		// $this->load->view('templates/header', $data);
		// $this->load->view('templates/nav', $data);
		// $this->load->view('officer/activity_report', $data);
	    // $this->load->view('templates/footer');
		$this->load->helper('form');
	    $this->load->library('form_validation');
		
		$this->form_validation->set_rules('incident', 'Username', 'required');
	    $this->form_validation->set_rules('details', 'Text', 'required');

		$this->load->view('templates/header', $data);
		$this->load->view('templates/nav', $data);
			
		if ($this->form_validation->run() === FALSE) {
		    $this->load->view($this->session->userdata('home').
		    	'/activity_report');
	    }
		else {
	    	$this->load->view($this->session->userdata('home').
	    		'/activity_success');
		}
		
	    $this->load->view('templates/footer');
		
	}
	
	public function incident() {
		$data = $this->set_data('Activity Report');
		$this->load->helper('form');
	    $this->load->library('form_validation');
		
		$this->form_validation->set_rules('incident', 'Username', 'required');
	    $this->form_validation->set_rules('details', 'Text', 'required');

		$this->load->view('templates/header', $data);
		$this->load->view('templates/nav', $data);
			
		if ($this->form_validation->run() === FALSE) {
		    $this->load->view($this->session->userdata('home').
		    	'/activity_report');
	    }
		else {
	    	$this->load->view($this->session->userdata('home').
	    		'/activity_success');
		}
		
	    $this->load->view('templates/footer');
	}

	public function leaves() {
		$data = $this->set_data('Leaves');	
		//Gets leave information for officer
		$data['leaves'] = $this->officer_model->get_officer_leaves($data['id']);
		$data['display_leaves'] = '';
		$data['no_leaves'] = '';

		//Check if there is leave history
		if (empty($data['leaves'])) {
			//No Leave history
			$data['display_leaves'] = 'None';
			$data['no_leaves'] = "Sorry, you have no leave record";
		}

		$this->load->helper('form');
	    $this->load->library('form_validation');
		
		$this->form_validation->set_rules('leave-type', 'Text', 'required');
	    $this->form_validation->set_rules('proceeding-date', 'Date', 'required');

	    $this->load->view('templates/header', $data);
	    $this->load->view('templates/nav', $data);

	    if ($this->form_validation->run() == TRUE) {
	    	$leaveType = strip_tags($this->input->post('leave-type'));
	    	$proceedingDate = strip_tags($this->input->post('proceeding-date'));
	    	$data['supervisor'] = $this->officer_model->get_supervisor($data['id']);
	    	$this->officer_model->create_officer_leave($data['id'], $leaveType, 
	    		$proceedingDate, $data['supervisor']['officer_id']);
	    	redirect('/officer/leaves');
	    }

	    $this->load->view('officer/leaves');
	    $this->load->view('templates/footer');
	}
}	
	
?>