<?php 
	
	class Repo_model extends CI_Model {

		public function __construct() {

			$this->load->database();
		}

		//Precondition: The repository page has been requested which requests this function
		//Postcondition: The snippet titles and snippets have been returned
		public function get_snippets($snip_title = FALSE) {
			if ($snip_title === FALSE) { //checks if a parameter has been added

				$query = $this->db->get('SNIPPET'); //select all snippets and snipper titles
				return $query->result_array(); //returns array with key value pairs for snippets and snippet titles
			}
		}

		//Precondition: Content has been supplied into the INSERT NEW textarea 
		//				on the repostitory page and the INSERT NEW button has been pressed.
		//Postcondition: A new snippet has been added to the snippet db table 
		//					and is shown in the repo list.
		public function add_snippet($snip_title = FALSE, $snippet = FALSE) {
			if ($snip_title != FALSE and $snippet != FALSE) {

				//array to prepare data for insert query
				$query = array('SNIPPET_TITLE' => $snip_title,
								'SNIPPET' => $snippet);

				$this->db->insert('SNIPPET', $query); //insert array
			}
		}
	}
?>