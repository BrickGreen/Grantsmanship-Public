<?php 
	
	class Project extends CI_Controller {

		public function __construct() {
			parent:: __construct();
			if(!$this->ion_auth->logged_in()) {
				redirect('auth/login', 'refresh');
			}
			$this->load->model('project_model');
			$this->load->model('repo_model');
			$this->load->model('document_model');			
			$this->load->helper(array('form', 'html'));
			$this->load->library(array('form_validation', 'table'));	
			$this->output->enable_profiler(TRUE);
			
		}

		public function create_form() {
			$data['title'] = 'Enter Project Data';
			$data['users'] = $this->ion_auth->users()->result();


			$this->form_validation->set_rules('proj_title', 'title', 'required');

			if ($this->form_validation->run() == FALSE)
			{
				$this->load->view('templates/header');
				$this->load->view('proj_form', $data);
				$this->load->view('templates/footer');
			}
			else
			{
				$this->project_model->set_proj_data();

				$title = $this->input->post('proj_title');
				
				//$this->project_model->set_proj_data();
				$this->ion_auth->create_group($title);

				$data = $this->input->post('checkbox');

				if(!empty($data)) {
					$group = $this->project_model->get_group_id($title);

					foreach ($data as $user) {
						$this->ion_auth->add_to_group($group[0]['id'], $user);
					}

					$this->load->view('templates/header');
					$this->load->view('success');
					$this->load->view('templates/footer');
				}
			}
		}

		public function show_all_projects() {

			$data['projects'] = $this->project_model->get_proj_data();
			$data['titles'] = $this->project_model->get_proj_title();


			$this->form_validation->set_rules('titles', 'Titles', 'required');

			if ($this->form_validation->run() == FALSE) {
				$this->load->view('templates/header');
				$this->load->view('projects_table', $data);
				$this->load->view('templates/footer');
			}
			else
			{

				return $this->show_project($this->input->post('titles'));
				
			}
			if(isset($_POST['save_btn'])) {

				$this->show_project($this->input->post('proj_title'));
			}
		}

		public function show_project($encoded_title = FALSE) {

			$title = urldecode($encoded_title);
			$save = $this->input->post('save_btn');

			if($save != 'form_save') {
				$data['project'] = $this->project_model->get_proj_data($title);
				$data['cus_snippets'] = $this->document_model->get_doc_cus_snip($title);
				$data['generic_snippets'] = $this->document_model->get_doc_snip($title);

				if (empty($data)) {
					return show_404();
				}

				$this->load->view('templates/header');
				$this->load->view('project_table', $data);
				$this->load->view('templates/footer');
			} else {

				$new_title = $this->input->post('proj_title');

				if($title === $new_title) {
					$this->project_model->update_project($title);
				} else {
					$this->project_model->set_proj_data();
					$this->project_model->update_document($title);
					$this->project_model->update_group($title);
					$this->project_model->delete_from_project($title);
				}
				$this->handle_project();

				$this->load->view('templates/header');
				// var_dump($new_title);
				// var_dump($title);
				$this->load->view('success');
				$this->load->view('templates/footer');
			}
		}

		public function handle_project() {
			$title = $this->input->post('proj_title');
			$data = $this->document_model->get_doc_snip($title);
			$size = count($data);

			for ($i=0; $i < $size ; $i++) { 
				$this->document_model->save_custom_snippet($title, $data[$i]['SNIPPET_TITLE'], $_POST['custom_snippet'][$i]);
			}
			
			// $this->load->view('templates/header');
			// var_dump($data);
			// 	$this->load->view('success');
			// 	$this->load->view('templates/footer');
			redirect('/project/show_project/'.$this->input->post('proj_title'), 'refresh');
		}


		public function show_snip() {

			$data['snippets'] = $this->repo_model->get_snippets();
			$data['titles'] = $this->project_model->get_proj_title();

			$checkboxes = $this->input->post('checkbox'); //array
			$proj_title_repo = $this->input->post('projecto_titles'); //post from porject dropdown
			$new_snip_title = $this->input->post('snip_title'); //post from snippet title input
			$new_snippet = $this->input->post('snippet'); //post from snippet input
			
 			
			if(empty($checkboxes) and empty($new_snip_title) and empty($new_snippet)) {
				$this->load->view('templates/header');
				$this->load->view('snipsnip', $data);
				$this->load->view('templates/footer');
			}
			elseif(empty($new_snip_title) and empty($new_snippet)) {

				$chosen_titles = array();
				foreach ($checkboxes as $checkbox) {
					$chosen_titles[] = $data['snippets'][$checkbox]['SNIPPET_TITLE'];
				}

				$this->document_model->set_doc_data($chosen_titles, $proj_title_repo);

				$this->show_project($this->input->post('projecto_titles'));

			}
			elseif (empty($checkboxes)) {
				$this->repo_model->add_snippet($new_snip_title, $new_snippet);
				redirect('project/show_snip');
			} else {
				if(isset($_POST['insert'])) {
					$chosen_titles = array();
					foreach ($checkboxes as $checkbox) {
						$chosen_titles[] = $data['snippets'][$checkbox]['SNIPPET_TITLE'];
					}

					$this->document_model->set_doc_data($chosen_titles, $proj_title_repo);

					$this->show_project($this->input->post('projecto_titles'));
				} else {

				$this->repo_model->add_snippet($new_snip_title, $new_snippet);
				redirect('project/show_snip');
				}
			}

		}

		public function testing() {
			$this->load->library('unit_test');

			$this->db->select('CUSTOM_SNIPPET');
			$this->db->from('DOCUMENT');
			$this->db->where('PROJECT_TITLE', 'Project 3');
			$this->db->where('SNIPPET_TITLE', 'Introduction');
			$query = $this->db->get();
			$num = $query->num_rows();

			$result = 0;

			echo $this->unit->run($num, $result);

			
		}
	}
?>