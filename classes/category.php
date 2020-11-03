<?php 
	class Category extends DBConfig {

		public function getAll() {
			return $this->makeQuery("SELECT * FROM categories");
		}

		public function getOne($id) {
			return $this->makeQuery("SELECT * FROM categories WHERE id='$id'");
		}

		public function getCategoryName($id) {
			$cat_query = $this->makeQuery("SELECT category FROM categories WHERE id='$id'");
			$cat_data = mysqli_fetch_assoc($cat_query);
			return $cat_data['category'];
		}

		public function insert() {
			if(isset($_POST['category_insert']))
			{
				$category = $this->checkData($_POST['category']);

				$category_insert = $this->makeQuery("INSERT INTO categories(category) VALUES ('$category')");

				if($category_insert)
				{
					$this->setMessage('Category submitted successfully!|alert-success');
				}
				else
				{
					$this->setMessage('Sorry an error occurred whilst submitting your request. Try again later!|alert-danger');
				}

				$this->redirect('index.php?categories');
				return;
			}
		}

		public function update() {
			if(isset($_POST['category_update']))
			{
				$category = $this->checkData($_POST['category']);
				$category_id = $_POST['category_id'];

				$category_update = $this->makeQuery("UPDATE categories SET category='$category' WHERE id='$category_id'");

				if($category_update)
				{
					$this->setMessage('Category updated successfully!|alert-success');
				}
				else
				{
					$this->setMessage('Sorry an error occurred whilst submitting your request. Try again later!|alert-danger');
				}

				$this->redirect('index.php?categories');
				return;
			}
		}

		public function deleteOne() {
			if(isset($_POST['category_delete']))
			{
				$category_id = $_POST['category_id'];

				$category_delete = $this->makeQuery("DELETE FROM categories WHERE id='$category_id'");

				if($category_delete)
				{
					$this->setMessage('Category deleted successfully!|alert-success');
				}
				else
				{
					$this->setMessage('Sorry an error occurred whilst submitting your request. Try again later!|alert-danger');
				}

				$this->redirect('index.php?categories');
				return;	
			}
		}

	}


	$sermon_category = new Category();
 ?>