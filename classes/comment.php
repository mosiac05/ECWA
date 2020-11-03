<?php 

	class Comment extends DBConfig {

		public function getAll($sermon_id) {
			return $this->makeQuery("SELECT * FROM comments WHERE sermon_id='$sermon_id'");
		}

		public function getAllApproved($sermon_id) {
			return $this->makeQuery("SELECT * FROM comments WHERE sermon_id='$sermon_id' AND status='APPROVED'");
		}

		public function numberOfCommentBySermon($sermon_id) {
			return mysqli_num_rows($this->getAllApproved($sermon_id));
		}

		public function insert($sermon_id) {
			if(isset($_POST['comment_insert']))
			{
				$bot_check = $_POST['bot_check'];

				if($bot_check == '7')
				{
					$name = $_POST['name'];
					$message = $_POST['message'];
					$status = 'APPROVED';

					$comment_insert = $this->makeQuery("INSERT INTO comments(name,message,status,sermon_id,created_at) VALUES ('$name','$message','$status','$sermon_id',NOW())");

					if($comment_insert)
		      {
		      	echo "<script>alert('Your comment has been successfully submitted!')</script>";
		      }
		      else
		      {
		      	echo "<script>alert('Some error occurred whilst submitting your request!')</script>";
		      }
				}

				$this->redirect('index.php?sermon_details='.$sermon_id);
				return;
			}
		}

		public function approve_comment($sermon_id) {
			if(isset($_POST['approve_comment']))
			{
				$comment_id = $_POST['comment_id'];
				$comment_approve = $this->makeQuery("UPDATE comments SET status='APPROVED' WHERE id='$comment_id'");

				if($comment_approve)
	      {
	      	$this->setMessage('Comment approved successfully!|alert-success');
	      }
	      else
	      {
					$this->setMessage('Some error occurred whilst submitting your request|alert-danger');
	      }

				$this->redirect('index.php?sermon_single='.$sermon_id);
				return;
			}
		}

		public function disapprove_comment($sermon_id) {
			if(isset($_POST['disapprove_comment']))
			{
				$comment_id = $_POST['comment_id'];
				$comment_disapprove = $this->makeQuery("UPDATE comments SET status='DISAPPROVED' WHERE id='$comment_id'");

				if($comment_disapprove)
	      {
	      	$this->setMessage('Comment disapproved successfully!|alert-success');
	      }
	      else
	      {
					$this->setMessage('Some error occurred whilst submitting your request|alert-danger');
	      }

				$this->redirect('index.php?sermon_single='.$sermon_id);
				return;
			}
		}


		public function deleteOne($sermon_id) {
			if(isset($_POST['comment_delete']))
			{	
				$comment_id = $_POST['comment_id'];
				$comment_delete = $this->makeQuery("DELETE FROM comments WHERE id='$comment_id'");

				if($comment_delete)
	      {
	      	$this->setMessage('Comment deleted successfully!|alert-success');
	      }
	      else
	      {
					$this->setMessage('Some error occurred whilst submitting your request|alert-danger');
	      }

				$this->redirect('index.php?sermon_single='.$sermon_id);
				return;
			}
		}

	}

	$comment = new Comment();
 ?>