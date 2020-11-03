<?php
	class Ministry extends DBConfig {
		public function getAll() {
			return $this->makeQuery('SELECT * FROM ministries');
		}

		public function getOne($id) {
			return $this->makeQuery("SELECT * FROM ministries WHERE id='$id'");
		}

		public function getData($item, $ministry_id) {
			$ministry_query = $this->makeQuery("SELECT $item FROM ministries WHERE id='$ministry_id'");
			$ministry_data = mysqli_fetch_assoc($ministry_query);
			return $ministry_data[$item];
		}
		public function insert() {
			if(isset($_POST['ministry_insert']))
			{
				$name = $this->checkData($_POST['name']);
				$text = $this->checkData($_POST['text']);
				$caption = $this->checkData($_POST['caption']);
				
				$image = $_FILES['image']['name'];
        $temp_name = $_FILES['image']['tmp_name'];

        $extension = substr($image, strpos($image, '.') + 1);
        $extension = strtolower($extension);

        $accepted_extensions = ['jpg','jpeg','png'];

        if(!empty($image) && in_array($extension, $accepted_extensions))
        {
	        move_uploaded_file($temp_name,"../images/ministry_images/$image");

	        $ministry_insert = $this->makeQuery("INSERT INTO `ministries`(`text`,`caption`,`name`,`image`) VALUES ('$text','$caption','$name','$image')");

	        if($ministry_insert)
	        {
	        	$this->setMessage('Ministry added successfully!|alert-success');
	        }
	        else
	        {
						$this->setMessage('Some error occurred whilst submitting your request|alert-danger');
	        }
        }
        else
        {
        	$this->setMessage('Select an image. Only JPG, JPEG, PNG files are allowed!|alert-danger');
        }
				
				$this->redirect('index.php?ministries');
				return;
			}
		}


		public function update() {
			if(isset($_POST['ministry_update']))
			{
				$name = $this->checkData($_POST['name']);
				$text = $this->checkData($_POST['text']);
				$caption = $this->checkData($_POST['caption']);
				$ministry_id = $_POST['ministry_id'];

				$image = $_FILES['image']['name'];
        $temp_name = $_FILES['image']['tmp_name'];

        $extension = substr($image, strpos($image, '.') + 1);
        $extension = strtolower($extension);

        $accepted_extensions = ['jpg','jpeg','png'];

        if(empty($image) || in_array($extension, $accepted_extensions))
        {
	        if(!empty($image))
        	{
		        move_uploaded_file($temp_name,"../images/ministry_images/$image");
        	}
        	else
        	{
        		$image = $this->getData('image', $ministry_id);
        	}

	        $ministry_update = $this->makeQuery("UPDATE `ministries` SET `text`='$text',`caption`='$caption',`name`='$name',`image`='$image' WHERE id='$ministry_id'");

	        if($ministry_update)
	        {
	        	$this->setMessage('Ministry details updated successfully!|alert-success');
	        }
	        else
	        {
						$this->setMessage('Some error occurred whilst submitting your request|alert-danger');
	        }
        }
        else
        {
        	$this->setMessage('Select an image. Only JPG, JPEG, PNG files are allowed!|alert-danger');
        }
				
				$this->redirect('index.php?ministries');
				return;
			}
		}


		public function deleteOne() {
			if(isset($_POST['ministry_delete']))
			{
				$ministry_id = $_POST['ministry_id'];

				$ministry_delete = $this->makeQuery("DELETE FROM ministries WHERE id='$ministry_id'");

				if($ministry_delete)
	      {
	      	$this->setMessage('Ministry record deleted successfully!|alert-success');
	      }
	      else
	      {
					$this->setMessage('Some error occurred whilst submitting your request|alert-danger');
	      }

				$this->redirect('index.php?ministries');
				return;
			}
		}

	}

	$ministry = new Ministry();
 ?>