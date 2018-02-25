<?php
class Standards {
	// *****************************  LOCAL DATABASE ACCESS   *************************************************
		/* NOTES
		you added a password in 
		C:\wamp\apps\phpmyadmin3.4.5\config.inc.php*/
		// REMOTE REAL DATABASE
		protected $host = 'localhost'; // within phpmyadmin, user must have "localhost" as the Host Name
		protected $host_user = 'cryptokl_user2';
		protected $host_pw = 'F%hd&F36*cnhJt';
		protected $database = 'cryptokl_main';


		protected $required = array();
		protected $tableColumns = array();
		protected $limit = 0;
		protected $length = 30;

		// API Connection information.
		protected $api_key = '';
		protected $device = 'browser';
		protected $api_url = 'http://api.cryptoklout.com/';

	//=======================
		/* The function __construct is run automatically any time a class is instantiated. */
		// you removed the two parameters here because it was required that every function have a parameter, which is not what we wanted in AT
		public function __construct(){ 
			/*
				This piece determines whether the database connection should
				be the settings to your localhost or the remote server
			*/
			$addr = $_SERVER['HTTP_HOST'];
			$local = preg_match('/localhost/', $addr); // if it finds a match of localhost in the $addr, it will return 1. 
			if($local == TRUE){
				$this->api_url = 'http://localhost.api.cryptoklout.com';
			}
			// you deleted the sanitize function here. 
			return TRUE;
		}


	//=======================

	/*
		This funciton cleans up what could be dangerous data
	*/
	protected function sanitize($data){
		// $data is a keyed array such as array('name' => 'Joe', 'email' => 'joe@smith.com')

		// Connect to the MySQL server to use it's tools
		$mysqli = new mysqli($this->host, $this->host_user, $this->host_pw, $this->database);

		// Use the real_escape_string function to protect from query injection
		foreach($data as $key => &$val){
			if(!is_array($val)){
				$val = $mysqli->real_escape_string(trim($val));
			}
		}

		return $data;
	}
	//=======================

	/*
		This function performs several actions an SQL query might need to do
	*/
	protected function query($sql, $return = TRUE){
		/*
			$sql is a string of the exact query a different function wants
			this function to run.

			$return is used to tell what kind of data this function needs to return
			such as the identification number of the last-inserted row
			or a keyed array of many rows.
		*/

		// Instantiate the MySQLi class and connect to the database
		$mysqli = new mysqli($this->host, $this->host_user, $this->host_pw, $this->database);

		// Query the database with $sql
		$query = $mysqli->query($sql);

		// What should this function return?
		switch($return){
			case 'id':
				$list = $mysqli->insert_id;
				break;
			case 'fetch':
				$list = array();
				if($query){
					while($pull = $query->fetch_assoc()){
						$list[] = $pull;
					}
				}
				break;
			default:
				$list = TRUE;
				break;
		}

		$mysqli->close();

		return $list;
	}

	//=========================

	/*
		This function checks to make sure all fields
		marked as required in their function are filled in.
	*/
	public function requiredFields(){
		$errors = array();

		if(!empty($this->required))
			foreach($this->required as $key => $val)
				if(trim($this->$key) == '')
					$errors[] = $val;

		return $errors;
	}

	//=========================

	protected function verifyUserByID($userID, $password){
		$sql = "SELECT password, salt FROM users "
			. "WHERE userID=" . $userID;
		$user = $this->query($sql, 'fetch');

		$encrypt_pw = sha1($password . $user[0]['salt']);

		if($encrypt_pw == $user[0]['password'])
			return TRUE;
		else
			return FALSE;
	}

	//=========================
	// Used to transfer data to the API area.
	protected function exchangeData($data){
		$data['api_key'] = $this->api_key;
		$data['device'] = $this->device;

		$data_string = '';

		foreach($data as $key => &$val){
			if(is_array($val)){
				$val = base64_encode(serialize($val));
			}
			//$data_string  .= $key . '=' . $val . '&';
			 // is this trying to create its own url? is that how it talks to the other side?
			// this does not work well, because if $val is an array, it causes problems and mass confusion as far as encoding / decoding in other parts. 
			// anyway around this as far as assuming $val is a string? or making $val a string automatically?
			// can we serialize() and unserialize() here if $val is an array?
		}
		//$data_string = http_build_query($data);
		//$data_string = substr($data_string, 0, -1); // this would get rid of the last character on the string, which in this case is the &
		$data_string = http_build_query($data);
		$curl = curl_init();

		curl_setopt($curl, CURLOPT_URL, $this->api_url . '/' . $data['category'] . '/?' . $data_string);
		curl_setopt($curl, CURLOPT_FOLLOWLOCATION, TRUE);
		curl_setopt($curl, CURLOPT_CUSTOMREQUEST, "POST");
		curl_setopt($curl, CURLOPT_POST, count($data));
		curl_setopt($curl, CURLOPT_POSTFIELDS, $data_string);
		//curl_setopt($curl, CURLOPT_POSTREDIR, 3);
		curl_setopt($curl, CURLOPT_RETURNTRANSFER, TRUE);

		$result = curl_exec($curl);
		//print_r($result);
		curl_close($curl);
		//var_dump($result);

		$json = json_decode($result, TRUE);
		$result['dataquery'] = $data_string;
		//if(!isset($json['errors'])){
		if(!is_array($json)){
			$json['errors'] = (string)$result;
			/*
			if($result && is_array($result)){
			   $result = nl2br(json_encode($result));
			}
			*/
			//crowe.will@gmail.com
			$to = 'robbie@robbievasquez.com, williamhowley@gmail.com';
			$headers = "From: dont-reply@cryptoklout.com <<dont-reply@cryptoklout.com>> \r\n";
			$headers .= 'MIME-Version: 1.0' . "\r\n";
			$headers .= 'Content-Type: text/html; charset=ISO-8859-1' . "\r\n";
			$subject = "Error returned";
			$message = '<h1>A PHP error was returned</h1>';
			$message .= '<h2>DATA</h2>' . json_encode($data);
			$message .= '<h2>Result</h2>' . json_encode($json);
			$message .= '<h2>Server</h2>' . nl2br(json_encode($_SERVER));
			mail($to, $subject, $message, $headers);
		}
		return $json;
	}

	//=========================

	public function setcookies($cookies){
		foreach($cookies as $cookie){
			setcookie($cookie['name'], $cookie['value'], (int)$cookie['expires'], $cookie['path']);
		}

		return TRUE;
	}

	//=========================

	public function setSessions($sessions){
		if(!isset($_SESSION)){
			session_start();
		}

		foreach($sessions as $key => $val)
			$_SESSION[$key] = $val;

		return TRUE;
	}

	//=========================
}
/* EOF */