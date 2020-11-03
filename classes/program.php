<?php
	class Program extends DBConfig {
		public function getAll() {
			return $this->makeQuery('SELECT * FROM programs');
		}

		public function getOne($id) {
			return $this->makeQuery("SELECT * FROM programs WHERE id='$id'");
		}

		public function getByDay($day) {
			return $this->makeQuery("SELECT * FROM programs WHERE day='$day' ORDER BY `time`");
		}

		public function getNumberOfProgramsByDay($day) {
			$num_of_programs = mysqli_num_rows($this->getByDay($day));
			$num_of_programs = $num_of_programs + 1;
			return $num_of_programs;
		}
		
		public function insert() {
			if(isset($_POST['program_insert']))
			{
				$day = $this->checkData($_POST['day']);
				$activity = $this->checkData($_POST['activity']);
				$time = $this->checkData($_POST['time']);
				$venue = $this->checkData($_POST['venue']);
				

        $program_insert = $this->makeQuery("INSERT INTO `programs`(`day`,`time`,`activity`,`venue`) VALUES ('$day','$time','$activity','$venue')");

        if($program_insert)
        {
        	$this->setMessage('Program added successfully!|alert-success');
        }
        else
        {
					$this->setMessage('Some error occurred whilst submitting your request|alert-danger');
        }

				$this->redirect('index.php?programs');
				return;
      }
			
		}


		public function update() {
			if(isset($_POST['program_update']))
			{
				$day = $this->checkData($_POST['day']);
				$activity = $this->checkData($_POST['activity']);
				$time = $this->checkData($_POST['time']);
				$venue = $this->checkData($_POST['venue']);
				$program_id = $_POST['program_id'];
        
        $program_update = $this->makeQuery("UPDATE `programs` SET `day`='$day',`activity`='$activity',`time`='$time',`venue`='$venue' WHERE id='$program_id'");

        if($program_update)
        {
        	$this->setMessage('Program details updated successfully!|alert-success');
        }
        else
        {
					$this->setMessage('Some error occurred whilst submitting your request|alert-danger');
        }				
			
				$this->redirect('index.php?programs');
				return;
			}
		}


		public function deleteOne() {
			if(isset($_POST['program_delete']))
			{
				$program_id = $_POST['program_id'];

				$program_delete = $this->makeQuery("DELETE FROM programs WHERE id='$program_id'");

				if($program_delete)
	      {
	      	$this->setMessage('Program record deleted successfully!|alert-success');
	      }
	      else
	      {
					$this->setMessage('Some error occurred whilst submitting your request|alert-danger');
	      }

				$this->redirect('index.php?programs');
				return;
			}
		}

	}

	$program = new Program();
 ?>