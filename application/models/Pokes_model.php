<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Pokes_model extends CI_Model {
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
	public function add($info){
		$query =
			 "INSERT INTO users (name, alias, email, password, dob created_at, modified_at)  VALUES (?,?,?,?,?,NOW(),NOW())";
		return $this->db->query($query,$info);
	}
	public function show_poke($pokee,$poker){
		$query =
			"SELECT count  FROM pokes
			WHERE pokee_id = ? AND poker_id = ?;";
		$values = [$pokee, $poker];
		return $this->db->query($query,$values)->row_array();
	}
	public function add_poke($pokee,$poker){
		$pokes = $this->show_poke($pokee,$poker);
		if ($pokes==null) {
			$query =
				"INSERT into pokes (poker_id, pokee_id, count, created_at, modified_at) values(?,?,?,NOW(),NOW());";
			$values = [$poker,$pokee,1];
			$this->db->query($query,$values);
		}
		else {
			$count = $pokes['count'];
			$count++;
			$query =
				"UPDATE pokes SET count=? WHERE pokee_id =? AND poker_id=?;";
			$values = [$count,$pokee,$poker];
			$this->db->query($query,$values);
		}
	}
	public function show_pokes_by_id($pokee){
		$query =
		 	"SELECT poker_id, r.name as poker_name, pokee_id, e.name as pokee_name, count from pokes
			left join users r on r.id = pokes.poker_id
			left join users e on e.id = pokes.pokee_id
			WHERE pokee_id =?";
		$values = [$pokee];
		return $this->db->query($query,$values)->result_array();
	}
	public function show_poke_count_by_id($pokee){
		$query =
			"SELECT SUM(count) as pokes_recieved, pokee_id FROM pokes
			WHERE pokee_id = ?;";
			$values = [$pokee];
			return $this->db->query($query,$values)->row_array();
	}
}
