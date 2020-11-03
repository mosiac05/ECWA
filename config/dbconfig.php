<?php
session_start();

class DBConfig {
	public $connection;

	public function __construct(){
		$this->dbConnect();
	}

	public function dbConnect() {
		$this->connection = mysqli_connect('localhost', 'root', '', 'ecwa');

		if(mysqli_connect_error()){
			die("Connect failed");
		}
	}


	public function makeQuery($query) {
		$result = mysqli_query($this->connection, $query);
		return $result;
	}


	public function checkData($data) {
		$result = mysqli_real_escape_string($this->connection, $data);
		return $result;
	}


	public function getUserEmail() {
		$user_email = $_SESSION['user_email'];
		return $user_email;
	}

	public function getUserFullName() {
		$user_email = $this->getUserEmail();
		$user_query = $this->makeQuery("SELECT first_name, last_name FROM users WHERE email='$user_email'");
		$user = mysqli_fetch_assoc($user_query);
		return $user['first_name'] . ' ' . $user['last_name'];
	}

	public function getUserId() {
		$user_email = $this->getUserEmail();
		$user_query = $this->makeQuery("SELECT id FROM users WHERE email = '$user_email'");
		$user = mysqli_fetch_assoc($user_query);
		$user_id = $user['id'];
		return $user_id; 
	}

	public function checkUserActive() {
		$user_email = $this->getUserEmail();
		$user_query = $this->makeQuery("SELECT * FROM users WHERE email='$user_email' AND is_active=1");

		if(mysqli_num_rows($user_query) > 0)
		{
			return true;
		}
		else
		{
			$this->setMessage('Your account has been deactivated. Contact the admin!|alert-danger');
			return false;
		}
	}

	public function checkUserIsStaff() {
		$user_email = $this->getUserEmail();
		$user_query = $this->makeQuery("SELECT * FROM users WHERE email='$user_email' AND is_staff=1");

		if(mysqli_num_rows($user_query) > 0)
		{
			return true;
		}
		else
		{
			// $this->setMessage('You are not authorized to access this dashboard!|alert-danger');
			return false;
		}
	}

	public function checkUserIsAdmin() {
		$user_email = $this->getUserEmail();
		$user_query = $this->makeQuery("SELECT * FROM users WHERE email='$user_email' AND is_admin=1");

		if(mysqli_num_rows($user_query) > 0)
		{
			return true;
		}
		else
		{
			return false;
		}
	}

	public function checkRecordExist($data) {
		if(is_null($data) || empty($data))
		{
    	$this->setMessage("Requested record doesn't exist. Please refrain from malicious editing of the URL!|alert-danger");
			$this->redirect('index.php');
		}
	}


	public function unauthorizedRedirect() {
		if(!($this->checkUserIsAdmin()))
	  {
	    $this->setMessage("You are not authorized to access that page!|alert-danger");
	    $this->redirect("index.php?logout");
	  }
	}


	public function redirect($link) {
		echo "<script>window.open('$link', '_self')</script>";
		return;
	}


	public function errorRedirect() {
		echo "<script>window.open('index.php', '_self')</script>";
		return;
	}

	// Set Session Message
	public function setMessage($msg) {
		if(!isset($_SESSION['messages']))
		{
			$_SESSION['messages'] = [];
		}
		
		array_push($_SESSION['messages'], $msg);
	}


	// Display Session Message
	public function displayMessage() {
		if(isset($_SESSION['messages'])){
			$messages = $_SESSION['messages'];
			unset($_SESSION['messages']);
			return $messages;
		}
	}

}

$dbConfig = new DBConfig();
?>