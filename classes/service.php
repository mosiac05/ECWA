<?php
	class Service extends DBConfig {
		public function getAll() {
			return $this->makeQuery('SELECT * FROM services');
		}

		public function getOne($id) {
			return $this->makeQuery("SELECT * FROM services WHERE id='$id'");
		}
		
		public function getData($item, $service_id) {
			$service_query = $this->makeQuery("SELECT $item FROM services WHERE id='$service_id'");
			$service_data = mysqli_fetch_assoc($service_query);
			return $service_data[$item];
		}

		public function insert() {
			if(isset($_POST['service_insert']))
			{
				$heading = $this->checkData($_POST['heading']);
				$text = $this->checkData($_POST['text']);
				
				$image = $_FILES['image']['name'];
        $temp_name = $_FILES['image']['tmp_name'];

        $extension = substr($image, strpos($image, '.') + 1);
        $extension = strtolower($extension);

        $accepted_extensions = ['jpg','jpeg','png'];

        if(!empty($image) && in_array($extension, $accepted_extensions))
        {
	        move_uploaded_file($temp_name,"../images/service_images/$image");

	        $service_insert = $this->makeQuery("INSERT INTO `services`(`text`,`heading`,`image`) VALUES ('$text','$heading','$image')");

	        if($service_insert)
	        {
	        	$this->setMessage('Service added successfully!|alert-success');
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
				
				$this->redirect('index.php?services');
				return;
			}
		}


		public function update() {
			if(isset($_POST['service_update']))
			{
				$heading = $this->checkData($_POST['heading']);
				$text = $this->checkData($_POST['text']);
				$service_id = $_POST['service_id'];

				$image = $_FILES['image']['name'];
        $temp_name = $_FILES['image']['tmp_name'];

        $extension = substr($image, strpos($image, '.') + 1);
        $extension = strtolower($extension);

        $accepted_extensions = ['jpg','jpeg','png'];

        if(empty($image) || in_array($extension, $accepted_extensions))
        {
	        if(!empty($image))
        	{
		        move_uploaded_file($temp_name,"../images/service_images/$image");
        	}
        	else
        	{
        		$image = $this->getData('image', $service_id);
        	}

	        $service_update = $this->makeQuery("UPDATE `services` SET `text`='$text',`heading`='$heading',`image`='$image' WHERE id='$service_id'");

	        if($service_update)
	        {
	        	$this->setMessage('Service details updated successfully!|alert-success');
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
				
				$this->redirect('index.php?services');
				return;
			}
		}


		public function deleteOne() {
			if(isset($_POST['service_delete']))
			{
				$service_id = $_POST['service_id'];
				$service_delete = $this->makeQuery("DELETE FROM services WHERE id='$service_id'");

				if($service_delete)
	      {
	      	$this->setMessage('Service record deleted successfully!|alert-success');
	      }
	      else
	      {
					$this->setMessage('Some error occurred whilst submitting your request|alert-danger');
	      }

				$this->redirect('index.php?services');
				return;
			}
		}

	}

	$service = new Service();
 ?>