<?php 
	// require_once('../config/dbconfig.php');

	class Authentication extends DBConfig {
		public function login() {
			if(isset($_POST['login_btn']))
			{
				$email = strtolower($this->checkData($_POST["email"]));
				$password = $this->checkData($_POST["password"]);

				if(empty($email) || empty($password))
				{
					$this->setMessage('Email or Password field is empty|alert-danger');
					return;
				}
				else
				{

					$password_hash = md5($password);

					$user_query = $this->makeQuery("SELECT * FROM users WHERE email='$email'");
				// echo mysqli_num_rows($user_query);

					if(mysqli_num_rows($user_query) < 1)
					{
						$this->setMessage('This account has not been registered. Ensure your email is correct!|alert-danger');
						return;
					}
					else
					{
						$row = mysqli_fetch_assoc($user_query);

						$is_active = $row['is_active'];
						if(!$is_active)
						{
							$this->setMessage('You are not authorized to access this dashboard!|alert-danger');
							$this->setMessage('Your account has been deactivated. Reach out to the admin if you think this is an error!|alert-light');
							return;							
						}
						else
						{

							// $is_staff = $row['is_staff'];
							// if(!$is_staff)
							// {
							// 	$this->setMessage('You are not authorized to access this dashboard!|alert-danger');
							// 	return;							
							// }
							// else
							// {
								$password = $row['password'];

								if($password_hash !== $password)
								{
									$this->setMessage('Password Incorrect!|alert-danger');
									return;									
								}
								else
								{
									$this->setMessage('Successfully logged in as ' . $email .'!|alert-success');
									$_SESSION['user_email'] = $row['email'];

									if($row['is_staff'] || $row['is_admin']){									
										echo "<script>window.open('index.php', '_self')</script>";						
									}
									else
									{
										$user_id = $row['id'];
										echo "<script>window.open('index.php?profile=$user_id', '_self')</script>";						
									}
								}
							// }
						}
					}
				}
			}
		}

		public function logout() {
			$user_email = $_SESSION['user_email'];

			$this->makeQuery("UPDATE users SET last_login = NOW() WHERE email = '$user_email'");
			unset($_SESSION['user_email']);
			session_destroy();
			echo "<script>window.open('index.php', '_self')</script>";
			return;
		}
	}

	$auth = new Authentication();
 ?>