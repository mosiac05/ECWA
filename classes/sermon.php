<?php
	class Sermon extends DBConfig {
		private $per_page = 6;
		private $page_no;

		public function getAll() {
			return $this->makeQuery("SELECT * FROM sermons ORDER BY 1 DESC");
		}

		public function getWithLimit() {
			$sermon_limit = $this->getSermonLimit();
			return $this->makeQuery("SELECT * FROM sermons ORDER BY 1 DESC LIMIT $sermon_limit, $this->per_page");
		}

		public function getByCategory($cat_id) {
			$sermon_limit = $this->getSermonLimit();
			return $this->makeQuery("SELECT * FROM sermons WHERE cat_id='$cat_id' ORDER BY 1 DESC LIMIT $sermon_limit, $this->per_page");
		}

		public function getNumberByCategory($cat_id) {
			$cat_query = $this->makeQuery("SELECT * FROM sermons WHERE cat_id='$cat_id'");
			$num_of_sermons = mysqli_num_rows($cat_query);
			return $num_of_sermons;
		}

		public function getNumberOfSermons() {
			$sermon_query = $this->makeQuery("SELECT * FROM sermons");
			$num_of_sermons = mysqli_num_rows($sermon_query);
			return ceil($num_of_sermons / $this->per_page);
		}

		public function getSermonLimit() {
			if(empty($this->page_no) || $this->page_no <= 1){
				$sermon_limit = 0;
			}
			else{
				$sermon_limit = ($this->page_no * $this->per_page) - $this->per_page;
			}
			return $sermon_limit;
		}

		public function setPageNumber($page_no) {
			$this->page_no = $page_no;
		}

		public function getPageNumber() {
			return $this->page_no;
		}

		public function getOne($id) {
			return $this->makeQuery("SELECT * FROM sermons WHERE id='$id'");
		}
		
		public function getData($item, $sermon_id) {
			$sermon_query = $this->makeQuery("SELECT $item FROM sermons WHERE id='$sermon_id'");
			$sermon_data = mysqli_fetch_assoc($sermon_query);
			return $sermon_data[$item];
		}

		public function getLatest($limit) {
			return $this->makeQuery("SELECT * FROM sermons ORDER BY 1 DESC LIMIT $limit");
		}

		public function getPopular() {
			return $this->makeQuery("SELECT * FROM sermons WHERE popular=1 ORDER BY RAND() LIMIT 4");
		}

		public function getRandom() {
			return $this->makeQuery("SELECT * FROM sermons ORDER BY RAND() LIMIT 6");
		}

		public function search($search) {
			return $this->makeQuery("SELECT * FROM sermons WHERE title like('%$search%') OR tags like('%$search%') ORDER BY 1 DESC");
		}

		public function insert() {
			if(isset($_POST['sermon_insert']))
			{
				$title = $this->checkData($_POST['title']);
				$link = $this->checkData($_POST['link']);
				$tags = $this->checkData($_POST['tags']);
				$text = $this->checkData($_POST['text']);
				$cat_id = $this->checkData($_POST['cat_id']);
				$popular = 0;
				$user_id = $this->getUserId();
				
				$image = $_FILES['image']['name'];
        $temp_name = $_FILES['image']['tmp_name'];

        $extension = substr($image, strpos($image, '.') + 1);
        $extension = strtolower($extension);

        $accepted_extensions = ['jpg','jpeg','png'];

        if(!empty($image) && in_array($extension, $accepted_extensions))
        {
	        move_uploaded_file($temp_name,"../images/sermon_images/$image");

	        $sermon_insert = $this->makeQuery("INSERT INTO `sermons`(`title`,`link`,`tags`,`text`,`cat_id`,`popular`,`user_id`,`image`,`created_at`,`modified_at`) VALUES ('$title','$link','$tags','$text','$cat_id','$popular','$user_id','$image',NOW(),NOW())");

	        if($sermon_insert)
	        {
	        	$this->setMessage('Sermon added successfully!|alert-success');
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
				
				$this->redirect('index.php?sermon_create');
				return;
			}
		}


		public function update() {
			if(isset($_POST['sermon_update']))
			{
				$title = $this->checkData($_POST['title']);
				$link = $this->checkData($_POST['link']);
				$tags = $this->checkData($_POST['tags']);
				$text = $this->checkData($_POST['text']);
				$cat_id = $this->checkData($_POST['cat_id']);
				$sermon_id = $_POST['sermon_id'];

				$image = $_FILES['image']['name'];
        $temp_name = $_FILES['image']['tmp_name'];

        $extension = substr($image, strpos($image, '.') + 1);
        $extension = strtolower($extension);

        $accepted_extensions = ['jpg','jpeg','png'];

        if(empty($image) || in_array($extension, $accepted_extensions))
        {
        	if(!empty($image)) {
	        	move_uploaded_file($temp_name,"../images/sermon_images/$image");
        	} else {
        		$image = $this->getData('image', $sermon_id);
        	}

	        $sermon_update = $this->makeQuery("UPDATE `sermons` SET `title`='$title',`link`='$link',`tags`='$tags',`text`='$text',`cat_id`='$cat_id',`image`='$image',`modified_at`=NOW() WHERE id='$sermon_id'");

	        if($sermon_update)
	        {
	        	$this->setMessage('Sermon details updated successfully!|alert-success');
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
				
				$this->redirect('index.php?sermon_single='.$sermon_id);
				return;
			}
		}


		public function deleteOne($id) {
			if(isset($_POST['sermon_delete']))
			{
				$sermon_delete = $this->makeQuery("DELETE FROM sermons WHERE id='$id'");

				if($sermon_delete)
	      {
	      	$this->setMessage('Sermon record deleted successfully!|alert-success');
	      }
	      else
	      {
					$this->setMessage('Some error occurred whilst submitting your request|alert-danger');
	      }

				$this->redirect('index.php?sermons');
				return;
			}
		}


		public function makePopular($sermon_id) {
			if(isset($_POST['make_popular']))
			{
				$sermon_make_popular = $this->makeQuery("UPDATE sermons SET popular=1 WHERE id='$sermon_id'");

				if($sermon_make_popular)
				{
					$this->setMessage('Sermon made popular successfully!|alert-success');
				}
				else
				{
					$this->setMessage('Some error occurred whilst submitting your request. Try again later!|alert-danger');
				}

				$this->redirect('index.php?sermon_single='.$sermon_id);
				return;
			}
		}

		public function removePopular($sermon_id) {
			if(isset($_POST['remove_popular']))
			{
				$sermon_remove_popular = $this->makeQuery("UPDATE sermons SET popular=0 WHERE id='$sermon_id'");

				if($sermon_remove_popular)
				{
					$this->setMessage('Sermon removed from popular successfully!|alert-success');
				}
				else
				{
					$this->setMessage('Some error occurred whilst submitting your request. Try again later!|alert-danger');
				}

				$this->redirect('index.php?sermon_single='.$sermon_id);
				return;
			}
		}


	}

	$sermon = new Sermon();
 ?>