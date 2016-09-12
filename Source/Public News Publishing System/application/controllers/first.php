<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class first extends CI_Controller {

	function __construct() {
		parent::__construct();
		$this -> load -> helper('url');
		$this -> load -> library('My_PHPMailer');
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
	 * @see https://codeigniter.com/user_guide/general/urls.html
	 */
	public function index() {
		$this -> login();
	}

	/**
	 * generic function to load any view not defined in this controller nor in routes
	 * @param none
	 * @return none.
	 */
	public function more($i) {
		$this -> load -> view($i . '_view');
	}

	/**
	 * rss feed service so that users can subscripe to receive new articles updates
	 * @param none
	 * @return none.
	 */
	function rss() {
		//$this -> load -> view('rss_view');
		$this -> feed();
	}

	/**
	 * rss feed service so that users can subscripe to receive new articles updates
	 * @param none
	 * @return none.
	 */
	function feed() {
		$this -> load -> helper('xml');
		$this -> load -> helper('text');

		$data['feed_name'] = 'Public News Publishing System';
		// your website
		$data['encoding'] = 'utf-8';
		// the encoding
		$data['feed_url'] = 'http://' . base_url() . '/feed';
		// the url to your feed
		$data['page_description'] = 'RSS Feeds For Public News Publishing System';
		// some description
		$data['page_language'] = 'en-en';
		// the language
		$data['creator_email'] = 'nagar@aucegypt.edu';
		// my email
		$data['posts'] = $this -> first_model -> get_latest_articles();
		header("Content-Type: application/rss+xml");
		// important!

		$this -> load -> view('rss_view', $data);
	}

	/**
	 * starting point for user to register
	 * @param none
	 * @return none.
	 */
	function get_started() {

		$this -> form_validation -> set_rules('email', 'Personal Email', array('required', 'valid_email', 'trim', 'min_length[5]', 'max_length[88]', 'is_unique[email.email]', 'callback_email_check'), array('is_unique' => 'This %s already exists.', 'email_check' => 'Error Message for this email: You can\'t use that email as it reserved.'));

		//$this->form_validation->set_message('required', 'A required field {field} is missing.');

		if ($this -> form_validation -> run() == FALSE) {
			$this -> load -> view('get_started_view');
		} else {
			$email = $this -> input -> post('email');
			$code = random_string(31);
			$data['results'] = $this -> first_model -> get_started($email, $code);
			$data['message'] = 'We have sent you a confirmation email. Please check your inbox or junk folder.';
			//redirect(current_url());
			$this -> load -> view('done_view', $data);

		}
	}

	/**
	 * verify email address
	 * @param none
	 * @return none.
	 */
	public function verify($email, $code) {
		$data['email'] = $email;
		$data['code'] = $code;

		if ($this -> first_model -> verify($email, $code)) {
			$this -> load -> view('verify_view', $data);
		} else {
			$data['message'] = 'Database Error.';
			$this -> load -> view('error_view', $data);
		}

	}

	/**
	 * logout user by clearing session data
	 * @param none
	 * @return none.
	 */
	public function logout() {
		$this -> session -> unset_userdata('email');
		$this -> load -> view('get_started_view');
	}

	/**
	 * complete user registration
	 * @param none
	 * @return none.
	 */
	public function complete_registration() {
		$this -> form_validation -> set_rules('fname', 'First Name', 'required|min_length[3]|trim|alpha');
		$this -> form_validation -> set_rules('lname', 'Last Name', 'required|min_length[3]|trim|alpha');
		$this -> form_validation -> set_rules('password', 'Password', 'required|min_length[6]', array('required' => 'You must provide a %s.'));
		$this -> form_validation -> set_rules('passconf', 'Password Confirmation', 'required|min_length[6]');
		$this -> form_validation -> set_rules('email', 'Personal Email', array('required', 'valid_email', 'trim', 'min_length[5]', 'max_length[88]', 'is_unique[user.email]', 'callback_email_check'), array('is_unique' => 'This %s already exists.', 'email_check' => 'Error Message for this email: You can\'t use that email as it reserved.'));
		//$this->form_validation->set_message('required', 'A required field {field} is missing.');

		if ($this -> form_validation -> run() == FALSE) {
			//redirect("verify/ahmsayat@gmail.com/dlIsbDZqriCxeRKcY5JAPML4TaoFGHh");
			$data['email'] = $this -> input -> post('email');
			$this -> load -> view('verify_view', $data);
		} else {
			$json = file_get_contents('http://ip-api.com/json');
			$json = json_decode($json, true);
			$country = $json['country'];

			$options = array('cost' => 12, 'salt' => mcrypt_create_iv(31, MCRYPT_DEV_URANDOM), );
			$password = password_hash($this -> input -> post('password'), PASSWORD_DEFAULT, $options);

			$data = array('username' => $this -> input -> post('email'), 'country' => $country, 'first_name' => $this -> input -> post('fname'), 'last_name' => $this -> input -> post('lname'), 'password' => $password, 'email' => $this -> input -> post('email'));

			if ($this -> first_model -> complete_registration($data)) {
				$data['message'] = 'Congratulations, you registration is completed successfully. You can login now.';
				$this -> load -> view('done_view', $data);
			} else {
				$data['message'] = 'Unable to register in database.';
				$this -> load -> view('error_view', $data);
			}
		}
	}

	/**
	 * Retrieve password by sending email [Future Task]
	 * @param none
	 * @return none.
	 */
	public function retrieve_password() {
		/*
		 $this -> form_validation -> set_rules('email', 'Personal Email', array('required', 'valid_email', 'trim', 'min_length[5]', 'max_length[88]'));

		 if ($this -> form_validation -> run() == FALSE) {
		 $this -> load -> view('reset_password_view');
		 } else {
		 $email = $this -> input -> post('email');
		 $code = random_string(31);
		 $data['results'] = $this -> first_model -> get_started($email, $code);
		 $data['message'] = 'We have sent you a confirmation email. Please check your inbox or junk folder.';
		 //redirect(current_url());

		 send_reset_password_email($email, $code);

		 $this -> load -> view('done_view', $data);

		 } */
	}

	/**
	 * Change password [Future Task]
	 * @param none
	 * @return none.
	 */
	function change_password() {
		/*
		 //$this -> form_validation -> set_rules('fname', 'First Name', 'required|min_length[3]|trim|alpha');
		 //$this -> form_validation -> set_rules('lname', 'Last Name', 'required|min_length[3]|trim|alpha');
		 $this -> form_validation -> set_rules('password', 'Password', 'required|min_length[6]', array('required' => 'You must provide a %s.'));
		 $this -> form_validation -> set_rules('passconf', 'Password Confirmation', 'required|min_length[6]');
		 $this -> form_validation -> set_rules('email', 'Personal Email', array('required', 'valid_email', 'trim', 'min_length[5]', 'max_length[88]', 'is_unique[user.email]', 'callback_email_check'), array('is_unique' => 'This %s already exists.', 'email_check' => 'Error Message for this email: You can\'t use that email as it reserved.'));
		 //$this->form_validation->set_message('required', 'A required field {field} is missing.');

		 if ($this -> form_validation -> run() == FALSE) {
		 //redirect("verify/ahmsayat@gmail.com/dlIsbDZqriCxeRKcY5JAPML4TaoFGHh");
		 $data['email'] = $this -> input -> post('email');
		 $this -> load -> view('verify_view', $data);
		 } else {
		 $json = file_get_contents('http://ip-api.com/json');
		 $json = json_decode($json, true);
		 $country = $json['country'];

		 $options = array('cost' => 12, 'salt' => mcrypt_create_iv(31, MCRYPT_DEV_URANDOM), );
		 $password = password_hash($this -> input -> post('password'), PASSWORD_DEFAULT, $options);

		 $data = array('username' => $this -> input -> post('email'), 'country' => $country, 'first_name' => $this -> input -> post('fname'), 'last_name' => $this -> input -> post('lname'), 'password' => $password, 'email' => $this -> input -> post('email'));

		 if ($this -> first_model -> complete_registration($data)) {
		 $data['message'] = 'Congratulations, you registration is completed successfully. You can login now.';
		 $this -> load -> view('done_view', $data);
		 } else {
		 $data['message'] = 'Unable to register in database.';
		 $this -> load -> view('error_view', $data);
		 }
		 }*/
	}

	/**
	 * check if user can log in successfully
	 * @param none
	 * @return none.
	 */
	function check_logins() {
		$this -> form_validation -> set_rules('lemail', 'Personal Email', array('required', 'valid_email', 'trim', 'min_length[5]', 'max_length[88]'), array('valid_email' => 'This %s is not a valid email address.'));
		$this -> form_validation -> set_rules('lpassword', 'Password', 'required|min_length[6]', array('required' => 'You must provide a %s.'));

		if ($this -> form_validation -> run() == FALSE) {
			$data['message'] = 'Failed Validations: ' . validation_errors();
			$this -> load -> view('error_view', $data);
		} else {
			$email = $this -> input -> post('lemail');
			$password = $this -> input -> post('lpassword');

			if ($this -> first_model -> check_logins($email, $password)) {
				//redirect('report_news');
				$this -> load -> view('report_news_view');
				//$this->g->update_cart_cookie();
			} else {
				$data['message'] = 'Wrong logins. No matching credentials found in database.';
				$this -> load -> view('error_view', $data);
			}
		}

	}

	/**
	 * login automatically if user session is still valid and redirect him to publish view
	 * @param none
	 * @return none.
	 */
	public function login() {
		if (!$this -> session -> userdata('email')) {
			$this -> load -> view('get_started_view');
		} else {
			$this -> load -> view('report_news_view');
		}
	}

	/**
	 * testing pdf library
	 * @param none
	 * @return none.
	 */
	public function export() {

		//Create a new my_pdf_lib instance
		$pdf = new my_pdf_lib();
		$data['link'] = 'localhost';
		$message = $this -> load -> view('pdf_view', $data, TRUE);
		$pdf -> export_html($message);
		//$this -> load -> view('success_view');
	}

	/**
	 * load a specific article as pdf and view it
	 * @param $article_id
	 * @return none.
	 */
	public function pdf($id) {
		if ($data = $this -> first_model -> article($id)) {
			$message = $this -> load -> view('pdf_view', $data);
		} else {
			$data['message'] = 'No Article Found.';
			$this -> load -> view('error_view', $data);
		}
	}

	/**
	 * download a specific article as pdf
	 * @param $article_id
	 * @return none.
	 */
	public function download_as_pdf($article_id) {
		$pdf = new my_pdf_lib();
		$message = file_get_contents(base_url() . "/pdf/" . $article_id, true);
		$pdf -> export_html($message, $article_id);
	}

	/**
	 * load report news view
	 * @param none
	 * @return none.
	 */
	public function report_news() {
		if (!$this -> session -> userdata('email')) {
			redirect('login');
			// the user is not logged in, redirect them!
		} else {
			$this -> load -> view('report_news_view');
		}
	}

	/**
	 * load read news view
	 * @param none
	 * @return none.
	 */
	public function read_news() {
		$this -> load -> view('read_news_view');
	}

	/**
	 * publish an article to the website from the data read from the form
	 * @param none
	 * @return none.
	 */
	public function publish() {
		if (!$this -> session -> userdata('email')) {
			redirect('login');
			// the user is not logged in, redirect them!
		} else {
			$this -> form_validation -> set_rules('title', 'Title', 'required|min_length[3]|trim');
			$this -> form_validation -> set_rules('photo', 'photo url', 'required|min_length[3]|trim|callback_is_image_url', array('is_image_url' => 'Please provide a valid Image URL'));
			$this -> form_validation -> set_rules('text', 'news text', 'required|min_length[10]');

			if ($this -> form_validation -> run() == FALSE) {
				$this -> load -> view('report_news_view');
			} else {
				$data = array('title' => $this -> input -> post('title'), 'photo' => $this -> input -> post('photo'), 'text' => $this -> input -> post('text'), 'author_email' => $this -> session -> userdata('email'));

				if ($this -> first_model -> publish_article($data)) {

					$data['message'] = 'Congratulations, You published a new News Article successfully.';
					$this -> load -> view('done_view', $data);
				} else {
					$data['message'] = 'Database error.';
					$this -> load -> view('error_view', $data);
				}
			}
		}
	}

	/**
	 * unpublish an article by in-activating it
	 * @param id
	 * @return none.
	 */
	public function unpublish($id) {
		if (!$this -> session -> userdata('email')) {
			$data['message'] = 'Please signin first.';
			$this -> load -> view('error_view', $data);
		} else {
			$data['id'] = $id;
			$data['author_email'] = $this -> session -> userdata('email');
			$data['Active'] = 1;
			if ($this -> first_model -> unpublish($data)) {
				$this -> load -> view('done_view', $data);
			} else {
				$data['message'] = 'Database Error.';
				$this -> load -> view('error_view', $data);
			}
		}
	}

	/**
	 * load reset user password view
	 * @param none
	 * @return none.
	 */
	public function reset() {
		//unset($data);
		$this -> load -> view('reset_password_view');
	}

	/**
	 * testing sending email using phpmailer library
	 * @param none
	 * @return none.
	 */
	public function send_mail() {
		send_email_phpmailer();
	}

	/**
	 * load generic operation_done view
	 * @param none
	 * @return none.
	 */
	public function done() {
		$this -> load -> view('done_view');
	}

	/**
	 * load generic success view
	 * @param none
	 * @return none.
	 */
	public function success() {
		$this -> load -> view('success_view');
	}

	/**
	 * load a generic error view
	 * @param none
	 * @return none.
	 */
	public function error() {
		$this -> load -> view('error_view');
	}

	/**
	 * load a single article view or error if not found
	 * @param id
	 * @return none.
	 */
	public function article($id) {

		if ($data = $this -> first_model -> article($id)) {
			$this -> load -> view('article_view', $data);
		} else {
			$data['message'] = 'No Article Found.';
			$this -> load -> view('error_view', $data);
		}
	}

	/**
	 * load newsstand view
	 * @param none
	 * @return none.
	 */
	public function newsstand() {
		$this -> load -> view('newsstand_view');
	}

	/**
	 * get all active articles
	 * @param none
	 * @return none. It echo json
	 */
	function get_articles() {
		echo json_encode($this -> db -> select('*') -> where(array('Active' => 1)) -> get("article") -> result_array());
	}

	/**
	 * get the latest articles up to 10 articles
	 * @param none
	 * @return none. It echo json
	 */
	function get_latest_articles() {
		$data = $this -> first_model -> get_latest_articles();
		print(json_encode($data));
	}

	/**
	 * testing using callback validations functions
	 * @param str
	 * @return TRUE/FALSE
	 */
	public function email_check($str) {
		if ($str == 'a@a.a') {
			$this -> form_validation -> set_message('username_check', 'The {field} field can not be the word "test"');
			return FALSE;
		} else {
			return TRUE;
		}
	}

	/**
	 * check if the url is an image url
	 * @param url
	 * @return TRUE/FALSE
	 */
	public function is_image_url($url) {
		if ($url) {
			if (@getimagesize($url))
				return TRUE;
			else
				return FALSE;
		} else {
			return FALSE;
		}
	}

	/**
	 * run my unit testing by visiting /test
	 * @param none
	 * @return none. It prints a table with results
	 */
	function run_unit_testing() {
		$this -> load -> library('unit_test');
		
		//Unit Testing Controller Functions:
		/**
		 * testing using callback validations functions
		 * @param str
		 * @return TRUE/FALSE
		 * email_check($str)
		 */
		$this -> unit -> run($this -> email_check('a@a.a'), 'is_false', 'email_check_false');

		$this -> unit -> run($this -> email_check('ahmed@gmail.com'), 'is_true', 'email_check_true');

		$this -> unit -> run($this -> email_check('anytext'), 'is_bool', 'email_check_bool');

		/**
		 * check if the url is an image url
		 * @param url
		 * @return TRUE/FALSE
		 * public function is_image_url($url)
		 */

		$this -> unit -> run($this -> is_image_url('www.google.com'), 'is_false', 'is_image_url_false');

		$this -> unit -> run($this -> is_image_url('http://www.hdfbcover.com/randomcovers/covers/Love-written-on-water-melon-facebook-cover.jpg'), 'is_bool', 'is_image_url_true');

		// Unit Testing Model Functions:

		/**
		 * get started by sending email confirmation to the user email
		 * @param $email, $code
		 * @return success = 1/ failure = 0
		 * function get_started($email, $code)
		 */
		$this -> unit -> run($this -> first_model -> get_started('email', 'code'), 'is_bool', 'get_started');

		/**
		 * verify an email address of a user
		 * @param $email, $code
		 * @return success = 1/ failure = 0
		 * function verify($email, $code)
		 */
		$this -> unit -> run($this -> first_model -> verify('email', 'pass'), 'is_int', 'verify');

		/**
		 * unpublish an article by in-activating it
		 * @param $data
		 * @return success = 1/ failure = 0
		 * function unpublish($data)
		 */
		$this -> unit -> run($this -> first_model -> unpublish(NULL), 'is_int', 'unpublish');

		/**
		 * complete registering a user
		 * @param $data
		 * @return success = 1/ failure = 0
		 * function complete_registration($data)
		 */
		$this -> unit -> run($this -> first_model -> complete_registration(NULL), 'is_int', 'complete_registration');

		/**
		 * publish an article
		 * @param $data
		 * @return success = 1/ failure = 0
		 * function publish_article($data)
		 */
		$this -> unit -> run($this -> first_model -> publish_article(NULL), 'is_int', 'publish_article');

		/**
		 * check if logins are correct
		 * @param $email, $password
		 * @return true/false
		 * function check_logins($email, $password)
		 */
		$this -> unit -> run($this -> first_model -> check_logins("email", "pass"), 'is_bool', 'check_logins');

		/**
		 * get single article
		 * @param $id
		 * @return 1 row of article
		 * function article($id)
		 */
		$this -> unit -> run($this -> first_model -> article(-1), 'is_null', "article");

		/**
		 * get latest 10 articles
		 * @param none
		 * @return array of article
		 * function get_latest_articles()
		 */
		$this -> unit -> run($this -> first_model -> get_latest_articles(), 'is_array', "get_latest_articles");

		//Finally Print Full Report
		echo $this -> unit -> report();
	}

}
