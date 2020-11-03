<?php
	class Banner extends DBConfig {
		public function getAll() {
			return $this->makeQuery('SELECT * FROM banners');
		}

		public function getOne($id) {
			return $this->makeQuery("SELECT * FROM banners WHERE id='$id'");
		}

		public function getFirst() {
			return $this->makeQuery("SELECT * FROM banners ORDER BY RAND() LIMIT 1");
		}

		public function getData($item, $banner_id) {
			$banner_query = $this->makeQuery("SELECT $item FROM banners WHERE id='$banner_id'");
			$banner_data = mysqli_fetch_assoc($banner_query);
			return $banner_data[$item];
		}
		
		public function insert() {
			if(isset($_POST['banner_insert']))
			{
				$caption = $this->checkData($_POST['caption']);
				
				$image = $_FILES['image']['name'];
        $temp_name = $_FILES['image']['tmp_name'];

        $extension = substr($image, strpos($image, '.') + 1);
        $extension = strtolower($extension);

        $accepted_extensions = ['jpg','jpeg','png'];

        if(!empty($image) && in_array($extension, $accepted_extensions))
        {
	        move_uploaded_file($temp_name,"../images/banner_images/$image");

	        $banner_insert = $this->makeQuery("INSERT INTO banners(caption,image) VALUES ('$caption','$image')");

	        if($banner_insert)
	        {
	        	$this->setMessage('Banner added successfully!|alert-success');
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
				
				$this->redirect('index.php?banners');
				return;
			}
		}


		public function update() {
			if(isset($_POST['banner_update']))
			{
				$caption = $this->checkData($_POST['caption']);
				$banner_id = $_POST['banner_id'];

				$image = $_FILES['image']['name'];
        $temp_name = $_FILES['image']['tmp_name'];

        $extension = substr($image, strpos($image, '.') + 1);
        $extension = strtolower($extension);

        $accepted_extensions = ['jpg','jpeg','png'];

        if(empty($image) || in_array($extension, $accepted_extensions))
        {
        	if(!empty($image))
        	{
		        move_uploaded_file($temp_name,"../images/banner_images/$image");
        	}
        	else
        	{
        		$image = $this->getData('image', $banner_id);
        	}

	        $banner_update = $this->makeQuery("UPDATE banners SET caption='$caption',image='$image' WHERE id='$banner_id'");

	        if($banner_update)
	        {
	        	$this->setMessage('Banner updated successfully!|alert-success');
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
				
				$this->redirect('index.php?banners');
				return;
			}
		}


		public function deleteOne() {
			if(isset($_POST['banner_delete']))
			{
				$banner_id = $_POST['banner_id'];
				$banner_delete = $this->makeQuery("DELETE FROM banners WHERE id='$banner_id'");

				if($banner_delete)
	      {
	      	$this->setMessage('Banner deleted successfully!|alert-success');
	      }
	      else
	      {
					$this->setMessage('Some error occurred whilst submitting your request|alert-danger');
	      }

				$this->redirect('index.php?banners');
				return;
			}
		}

	}

	$banner = new Banner();
 ?>