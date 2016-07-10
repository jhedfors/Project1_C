<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Quotes extends CI_Controller {
	public function __construct(){
		parent:: __construct();
		$this->load->model('quotes_model');
		$this->load->library('session');
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
			redirect('/quotes');
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

}
