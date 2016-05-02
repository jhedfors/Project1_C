<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Main extends CI_Controller {
	public function __construct(){
		parent:: __construct();
		$this->load->model('quotes_model');
		$this->load->library('session');
	}
	public function index()
	{
		$this->load->view('login_reg_view');
	}
	public function login(){
		$this->form_validation->set_rules("email", "Email", "trim|required");
		$this->form_validation->set_rules("password", "Password", "trim|required|callback_check_credentials");
		if($this->form_validation->run() === FALSE)		{
			$this->session->set_userdata('errors_login',[validation_errors()]);
			$this->load->view('login_reg_view');
		}
		else{
			redirect('quotes');
		}
	}
	public function validation(){
		$routing = [
  'name'=>function($post_data){$this->form_validation->set_rules("name", "Name", "trim|required|min_length[1]");},
	'email'=>function($post_data){		$this->form_validation->set_rules("email", "Email", "trim|required|min_length[3]|callback_check_preexisting_email");},
	'alias'=>function($post_data){		$this->form_validation->set_rules("alias", "Alias", "trim|required|min_length[3]");},
	'password'=>function($post_data){$this->form_validation->set_rules("password", "Password", "trim|required|min_length[8]");},
	'confirm_pw'=>function($post_data){$this->form_validation->set_rules("confirm_pw", "Confirmed Password", "trim|required|matches[password]");},
	'dob'=>function($post_data){$this->form_validation->set_rules("dob", "Date of Birth", "trim|required");},
];
$routing[$_POST['action']]($_POST);
	}


	public function register(){
		var_dump($this->input->post());
		die();
		$this->form_validation->set_rules("name", "Name", "trim|required|min_length[1]");
		$this->form_validation->set_rules("email", "Email", "trim|required|min_length[3]|callback_check_preexisting_email");
		$this->form_validation->set_rules("alias", "Alias", "trim|required|min_length[3]");
		$this->form_validation->set_rules("password", "Password", "trim|required|min_length[8]");
		$this->form_validation->set_rules("confirm_pw", "Confirmed Password", "trim|required|matches[password]");
		$this->form_validation->set_rules("dob", "Date of Birth", "trim|required");
		if($this->form_validation->run() === FALSE)		{
			$this->session->set_userdata('errors_reg',[validation_errors()]);
			$this->load->view('login_reg_view');
		}
		else{
			$post = $this->input->post();
			if($this->quotes_model->register($post) ){
				$record = $this->quotes_model->show_by_email($post['email']);
				$this->session->set_userdata('active_id' ,$record['id']);
				$this->session->set_userdata('alias' ,$record['alias']);
				redirect('quotes');
			}
			redirect('unanticipated_error');
		}
	}
	public function check_preexisting_email($post_email){
		$record = $this->quotes_model->show_by_email($post_email);
		if($record){
			$this->form_validation->set_message('check_preexisting_email', '%s is already in use');
			return FALSE;
		}
		else {
			return TRUE;
		}
	}
	public function check_credentials(){
		$post = $this->input->post();
		$record;
		if ($this->quotes_model->show_by_email($post['email']) == null) {
			$this->form_validation->set_message('check_credentials', 'Email/Password incorrect');
			return FALSE;
		}
		$record = $this->quotes_model->show_by_email($post['email']);
		if($record['password'] != do_hash($post['password'])) {
			$this->form_validation->set_message('check_credentials', 'Email/Password incorrect');
			return FALSE;
		}
		$this->session->set_userdata('active_id' ,$record['id']);
		$this->session->set_userdata('alias' ,$record['alias']);
		return TRUE;
	}
	public function quotes_view(){
		$active_id = $this->session->userdata('active_id');
		$data['non_favorites'] = $this->quotes_model->show_non_favorites($active_id);

		$data['favorites'] = $this->quotes_model->show_favorites($active_id); 		$this->load->view('quotes_view',['data'=>$data]);

	}
	public function user_view($id){
		$data = $this->quotes_model->show_all_quotes_user($id);
		$this->load->view('user_view',['data'=>$data]);
	}
	public function add_form(){
		$this->form_validation->set_rules("speaker", "Quoted By", "trim|required|min_length[3]");
		$this->form_validation->set_rules("quote", "Message", "trim|required|min_length[10]");
		if($this->form_validation->run() === FALSE){
			$this->session->set_userdata('errors_add',[validation_errors()]);
			var_dump($this->session->userdata('errors_add'));
			// die();
			redirect('/quotes');
			// die('val');
			// $this->load->view('quotes_view');
		}
		else{
			$post = $this->input->post();
			$this->quotes_model->add_quote($post);
			redirect('/quotes');
		}

	}
	public function add_favorite($quote_id){
		$active_id = $this->session->userdata('active_id');
		$this->quotes_model->add_favorite($active_id,$quote_id);
		redirect('/quotes');
	}
	public function remove_favorite($quote_id){
		$active_id = $this->session->userdata('active_id');
		$this->quotes_model->remove_favorite($active_id,$quote_id);
		redirect('/quotes');
	}
	public function logout(){
		$this->session->sess_destroy();
		redirect('/');
	}
}
	/**
	 * Index Page for this controller.
	 *
	 * Maps to the following URL
	 * 		http://example.com/index.php/welcome
	 *	- or -
	 * 		http://example.com/index.php/welcome/index
	 *	- or -
	 * Since this controller is set as the default controller in
	 * config/routes.php, it's displayed at http://example.com/
	 *
	 * So any other public methods not prefixed with an underscore will
	 * map to /index.php/welcome/<method_name>
	 * @see http://codeigniter.com/user_guide/general/urls.html
	 */


/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */
