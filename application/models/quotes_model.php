<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Quotes_model extends CI_Model {
	public function __construct(){
		$this->load->helper('security');
	}
	public function register($post){
		$password = do_hash($post['password']);
		$query = "insert into users (name, alias, email, password, dob, created_at, modified_at) values(?,?,?,?,?,NOW(),NOW())";
		$values =
			 ["{$post['name']}","{$post['alias']}","{$post['email']}",$password,"{$post['dob']}"];
		$this->db->query($query, $values);
		return true;
	}
	public function index_users(){
		$query = "SELECT id, name, alias, email FROM users";
		return $this->db->query($query)->result_array();
	}
	public function show_by_email($email){
		$query =
			"SELECT * FROM users WHERE email = ?";
		$values = [$email];
		return $this->db->query($query,$values)->row_array();
	}
	public function add_quote($post){
		$query =
			 "INSERT INTO quotes (user_id, speaker, quote, created_at, modified_at) VALUES(?,?,?, NOW(),NOW());";
	 	$values = [$post['active_id'],$post['speaker'],$post['quote']];
		$this->db->query($query,$values);
	}
	public function show_non_favorites($active_id){
		$query =
			"SELECT quotes.id as quote_id, users.id as poster_id, users.alias as alias, speaker, quote from quotes
			LEFT JOIN users ON users.id = quotes.user_id
			LEFT JOIN favorites on favorites.quote_id = quotes.id
			WHERE NOT quotes.id in
			(SELECT quotes.id from quotes
				WHERE favorites.user_id = ? )";
		$values = [$active_id];
		return $this->db->query($query,$active_id)->result_array();
	}
	public function show_favorites($active_id){
		$query =
			"SELECT quotes.id as quote_id, users.id as poster_id, users.alias as alias, speaker, quote from quotes
			LEFT JOIN users ON users.id = quotes.user_id
			LEFT JOIN favorites on favorites.quote_id = quotes.id
			WHERE favorites.user_id = ? ;";
		$values = [$active_id];
		return $this->db->query($query,$values)->result_array();
	}
	public function add_favorite($active_id,$quote_id){
		$query =
		"INSERT INTO favorites (user_id, quote_id) VALUES (?,?)";
	$values = [$active_id,$quote_id];
	$this->db->query($query,$values);
	}
	public function remove_favorite($active_id,$quote_id){
		$query =
			"DELETE FROM favorites WHERE user_id = ? AND quote_id =?";
		$values = [$active_id,$quote_id];
		$this->db->query($query,$values);
	}
	public function show_all_quotes_user($id){
		$query =
			"SELECT users.alias as alias, speaker, quote from quotes
			LEFT JOIN users ON users.id = quotes.user_id
			WHERE users.id = ?";
		$values = [$id];
		return $this->db->query($query,$values)->result_array();
	}
}
