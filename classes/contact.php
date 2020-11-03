<?php
	class Contact extends DBConfig {
		public function getAll() {
			return $this->makeQuery('SELECT * FROM contacts ORDER BY created_at');
		}

		public function insert() {
			if(isset($_POST['contact_insert']))
			{
				$name = $this->checkData($_POST['name']);
				$phone_num = $this->checkData($_POST['phone_num']);
				$email = strtolower($this->checkData($_POST['email']));
				$message = $this->checkData($_POST['message']);

				$contact_insert = $this->makeQuery("INSERT INTO contacts(name,email,phone_num,message,created_at) VALUES ('$name','$phone_num','$email','$message',NOW())");

				if($contact_insert)
	      {
	      	echo "<script>alert('Thank you for contacting us!')</script>";
	      }
	      else
	      {
	      	echo "<script>alert('Some error occurred whilst submitting your request!')</script>";
	      }

				$this->redirect('index.php?contact');
				return;
			}
		}

		public function deleteOne() {
			if(isset($_POST['contact_delete']))
			{	
				$contact_id = $_POST['contact_id'];
				$contact_delete = $this->makeQuery("DELETE FROM contacts WHERE id='$contact_id'");

				if($contact_delete)
	      {
	      	$this->setMessage('Contact record deleted successfully!|alert-success');
	      }
	      else
	      {
					$this->setMessage('Some error occurred whilst submitting your request|alert-danger');
	      }

				$this->redirect('index.php?contacts');
				return;
			}
		}

	}

	$contact = new Contact();
 ?>