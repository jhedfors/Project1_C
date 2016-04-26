<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Pokes extends CI_Controller {
	public function __construct(){
		parent:: __construct();
		$this->load->model('Pokes_model');
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
			redirect('pokes');
		}
	}
	public function register(){
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
			if($this->Pokes_model->register($post) ){
				$record = $this->Pokes_model->show_by_email($post['email']);
				$this->session->set_userdata('active_id' ,$record['id']);
				$this->session->set_userdata('alias' ,$record['alias']);
				redirect('pokes');
			}
			redirect('unanticipated_error');
		}
	}
	public function check_preexisting_email($post_email){
		$record = $this->Pokes_model->show_by_email($post_email);
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
		if ($this->Pokes_model->show_by_email($post['email']) == null) {
			$this->form_validation->set_message('check_credentials', 'Email/Password incorrect');
			return FALSE;
		}
		$record = $this->Pokes_model->show_by_email($post['email']);
		if($record['password'] != do_hash($post['password'])) {
			$this->form_validation->set_message('check_credentials', 'Email/Password incorrect');
			return FALSE;
		}
		$this->session->set_userdata('active_id' ,$record['id']);
		$this->session->set_userdata('alias' ,$record['alias']);
		return TRUE;
	}
	public function pokes_view(){
		$active_id = $this->session->userdata('active_id');
		$data['pokes'] = $this->Pokes_model->show_pokes_by_id($active_id);
		$data['all_users'] = $this->Pokes_model->index_users();
		for ($i=0; $i < count($data['all_users']); $i++) {
			$poke_count = $this->Pokes_model->show_poke_count_by_id($data['all_users'][$i]['id']);
			$data['all_users'][$i]['pokes_recieved'] = $poke_count['pokes_recieved'];
		}
		$this->load->view('pokes_view',['data'=>$data]);
	}
	public function poke($pokee_id,$poker_id){
		$this->Pokes_model->add_poke($pokee_id,$poker_id);
		redirect('/pokes');
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
