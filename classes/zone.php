<?php
	class Zone extends DBConfig {
		public function getAll() {
			return $this->makeQuery('SELECT * FROM zones ORDER BY zone');
		}

		public function getOne($id) {
			return $this->makeQuery("SELECT * FROM zones WHERE id='$id'");
		}
		
		public function insert() {
			if(isset($_POST['zone_insert']))
			{
				$zone = $this->checkData($_POST['zone']);
				$meeting_point = $this->checkData($_POST['meeting_point']);
				$leader = $this->checkData($_POST['leader']);
				$phone_num = $this->checkData($_POST['phone_num']);
				

        $zone_insert = $this->makeQuery("INSERT INTO `zones`(`zone`,`leader`,`meeting_point`,`phone_num`) VALUES ('$zone','$leader','$meeting_point','$phone_num')");

        if($zone_insert)
        {
        	$this->setMessage('Zone added successfully!|alert-success');
        }
        else
        {
					$this->setMessage('Some error occurred whilst submitting your request|alert-danger');
        }

				$this->redirect('index.php?zones');
				return;
      }
			
		}


		public function update() {
			if(isset($_POST['zone_update']))
			{
				$zone = $this->checkData($_POST['zone']);
				$meeting_point = $this->checkData($_POST['meeting_point']);
				$leader = $this->checkData($_POST['leader']);
				$phone_num = $this->checkData($_POST['phone_num']);
				$zone_id = $_POST['zone_id'];
        
        $zone_update = $this->makeQuery("UPDATE `zones` SET `zone`='$zone',`meeting_point`='$meeting_point',`leader`='$leader',`phone_num`='$phone_num' WHERE id='$zone_id'");

        if($zone_update)
        {
        	$this->setMessage('Zone details updated successfully!|alert-success');
        }
        else
        {
					$this->setMessage('Some error occurred whilst submitting your request|alert-danger');
        }				
			
				$this->redirect('index.php?zones');
				return;
			}
		}


		public function deleteOne() {
			if(isset($_POST['zone_delete']))
			{
				$zone_id = $_POST['zone_id'];
					
				$zone_delete = $this->makeQuery("DELETE FROM zones WHERE id='$zone_id'");

				if($zone_delete)
	      {
	      	$this->setMessage('Zone record deleted successfully!|alert-success');
	      }
	      else
	      {
					$this->setMessage('Some error occurred whilst submitting your request|alert-danger');
	      }

				$this->redirect('index.php?zones');
				return;
			}
		}

	}

	$zone = new Zone();
 ?>