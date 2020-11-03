<?php
	class BibleQuote extends DBConfig {
		public function getAll() {
			return $this->makeQuery('SELECT * FROM bible_quotes ORDER BY 1 DESC');
		}

		public function getOne($id) {
			return $this->makeQuery("SELECT * FROM bible_quotes WHERE id='$id'");
		}
		
		public function insert() {
			if(isset($_POST['bible_quote_insert']))
			{
				$text = $this->checkData($_POST['text']);
				$verse = $this->checkData($_POST['verse']);
				$version = $this->checkData($_POST['version']);				

        $bible_quote_insert = $this->makeQuery("INSERT INTO `bible_quotes`(`text`,`verse`,`version`) VALUES ('$text','$verse','$version')");

        if($bible_quote_insert)
        {
        	$this->setMessage('Bible quote added successfully!|alert-success');
        }
        else
        {
					$this->setMessage('Some error occurred whilst submitting your request|alert-danger');
        }

				$this->redirect('index.php?bible_quotes');
				return;
      }
			
		}


		public function update() {
			if(isset($_POST['bible_quote_update']))
			{
				$text = $this->checkData($_POST['text']);
				$verse = $this->checkData($_POST['verse']);
				$version = $this->checkData($_POST['version']);
				$bible_quote_id = $_POST['bible_quote_id'];
        
        $bible_quote_update = $this->makeQuery("UPDATE `bible_quotes` SET `text`='$text',`verse`='$verse',`version`='$version' WHERE id='$bible_quote_id'");

        if($bible_quote_update)
        {
        	$this->setMessage('Bible quote details updated successfully!|alert-success');
        }
        else
        {
					$this->setMessage('Some error occurred whilst submitting your request|alert-danger');
        }				
			
				$this->redirect('index.php?bible_quotes');
				return;
			}
		}


		public function deleteOne() {
			if(isset($_POST['bible_quote_delete']))
			{
				$bible_quote_id = $_POST['bible_quote_id'];
					
				$bible_quote_delete = $this->makeQuery("DELETE FROM bible_quotes WHERE id='$bible_quote_id'");

				if($bible_quote_delete)
	      {
	      	$this->setMessage('Bible quote record deleted successfully!|alert-success');
	      }
	      else
	      {
					$this->setMessage('Some error occurred whilst submitting your request|alert-danger');
	      }

				$this->redirect('index.php?bible_quotes');
				return;
			}
		}

	}

	$bible_quote = new BibleQuote();
 ?>