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
			"SELECT quotes.id as quote_id, quotes.users_id, favorites. id as favorite_id, users.alias as alias, speaker, quote, quotes.created_at  from quotes
			LEFT JOIN users ON users.id = quotes.users_id
			LEFT JOIN favorites on favorites.quotes_id = quotes.id";
		$favorites = $this->show_favorites($active_id);
		$non_favorites = array();
		$all_quotes =  $this->db->query($query)->result_array();
		foreach ($all_quotes as $quote) {

			for ($i=0; $i < count($all_quotes); $i++) {
				$not_found=true;
				if ($quote['favorite_id'] == $favorites['favorite_id']) {
					$not_found=false;
				}
				if ($not_found) {
					$not_favorite[] = $quote;
				}
			}
			// var_dump($non_favorites);
			// die();
			return $non_favorites;
		}
	}


	public function show_favorites($active_id){
		$query =
			"SELECT quotes.id as quote_id, quotes.users_id, favorites. id as favorite_id, users.alias as alias, speaker, quote, quotes.created_at  from quotes
			LEFT JOIN users ON users.id = quotes.users_id
			LEFT JOIN favorites on favorites.quotes_id = quotes.id
			WHERE favorites.users_id = ? ;";
		$values = [$active_id];
		return $this->db->query($query,$values)->result_array();
	}
}
