<?php
	class Event extends DBConfig {
		private $per_page = 9;
		private $page_no;

		public function getAll() {
			$event_limit = $this->getEventLimit();
			return $this->makeQuery("SELECT * FROM events ORDER BY 1 DESC LIMIT $event_limit, $this->per_page");
		}

		public function getNumberOfEvents() {
			$event_query = $this->makeQuery("SELECT * FROM events");
			$num_of_events = mysqli_num_rows($event_query);
			return ceil($num_of_events / $this->per_page);
		}

		public function getEventLimit() {
			if(empty($this->page_no) || $this->page_no <= 1){
				$event_limit = 0;
			}
			else{
				$event_limit = ($this->page_no * $this->per_page) - $this->per_page;
			}
			return $event_limit;
		}

		public function setPageNumber($page_no) {
			$this->page_no = $page_no;
		}

		public function getPageNumber() {
			return $this->page_no;
		}

		public function getOne($id) {
			return $this->makeQuery("SELECT * FROM events WHERE id='$id'");
		}
		
		public function getLatest($limit) {
			return $this->makeQuery("SELECT * FROM events ORDER BY 1 DESC LIMIT $limit");
		}


		public function insert() {
			if(isset($_POST['event_insert']))
			{
				$user_id = $this->getUserId();
				$title = $this->checkData($_POST['title']);
				$date = $this->checkData($_POST['date']);
				$text = $this->checkData($_POST['text']);
				
				$image = $_FILES['image']['name'];
        $temp_name = $_FILES['image']['tmp_name'];

        $extension = substr($image, strpos($image, '.') + 1);
        $extension = strtolower($extension);

        $accepted_extensions = ['jpg','jpeg','png'];

        if(!empty($image) && in_array($extension, $accepted_extensions))
        {
	        move_uploaded_file($temp_name,"../images/event_images/$image");

	        $event_insert = $this->makeQuery("INSERT INTO `events`(`title`,`text`,`date`,`image`,`user_id`,`created_at`,`modified_at`) VALUES ('$title','$text','$date','$image','$user_id',NOW(),NOW())");

	        if($event_insert)
	        {
	        	$this->setMessage('Event added successfully!|alert-success');
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
				
				$this->redirect('index.php?events');
				return;
			}
		}


		public function update() {
			if(isset($_POST['event_update']))
			{
				$title = $this->checkData($_POST['title']);
				$date = $this->checkData($_POST['date']);
				$text = $this->checkData($_POST['text']);
				$event_id = $_POST['event_id'];

				$image = $_FILES['image']['name'];
        $temp_name = $_FILES['image']['tmp_name'];

        $extension = substr($image, strpos($image, '.') + 1);
        $extension = strtolower($extension);

        $accepted_extensions = ['jpg','jpeg','png'];

        if(empty($image) || in_array($extension, $accepted_extensions))
        {
	        if(!empty($image))
        	{
		        move_uploaded_file($temp_name,"../images/event_images/$image");
        	}
        	else
        	{
        		$image = $this->getData('image', $banner_id);
        	}

	        $event_update = $this->makeQuery("UPDATE `events` SET `title`='$title',`text`='$text',`date`='$date',`image`='$image',`modified_at`=NOW() WHERE id='$event_id'");

	        if($event_update)
	        {
	        	$this->setMessage('Event details updated successfully!|alert-success');
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
				
				$this->redirect('index.php?events');
				return;
			}
		}


		public function deleteOne() {
			if(isset($_POST['event_delete']))
			{
				$event_id = $_POST['event_id'];
				$event_delete = $this->makeQuery("DELETE FROM events WHERE id='$event_id'");

				if($event_delete)
	      {
	      	$this->setMessage('Event record deleted successfully!|alert-success');
	      }
	      else
	      {
					$this->setMessage('Some error occurred whilst submitting your request|alert-danger');
	      }

				$this->redirect('index.php?events');
				return;

			}		}

	}

	$event = new Event();
 ?>