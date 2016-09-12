<?php

/**
 * genrate random string with specific length
 *
 * @param int $length the length of the wanted string
 * @return string  the random string
 */
function random_string($length = 31) 
{
	$characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
	return substr(str_shuffle($characters), 0, $length);
}

function send_email_codeigniter() {
	$this -> email -> clear();
	//$config = Array('protocol' => 'smtp', 'smtp_host' => 'ssl://smtp.googlemail.com', 'smtp_port' => 465, 'smtp_user' => 'ahmed@elfkr.com	', 'smtp_pass' => '', 'mailtype' => 'html', 'charset' => 'iso-8859-1');
	//get_instance() -> load -> library('email');
	get_instance() -> email -> set_newline("\r\n");
	get_instance() -> email -> from('mygmail@gmail.com', 'myname');
	get_instance() -> email -> to('ahmsayat@gmail.com');
	//{unwrap} link {/unwrap}
	get_instance() -> email -> subject('Email Test');
	get_instance() -> email -> message('Testing the email class.');
	//$this -> email -> message('email/report', $data, 'true');
	// Set to, from, message, etc.
	$result =  get_instance() -> email -> send();
}

function send_email_phpmailer($to = 'ahmsayat@gmail.com', $code) 
{
	//Create a new PHPMailer instance
	$mail = new PHPMailer();

	$data['link'] = '/verify/' . $to . '/' . $code;

	$message = get_instance() -> load -> view('email_view', $data, TRUE);
	
	$mail -> setFrom('no-reply@gmail.com', 'Public News Publishing System');

	$mail -> addReplyTo('no-reply@gmail.com', 'Ahmed Moussa');

	$mail -> addAddress($to, "New User");
	
	$mail->IsHTML(true);
	
	$mail -> Subject = 'Confirm Your Email';

	$mail -> msgHTML($message);
	
	//$mail -> Body = $message;

	$mail -> AltBody = 'To view the message, please use an HTML compatible email viewer!';

	//$mail->AddAttachment("images/phpmailer.gif");      // some attached files

	if ( ! $mail -> Send() ) 
	{
		$data["message"] = "Error: " . $mail -> ErrorInfo;
		//get_instance() -> load -> view('error_view', $data);
	} 
	else 
	{
		$data["message"] = "Message sent correctly at " . date("Y-m-d H:i:s");
		//get_instance() -> load -> view('done_view', $data);
	}
}


function send_reset_password_email($to = 'ahmsayat@gmail.com', $code) 
{
	//Create a new PHPMailer instance
	$mail = new PHPMailer();

	$data['link'] = '/change_password/' . $to . '/' . $code;

	$message = get_instance() -> load -> view('email_view', $data, TRUE);
	
	$mail -> setFrom('no-reply@gmail.com', 'Public News Publishing System');

	$mail -> addReplyTo('no-reply@gmail.com', 'Ahmed Moussa');

	$mail -> addAddress($to, "New User");
	
	$mail->IsHTML(true);
	
	$mail -> Subject = 'Reset Your Password';

	$mail -> msgHTML($message);
	
	//$mail -> Body = $message;

	$mail -> AltBody = 'To view the message, please use an HTML compatible email viewer!';

	//$mail->AddAttachment("images/phpmailer.gif");      // some attached files

	if ( ! $mail -> Send() ) 
	{
		$data["message"] = "Error: " . $mail -> ErrorInfo;
		//get_instance() -> load -> view('error_view', $data);
	} 
	else 
	{
		$data["message"] = "Message sent correctly at " . date("Y-m-d H:i:s");
		//get_instance() -> load -> view('done_view', $data);
	}
}

/**
 * send emails
 * @param string|array $to the array of emails, or seprate them by (,)
 * @param string $title the email title
 * @param string $message the text/plain message
 * @return void send the email
 */
function email($to, $title, $message) {
	$CI = &get_instance();
	$headers = 'MIME-Version: 1.0' . "\r\n";
	$headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
	$headers .= 'From: Elfkr support system <no-reply@domain.com>' . "\r\n";
	if ($CI -> input -> server('HTTP_HOST') != 'localhost')
		foreach (is_array($to)?$to : explode(',' ,$to ) as $email)
			mail($email, $title, $message, $headers);
}

/**
 * send verification email message to given email (to verify it)
 * @param string $to email
 * @param string $code the verification code
 * @return void send the email
 */
function send_verification_email($to, $code) {
	$data['code'] = $code;
	$message =   get_instance() -> load -> view('emails/verify_email', $data, TRUE);
	email($to, message('account_verify_email'), $message);
}

/**
 * get first letters from the given name and replace the other with *
 * @param string $name the name that you want to hide it's letters
 * @param ing $length the allowd length to show
 * @param int $repeat the number of starts to pad
 * @return string the hidden name
 * @example first_letters(google) will return go******
 */
function first_letters($name, $length = 2, $repeat = 6) {
	return substr($name, 0, $length) . str_repeat('*', $repeat);
}

/**
 * check if the given name exist in $_FILES array and if it allowed to uploaded
 * @param string $name the name of the file we want to uplaoad
 * @return boot is exist file
 */
function exist_file($name) {
	return isset($_FILES[$name]['tmp_name']) && file_exists($_FILES[$name]['tmp_name']) && is_uploaded_file($_FILES[$name]['tmp_name']);
}

/**
 * check if the server is localhost server
 * @return bool is localhost
 */
function is_localhost() {
	return   get_instance() -> input -> server('HTTP_HOST') == 'localhost';
}

/**
 * Check if the string starts with other string
 * @param string $haystack The short string
 * @param string $needle The long string
 * @return bool
 */
function starts_with($haystack, $needle) {
	return $needle === "" || strrpos($haystack, $needle, -strlen($haystack)) !== false;
}

/**
 * Check if the string ending with other string
 * @param string $haystack The short string
 * @param string $needle The long string
 * @return bool
 */
function ends_with($haystack, $needle) {
	return $needle === "" || (($temp = strlen($haystack) - strlen($needle)) >= 0 && strpos($haystack, $needle, $temp) !== false);
}

/**
 * hash the password, and to compare the hashed with the unhashed use password_verify
 *
 * @param string $password the unhashed password, that enterd by the user
 * @return string  the hashed password
 */
function password_hash2($password) {
	$options = array('cost' => 12, 'salt' => mcrypt_create_iv(31, MCRYPT_DEV_URANDOM), );
	return password_hash($password, PASSWORD_DEFAULT, $options);
}

/**
 * check if the image exist on the server in uploads directory, this fucntion check the origin directory
 * @param string $folder the directory after uploads
 * @param string $image the image name
 * @return bool is exist image
 */
function exist_image($folder, $image, $size = 'origin') {
	is_numeric($size) && $size = 'size-' . $size;
	return file_exists('uploads/' . $folder . '/' . $size . '/' . $image);
}
