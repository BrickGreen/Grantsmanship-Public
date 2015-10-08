<?php 

class Project_model extends CI_Model {

	public function __construct() {

		$this->load->database(); // load the database CI library at class construction
	}

	//precondition: a request from the user has been sent to view data about a project
	//postcondition: data about requested projects has been sent
	public function get_proj_data($proj_title = FALSE) { // sets the variable to false as default

		if($proj_title === FALSE) { // if variable remains unchanged, the entire project table is returned
			$query = $this->db->get('PROJECT'); //gets project table data
			return $query->result_array(); // returns data from select query above
		}

		$query = $this->db->get_where('PROJECT', array('PROJECT_TITLE' => $proj_title)); // if a $proj_title is set as a function parameter, the particular project is selected
		return $query->row_array(); //returns associative array of the selected row or null if not found
	}

	//precondition: a request was sent to view the project titles
	//postcondition: a 2D relational array was returned
	public function get_proj_title() {

		$this->db->select('PROJECT_TITLE'); //select clause to pul only titles

		$query = $this->db->get('PROJECT'); //from clause to specify the table

		return $query->result_array();
	}

	//precondition: the user has created a new project with project data
	//postcondition: a project has been added to the database
	public function set_proj_data($title = FALSE) {

		// $submit_title = $this->input->post('proj_title');

		// data is extracted from the view form and placed in the associative array
		//if no data is entered for a particular data field in the form, null is returned

		// if($title = $submit_title) {

		// 	$sql = 'UPDATE PROJECT SET PROJECT_TITLE = '.$this->db->escape($submit_title).', 
		// 								START_DATE = '.$this->db->escape($this->input->post('proj_start')).',
		// 								END_DATE= '.$this->db->escape($this->input->post('proj_end')).',
		// 								AMOUNT = '.$this->db->escape($this->input->post('proj_due')).',
		// 								APP_DUE_DATE = '.$this->db->escape($this->input->post('proj_amount')).',
		// 								SPONSOR = '.$this->db->escape($this->input->post('proj_sponsor')).',
		// 								MAXIMUM_LENGTH = '.$this->db->escape($this->input->post('proj_max_length')).',
		// 								LETTER_DUE_DATE = '.$this->db->escape($this->input->post('proj_letter_due')).',
		// 								PRIMARY_INVESTIGATOR = '.$this->db->escape($this->input->post('primary_investigator')).'
		// 					WHERE PROJECT_TITLE = '.$this->db->escape($title);
		// 	$this->db->query($sql);
		// }
		// else {
			$data = array(
			'PROJECT_TITLE' => $this->input->post('proj_title'),
			'START_DATE' => $this->input->post('proj_start'),
			'END_DATE' => $this->input->post('proj_end'),
			'AMOUNT' => $this->input->post('proj_amount'),
			'APP_DUE_DATE' => $this->input->post('proj_due'),
			'SPONSOR' => $this->input->post('proj_sponsor'),
			'MAXIMUM_LENGTH' => $this->input->post('proj_max_length'),
			'LETTER_DUE_DATE' => $this->input->post('proj_letter_due'),
			'PRIMARY_INVESTIGATOR' => $this->input->post('primary_investigator')
			);
			$this->db->insert('PROJECT', $data); //insert the data to the database
		}

	public function update_project($title) {
		$sql = 'UPDATE PROJECT SET PROJECT_TITLE = '.$this->db->escape($this->input->post('proj_title')).', 
										START_DATE = '.$this->db->escape($this->input->post('proj_start')).',
										END_DATE= '.$this->db->escape($this->input->post('proj_end')).',
										AMOUNT = '.$this->db->escape($this->input->post('proj_due')).',
										APP_DUE_DATE = '.$this->db->escape($this->input->post('proj_amount')).',
										SPONSOR = '.$this->db->escape($this->input->post('proj_sponsor')).',
										MAXIMUM_LENGTH = '.$this->db->escape($this->input->post('proj_max_length')).',
										LETTER_DUE_DATE = '.$this->db->escape($this->input->post('proj_letter_due')).',
										PRIMARY_INVESTIGATOR = '.$this->db->escape($this->input->post('primary_investigator')).'
							WHERE PROJECT_TITLE = '.$this->db->escape($title);
			$this->db->query($sql);
	}

	//precondition: a valid title has been passed as a parameter
	//postcondition: the records associated with title has been deleted.
	public function update_document($title) {
		$new_title = $this->input->post('proj_title');

		$sql = 'UPDATE DOCUMENT SET PROJECT_TITLE = '.$this->db->escape($new_title).' WHERE PROJECT_TITLE = '.$this->db->escape($title);
		$this->db->query($sql);	
	}

	public function update_group($title) {

		$sql = 'UPDATE groups SET name = '.$this->db->escape($this->input->post('proj_title')).' WHERE name = '.$this->db->escape($title);
		$this->db->query($sql);
	}

	public function delete_from_project($title) {

		$sql2 = 'DELETE FROM PROJECT WHERE PROJECT_TITLE = '.$this->db->escape($title);
		$this->db->query($sql2);

	}
	

	// $new_title = $this->input->post('proj_title');
		
	// 	$sql = 'DELETE FROM PROJECT WHERE PROJECT_TITLE = ?';
	// 	$this->db->query($sql, $this->db->escape($title));

	// 	$sql2 = 'UPDATE DOCUMENT SET PROJECT_TITLE = ? WHERE PROJECT_TITLE = ?';
	// 	$this->db->query($sql2, $this->db->escape($new_title),  $this->db->escape($title));

	public 	function get_group_id($group_name) {
		if(!$group_name || empty($group_name)) {
			return FALSE;
		}
		$this->db->select('id');
		$this->db->from('groups');
		$this->db->where('name', $group_name);
		$query = $this->db->get();

		return $query->result_array();

	}
}

?>