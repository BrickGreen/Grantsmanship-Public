<?php 	
	class Repository extends CI_Controller {

		public function __construct() {
			parent:: __construct();
			$this->load->model('repo_model');
			$this->load->model('project_model');
			$this->load->model('document_model');
			$this->load->library('unit_test');
			$this->load->helper('form');
			$this->load->library('table');
		}

		public function show_snip() {

			$data['snippets'] = $this->repo_model->get_snippets();
			$data['titles'] = $this->project_model->get_proj_title();

			$checkboxes = $this->input->get('checkbox'); //array
			$proj_title_repo = $this->input->get('projecto_titles');
 			
			if(empty($checkboxes)) {
				$this->load->view('templates/header');
				$this->load->view('snipsnip', $data);
				$this->load->view('templates/footer');
			}
			else {

				$chosen_titles = array();
				foreach ($checkboxes as $checkbox) {
					$chosen_titles[] = $data['snippets'][$checkbox]['SNIPPET_TITLE'];
				}

				$this->load->view('templates/header');
				$this->load->view('success');
				$this->load->view('templates/footer');

				$this->document_model->set_doc_data($chosen_titles, $proj_title_repo);

				
			}
		}

	}
?>