<?php
	class BoardMember extends DBConfig {
		public function getAll() {
			return $this->makeQuery('SELECT * FROM board_members');
		}

		public function getOne($id) {
			return $this->makeQuery("SELECT * FROM board_members WHERE id='$id'");
		}

		public function getData($item, $board_member_id) {
			$board_member_query = $this->makeQuery("SELECT $item FROM board_members WHERE id='$board_member_id'");
			$board_member_data = mysqli_fetch_assoc($board_member_query);
			return $board_member_data[$item];
		}
		
		public function insert() {
			if(isset($_POST['board_member_insert']))
			{
				$name = $this->checkData($_POST['name']);
				$position = $this->checkData($_POST['position']);
				$phone_num = $this->checkData($_POST['phone_num']);
				$text = $this->checkData($_POST['text']);
				
				$image = $_FILES['image']['name'];
        $temp_name = $_FILES['image']['tmp_name'];

        $extension = substr($image, strpos($image, '.') + 1);
        $extension = strtolower($extension);

        $accepted_extensions = ['jpg','jpeg','png'];

        if(!empty($image) && in_array($extension, $accepted_extensions))
        {
	        move_uploaded_file($temp_name,"../images/board_member_images/$image");

	        $board_member_insert = $this->makeQuery("INSERT INTO `board_members`(`text`,`name`,`position`,`phone_num`,`image`) VALUES ('$text','$name','$position','$phone_num','$image')");

	        if($board_member_insert)
	        {
	        	$this->setMessage('Board Member added successfully!|alert-success');
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
				
				$this->redirect('index.php?board_members');
				return;
			}
		}


		public function update() {
			if(isset($_POST['board_member_update']))
			{
				$name = $this->checkData($_POST['name']);
				$position = $this->checkData($_POST['position']);
				$phone_num = $this->checkData($_POST['phone_num']);
				$text = $this->checkData($_POST['text']);
				$board_member_id = $_POST['board_member_id'];

				$image = $_FILES['image']['name'];
        $temp_name = $_FILES['image']['tmp_name'];

        $extension = substr($image, strpos($image, '.') + 1);
        $extension = strtolower($extension);

        $accepted_extensions = ['jpg','jpeg','png'];

        if(empty($image) || in_array($extension, $accepted_extensions))
        {
	        if(!empty($image))
        	{
		        move_uploaded_file($temp_name,"../images/board_member_images/$image");
        	}
        	else
        	{
        		$image = $this->getData('image', $board_member_id);
        	}

	        $board_member_update = $this->makeQuery("UPDATE `board_members` SET `text`='$text',`name`='$name',`position`='$position',`phone_num`='$phone_num',`image`='$image' WHERE id='$board_member_id'");

	        if($board_member_update)
	        {
	        	$this->setMessage('Board Member details updated successfully!|alert-success');
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
				
				$this->redirect('index.php?board_members');
				return;
			}
		}


		public function deleteOne() {
			if(isset($_POST['board_member_delete']))
			{
				$board_member_id = $_POST['board_member_id'];

				$board_member_delete = $this->makeQuery("DELETE FROM board_members WHERE id='$board_member_id'");

				if($board_member_delete)
	      {
	      	$this->setMessage('Board Member record deleted successfully!|alert-success');
	      }
	      else
	      {
					$this->setMessage('Some error occurred whilst submitting your request|alert-danger');
	      }

				$this->redirect('index.php?board_members');
				return;	
			}
		}

	}

	$board_member = new BoardMember();
 ?>