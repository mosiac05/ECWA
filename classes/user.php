<?php 
	// include '../config/dbConfig.php';

	class User extends DBConfig {
		public function getAll(){
			return $this->makeQuery("SELECT * FROM users");
		}

		public function getAllStaff() {
			return $this->makeQuery("SELECT * FROM users WHERE is_staff=1 AND is_admin=0");
		}

		public function getAllAdmins() {
			return $this->makeQuery("SELECT * FROM users WHERE is_admin=1");
		}

		public function getOne($id) {
			return $this->makeQuery("SELECT * FROM users WHERE id='$id'");
		}

		public function getUserName($id) {
			$user_query = $this->makeQuery("SELECT first_name, last_name FROM users WHERE id='$id'");
			$user_data = mysqli_fetch_assoc($user_query);
			return $user_data['first_name'] . ' ' . $user_data['last_name'];
		}

		public function getData($item, $email) {
			$user_query = $this->makeQuery("SELECT $item FROM users WHERE email='$email'");
			$user_data = mysqli_fetch_assoc($user_query);
			return $user_data[$item];
		}

		public function insert($is_staff, $is_admin) {
			if(isset($_POST['user_insert']))
			{
				$first_name = $this->checkData($_POST['first_name']);
				$last_name = $this->checkData($_POST['last_name']);
				$username = strtolower($this->checkData($_POST['username']));
				$email = strtolower($this->checkData($_POST['email']));
				$password = $this->checkData($_POST['password']);
				$confirm_password = $this->checkData($_POST['confirm_password']);

				$email_check = $this->makeQuery("SELECT email FROM users WHERE email='$email'");

				if(mysqli_num_rows($email_check) > 0)
				{
					$this->setMessage('An account with the email address ' . $email . ' already exist!|alert-danger');					
					$this->setMessage('Please ensure your email address is correct or Login instead.|alert-light');				
				}
				else
				{
					if($password !== $confirm_password)
					{
						$this->setMessage('Your passwords do not match!|alert-danger');
						$this->setMessage('NOTE: The password is case-sensitive. Ensure you type the same password for both \'Password\' and \'Password Confirmation\' fields!|alert-light');
					}
					else
					{
						$password_hash = md5($password);
						$user_insert = $this->makeQuery("INSERT INTO users(first_name,last_name,username,password,email,is_active,is_staff,is_admin,last_login,created_at,modified_at) VALUES ('$first_name','$last_name','$username','$password_hash','$email',1,'$is_staff','$is_admin',NOW(),NOW(),NOW())");

						if($user_insert)
						{
							$this->setMessage('Account Created Successfully. You can log in now!|alert-success');
						}
						else
						{
							$this->setMessage('Some error occurred whilst submitting your request. Try again later!|alert-danger');
						}
					}
				}

				$this->redirect('index.php?dashboard');
				return;
			}
		}



		public function update() {
			if(isset($_POST['user_edit']))
			{
				$user_id = $this->checkData($_POST['user_id']);
				$first_name = $this->checkData($_POST['first_name']);
				$last_name = $this->checkData($_POST['last_name']);
				$username = strtolower($this->checkData($_POST['username']));
				$email = strtolower($this->checkData($_POST['email']));

				$email_check = $this->makeQuery("SELECT email FROM users WHERE email='$email' AND id!='$user_id'");

				if(mysqli_num_rows($email_check) > 0)
				{
					$this->setMessage('An account with the email address ' . $email . ' already exist!|alert-danger');					
					$this->setMessage('Please ensure your email address is correct or Login instead.|alert-light');		
				}
				else
				{
					$user_update = $this->makeQuery("UPDATE `users` SET `first_name`='$first_name',`last_name`='$last_name',`username`='$username',`email`='$email',`modified_at`=NOW() WHERE id='$user_id'");

					if($user_update)
					{
						$this->setMessage('Account Details Updated Successfully!|alert-success');
					}
					else
					{
						$this->setMessage('Some error occurred whilst submitting your request. Try again later!|alert-danger');
					}
				}

				$this->redirect('index.php?user_single='.$user_id);
				return;
			}
		}


		public function updatePassword($email) {
			if(isset($_POST['password_update']))
			{
				$old_password = $this->checkData($_POST['old_password']);
				$new_password = $this->checkData($_POST['new_password']);
				$confirm_password = $this->checkData($_POST['confirm_password']);

				$old_password_hash = md5($old_password);
				$user_email = $email;

				$password_check = $this->makeQuery("SELECT * FROM users WHERE email='$user_email' AND password='$old_password_hash'");

				if(mysqli_num_rows($password_check) < 1)
				{
					$this->setMessage('Password change failed. Current/Old password incorrect!|alert-danger');
				}
				else
				{
					if($new_password !== $confirm_password)
					{
						$this->setMessage('Your new passwords do not match!|alert-danger');
						$this->setMessage('Ensure you type the same thing for New Password and Confirm Password. They are case-sensitive!|alert-danger');
					}
					else
					{
						$new_password_hash = md5($new_password);

						$password_update = $this->makeQuery("UPDATE users SET password='$new_password_hash' WHERE email='$user_email'");
						if($password_update)
						{
							$this->setMessage('Password Changed Successfully!|alert-success');
						}
						else
						{
							$this->setMessage('Some error occurred whilst submitting your request. Try again later!|alert-danger');
						}	
					}
				}

				$user_id = $this->getData($id, $email);
				$this->redirect('index.php?user_single='.$user_id);
				return;
			}
		}


		public function deleteOne($user_id) {
			if(isset($_POST['user_delete']))
			{
				$user_delete = $this->makeQuery("DELETE FROM users WHERE id='$user_id'");
				if($user_delete)
				{
					$this->setMessage('Account Deleted Successfully!|alert-success');
				}
				else
				{
					$this->setMessage('Some error occurred whilst submitting your request. Try again later!|alert-danger');
				}

			echo "<script>window.open('index.php?staffs', '_self')</script>";
			return;
			}
		}

		public function activateUser($user_id) {
			if(isset($_POST['user_activate']))
			{
				$user_activate = $this->makeQuery("UPDATE users SET is_active=1,modified_at=NOW() WHERE id='$user_id'");

				if($user_activate)
				{
					$this->setMessage('Account Activated Successfully!|alert-success');
				}
				else
				{
					$this->setMessage('Some error occurred whilst submitting your request. Try again later!|alert-danger');
				}

			$this->redirect('index.php?user_single='.$user_id);
			return;
			}
		}

		public function deactivateUser($user_id) {
			if(isset($_POST['user_deactivate']))
			{
				$user_deactivate = $this->makeQuery("UPDATE users SET is_active=0,modified_at=NOW() WHERE id='$user_id'");

				if($user_deactivate)
				{
					$this->setMessage('Account Deactivated Successfully!|alert-success');
				}
				else
				{
					$this->setMessage('Some error occurred whilst submitting your request. Try again later!|alert-danger');
				}

			$this->redirect('index.php?user_single='.$user_id);
			return;
			}
		}

	}

	$user = new User();
 ?>