<?php
	class AboutUs extends DBConfig {
		public function getAboutUs() {
			return $this->makeQuery("SELECT * FROM about_us LIMIT 1");
		}

		public function getData($item) {
			$about_us_query = $this->makeQuery("SELECT $item FROM about_us LIMIT 1");
			$about_us_data = mysqli_fetch_assoc($about_us_query);
			return $about_us_data[$item];
		}

		public function update() {
			if(isset($_POST['about_us_update']))
			{
				$pastor_name = $this->checkData($_POST['pastor_name']);
				$pastor_note = $this->checkData($_POST['pastor_note']);
				$text = $this->checkData($_POST['text']);
				$video_link = $this->checkData($_POST['video_link']);
				$address = $this->checkData($_POST['address']);
				$phone_num = $this->checkData($_POST['phone_num']);
				$email = $this->checkData($_POST['email']);
				$facebook = $this->checkData($_POST['facebook']);
				$twitter = $this->checkData($_POST['twitter']);
				$instagram = $this->checkData($_POST['instagram']);

				$image = $_FILES['image']['name'];
        $logo = $_FILES['logo']['name'];

        $image_temp_name = $_FILES['image']['tmp_name'];
        $logo_temp_name = $_FILES['logo']['tmp_name'];

        $image_extension = substr($image, strpos($image, '.') + 1);
        $image_extension = strtolower($image_extension);


        $logo_extension = substr($logo, strpos($logo, '.') + 1);
        $logo_extension = strtolower($logo_extension);

        $accepted_extensions = ['jpg','jpeg','png'];

        if(empty($logo) || in_array($logo_extension, $accepted_extensions))
        {

	        if(empty($image) || in_array($image_extension, $accepted_extensions))
	        {
	        	if(!empty($logo))
	        	{
		        	move_uploaded_file($logo_temp_name,"../images/about_us/$logo");
	        	}
	        	else
	        	{	        		
	        		$logo = $this->getData('logo');
	        	}

	        	if(!empty($image))
	        	{
		        	move_uploaded_file($image_temp_name,"../images/about_us/$image");
	        	}
	        	else
	        	{	        		
	        		$image = $this->getData('image');
	        	}

		        $about_us_update = $this->makeQuery("UPDATE `about_us` SET `logo`='$logo',`pastor_name`='$pastor_name',`pastor_note`='$pastor_note',`text`='$text',`image`='$image',`video_link`='$video_link',`address`='$address',`phone_num`='$phone_num',`email`='$email',`facebook`='$facebook',`twitter`='$twitter',`instagram`='$instagram'");

		        if($about_us_update)
		        {
		        	$this->setMessage('About Us updated successfully!|alert-success');
		        }
		        else
		        {
							$this->setMessage('Some error occurred whilst submitting your request|alert-danger');
		        }
	        }
	        else
	        {
	        	$this->setMessage('Select a valid image. Only JPG, JPEG, PNG files are allowed!|alert-danger');
	        }
        }
        else
        {
        	$this->setMessage('Select a valid logo image. Only JPG, JPEG, PNG files are allowed!|alert-danger');
        }
				
				$this->redirect('index.php?about_us');
				return;
			}
		}


		public function updateAnnouncement() {
			if(isset($_POST['announcement_update']))
			{
				$announcement = $this->checkData($_POST['announcement']);

				$announcement_update = $this->makeQuery("UPDATE about_us SET announcement='$announcement'");

				if($announcement_update)
        {
        	$this->setMessage('Announcement updated successfully!|alert-success');
        }
        else
        {
					$this->setMessage('Some error occurred whilst submitting your request|alert-danger');
        }

        $this->redirect('index.php?announcement');
        return;
			}
		}


		public function getAnnouncement() {
			return $this->makeQuery("SELECT announcement FROM about_us");
		}


	}

	$about_us = new AboutUs();
 ?>