<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class first_model extends CI_Model {

	function __construct() {
		parent::__construct();
		$this -> site_url = $this -> config -> item('site_url');

	}

	/**
	 * get started by sending email confirmation to the user email
	 * @param $email, $code
	 * @return success = 1/ failure = 0
	 */
	function get_started($email, $code) {
		$this -> db -> trans_start();

		$this -> db -> insert('email', array('email' => $email, 'code' => $code));

		$user_id = $this -> db -> insert_id();

		$this -> db -> trans_complete();

		if ($st = $this -> db -> trans_status()) {
			send_email_phpmailer($email, $code);
		}

		return $st;
	}

	/**
	 * verify an email address of a user
	 * @param $email, $code
	 * @return success = 1/ failure = 0
	 */
	function verify($email, $code) {
		$this -> db -> update('email', array('verified' => 1), array('email' => $email, 'code' => $code, 'verified' => 0));
		return $this -> db -> affected_rows();
	}
	
	/**
	 * unpublish an article by in-activating it
	 * @param $data
	 * @return success = 1/ failure = 0
	 */
	function unpublish($data) {
		if(! isset($data)) 
			return -1;
		
		$this -> db -> update('article', array('Active' => 0), $data);
		return $this -> db -> affected_rows();
	}
	
	/**
	 * complete registering a user
	 * @param $data
	 * @return success = 1/ failure = 0
	 */
	function complete_registration($data) {
		return isset($data)? $this -> db -> insert('user', $data) : -1;
	} 
	
	/**
	 * publish an article
	 * @param $data
	 * @return success = 1/ failure = 0
	 */
	function publish_article($data) {
		if(isset($data)) 
			return $this -> db -> insert('article', $data);
		else
			return -1;
	}
	
	/**
	 * check if logins are correct
	 * @param $email, $password
	 * @return true/false
	 */
	function check_logins($email, $password) {
		$query = $this -> db -> query("select * from user where email = '" . $email . "';");

		if ($query -> num_rows() > 0) 
		{

			$user = $query -> row();

			if (password_verify($password, $user -> password)) {
				$this -> session -> set_userdata('email', $email);
				//$this -> session -> set_userdata('password', $password);
				return true;
			} else {
				return false;
			}
		} else {
			return false;
		}

		return false;
	}

	/**
	 * get single article
	 * @param $id
	 * @return 1 row of article
	 */
	function article($id) 
	{
		$query = $this -> db -> query("select * from article where Active = 1 and ID = " . $id . ";");
		if ($query -> num_rows() > 0) {
			return $query -> row();
		} else {
			return NULL;
		}
	}

	/**
	 * get latest 10 articles
	 * @param none
	 * @return array of article
	 */
	function get_latest_articles() {
		$this->db->select('*');
		$this->db->from('article');
		$this->db->where('Active', 1);
		$this->db->order_by('CreatedAt', 'desc');
		$this->db->limit('10');
		$query = $this->db->get();
		return $query -> result_array();
	}
}
