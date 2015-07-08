<?php
require_once 'supervisor_model.php';
class CSO_Model extends Supervisor_Model {

	// Gets activity reports
	public function get_activity_reports($officerID, $current_day, $shift, $limit=6) {
		$conditions = array(
			'officer_id LIKE' => $officerID,
			'date_timeIn LIKE' => $current_day . '%',
			'shift LIKE' => $shift
		);
		$this->db->order_by('date_timeIn DESC');
		// Current activity report
		$this->db->limit($limit);
		return $this->db->get_where('activity_report', $conditions)->result_array();
	}
	
	public function get_officer_details($officerID) {
		$query = $this->db->get_where('security_officer', 
			array('officer_id' => $officerID, 'officer_status' => '1'));
		return $query->row_array();
	}

	public function get_all_leaves($leavesID=false) {
		if ($leavesID === false) {
			$query = $this->db->get('leaves');
			return $query->result_array();
		}
		
		$conditions = array(
			'leaves_id' => $leavesID
		);
		return $this->db->get_where('leaves', $conditions)->row_array();
	}
	
	public function get_leave_record($leavesID) {
		$query = $this->db->get_where('leaves', array('leaves_id' => $leavesID));
		return $query->row_array();
	}

	public function get_all_leave_requests() {
		$query = $this->db->query("SELECT first_name, last_name, rank, dept_name,
			leaves_id, leave_type, leave_comment, proceeding_date, entitled_days, recommendation
		FROM security_officer, leaves
		WHERE security_officer.officer_id = leaves.officer_id AND officer_status = '1' 
		AND approved_status IS NULL 
		AND (low_rank ='0' OR recommendation IS NOT NULL) 
		ORDER BY proceeding_date"
		);
		return $query->result_array();
	}

	public function set_approval_status($leavesID, $proceedingDate, $entitledDays, $approvedStatus, $comments) {
		$daysToAdd = $entitledDays . " Days";
		$returningDate = date_add(date_create($proceedingDate), date_interval_create_from_date_string($daysToAdd));
		$returningDate = date_format($returningDate,"Y-m-d");
		$data = array(//Data for update statement
			'entitled_days' => $entitledDays,
			'returning_date' => $returningDate,
			'approved_status' => $approvedStatus,
			'approved_date' => date('Y-m-d'),
			'comments' => $comments
		);
		
		$this->db->update('leaves', $data, "leaves_id = '$leavesID'");
	}
	
	// Gets all the schedules
	public function get_schedules($approved=null, $weekStart) {			
			
		$conditions = array(
			'week_start' => $weekStart,
			'approved' => $approved
		);
		
		if ($approved === null) {
			unset($conditions['approved']);
			$conditions['approved IS null'] = null;
		}
		
		$this->db->group_by(array('location', 'shift'));
		return $this->db->get_where('scheduling', $conditions)->result_array();
	}
	
	// Gets a schedule's status
	public function get_schedule_status($location, $shift, $weekStart) {
			
		$conditions = array(
			'week_start' => $weekStart,
			'location' => $location,
			'shift' => $shift
		);
		
		return $this->db->select('approved')->get_where('scheduling', $conditions)->row_array();
	}
	
	public function set_schedule_status($location, $shift, $approved, $weekStart, $comment=null) {
		$data = array(
			'approved' => $approved,
			'comments' => $comment
		);
		$conditions = array(
			'week_start' => $weekStart,
			'location' => $location,
			'shift' => $shift
		);
		$this->db->update('scheduling', $data, $conditions);
	}
	
	// Gets officers' schedules based on location and last shift
	public function get_officers_schedule($location, $shift, $weekStart) {
		return $this->db->query("SELECT * FROM scheduling WHERE 
			officer_id in (SELECT officer_id FROM officer_locations
			 WHERE officer_status='1' AND officer_location='$location' AND last_shift='$shift') 
			 AND week_start = '$weekStart'")->result_array();
	}
	
	// Gets approved officers' schedules based on location and current shift
	public function get_approved_officers_schedule($location, $shift, $weekStart, $not=false) {
		$sql = "SELECT * FROM scheduling WHERE 
			officer_id in (SELECT officer_id FROM officer_locations
			 WHERE officer_status='1' AND officer_location='$location') AND week_start = '$weekStart'";
		if ($not) 
			$sql .= " AND shift!='$shift'";
		else
			$sql .= " AND shift='$shift'";
		// return $this->db->query("SELECT * FROM scheduling WHERE 
		// 	officer_id in (SELECT officer_id FROM officer_locations
		// 	 WHERE officer_location='$location') AND shift='$shift' 
		// 	 AND week_start = '$weekStart'")->result_array();
		return $this->db->query($sql)->result_array();
	}
	
	public function set_last_shift($officerID, $shift) {
		$data = array(
			'last_shift' => $shift
		);
		$this->db->update('officer_locations', $data, "officer_id = '$officerID'");
	}
	
	// Gets all officers based on location and last shift
	public function get_officers($location, $shift) {
		$conditions = array(
			'officer_location' => $location,
			'last_shift' => $shift
		);
		return $this->db->get_where('officer_locations', $conditions)->result_array();
	}

	public function create_vacancy($position, $summary, $department, $educationLevel, 
	    		$workingExperience, $otherSpecifications, $openingDate, $closingDate) {
		$data = array(//Data for insert statement
			'position' => $position,
			'summary' => $summary,
			'department' => $department,
			'education_level' => $educationLevel,
			'working_experience' => $workingExperience,
			'other_specifications' => $otherSpecifications,
			'opening_date' => $openingDate,
			'closing_date' => $closingDate,
			'vacancy_status' => '1'
		);
		$this->db->insert('vacancy', $data);
	}

	public function get_departments($departmentID = False) {
		if ($departmentID === False) {
			return $this->db->get('department')->result_array();
		}
		return $this->db->get_where('department', array(
			'dept_name' => $departmentID))->row_array();
	}
}
?>