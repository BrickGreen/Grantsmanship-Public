<?php 
	class Document_model extends CI_Model {

		public function __construct() {
			$this->load->database();
		}

		public function set_doc_data($snip_title, $proj_title) {
			// $check_title = $this->input->post('projecto_titles');
			$snip_array = array();

			foreach ($snip_title as $title) {
				$data = array(
				'PROJECT_TITLE' => $proj_title,
				'SNIPPET_TITLE' => $title);

				array_push($snip_array, $data);
			}
			
			$this->db->insert_batch('DOCUMENT', $snip_array);
		}

		public function get_doc_snip($title) {
			$this->db->select('SNIPPET.SNIPPET_TITLE');
			$this->db->select('SNIPPET.SNIPPET');
			$this->db->from('SNIPPET');
			$this->db->join('DOCUMENT', 'SNIPPET.SNIPPET_TITLE = DOCUMENT.SNIPPET_TITLE');
			$this->db->where('DOCUMENT.PROJECT_TITLE', $title);
			$query1 = $this->db->get();

			return $query1->result_array();
			
		}

		public function get_doc_cus_snip($proj_title) {
			$this->db->select('SNIPPET_TITLE');
			$this->db->select('CUSTOM_SNIPPET');
			$this->db->from('DOCUMENT');
			$this->db->where('PROJECT_TITLE', $proj_title);
			$query2 = $this->db->get();
			return $query2->result_array();
		}

		//precondition: a user has edited the original snippet and clicked save
		//postcondition: the custom snippet has been saved to the document table
		public function save_custom_snippet($project_title, $snip_title, $snippet) {
			//query to select record for custom snippet
			$this->db->select('CUSTOM_SNIPPET');
			$this->db->from('DOCUMENT');
			$this->db->where('PROJECT_TITLE', $project_title);
			$this->db->where('SNIPPET_TITLE', $snip_title);
			$query = $this->db->get();
			$num = $query->num_rows();

			if($num == 0) {
				$data = array(
					'PROJECT_TITLE' => $project_title,
					'SNIPPET_TITLE' => $snip_title,
					'CUSTOM_SNIPPET' => $snippet);

				$this->db->insert('DOCUMENT', $data);
			}
			else {
				$data = array('CUSTOM_SNIPPET' => $snippet);
				$this->db->where('PROJECT_TITLE', $project_title);
				$this->db->where('SNIPPET_TITLE', $snip_title);
				$this->db->update('DOCUMENT', $data);
			}
		}
	}
?>