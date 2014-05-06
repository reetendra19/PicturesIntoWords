<?php 
	class User extends CI_Model
	{
		public function register($data)
		{
			date_default_timezone_set("America/Los_Angeles");

			$query = "INSERT INTO users (name, email, password, created_at, updated_at) 
					  VALUES ('{$data['name']}','{$data['email']}','{$data['password']}', NOW(), NOW())";
			
			$this->db->query($query);
		}

		public function login($data)
		{
			$query = "SELECT * FROM users 
					  WHERE email = '{$data['email']}' AND password = '{$data['password']}'";
			return $this->db->query($query)->row_array();
		}

		public function typinginput($data)
		{
			$query = "INSERT INTO userinputs (typing, user_id, picture_id, created_at, updated_at) 
				VALUES ('{$data['typing']}', {$data['user_id']}, '{$data['picture_id']}', NOW(), NOW())";
			$this->db->query($query);
		}

		public function defaults($data)
		{
			// retrieve the default description of the present pic:
			// $query = "SELECT default_descr FROM pictures WHERE id = '{$data['picture_id']}'";
			// retrieve the default description as well as the just-inputted user typing for the present pic:
			$query = "SELECT typing, picture_id, default_descr
					  FROM userinputs 
					  LEFT JOIN pictures ON pictures.id = userinputs.picture_id 
					  WHERE user_id = '{$data['user_id']}' AND picture_id = '{$data['picture_id']}'
					  ORDER BY userinputs.created_at DESC";

			return $this->db->query($query)->row_array();
		}

		public function display($data)
		{
			// get the default description and database id# of each picture (this query works)--
			$query = "SELECT userinputs.*, pictures.default_descr, pictures.id
					  FROM userinputs
					  LEFT JOIN pictures
					  ON userinputs.picture_id = pictures.id
					  WHERE userinputs.user_id = '{$data['user_id']}' AND pictures.id BETWEEN 1 AND 10
					  ORDER BY userinputs.created_at DESC
					  LIMIT 10";
		
			return $this->db->query($query)->result_array();
		}

		public function vote($data)
		{
			// Inserts the preference vote of 1, 2 or 3 -
			$query = "UPDATE userinputs 
					  SET vote = '{$data['vote']}'
					  WHERE user_id = '{$data['user_id']}'
					  AND picture_id = '{$data['picture_id']}'";
			$this->db->query($query);
		}

		public function updatevote($data)
		{
			// echo "Contents of dollar-data, sent from the controller to the model: (we're looking for vote, user_id, and picture_id)";
			// var_dump($data);
			// die();
			// Update the entry made in typinginput, adding a preference vote of 1, 2 or 3 -
			
				$query = "UPDATE userinputs 
						  SET vote = '{$data['vote']}', updated_at = NOW()
						  WHERE user_id = '{$data['user_id']}'
						  AND picture_id = '{$data['picture_id']}'";
				$this->db->query($query);

			// the query that works for one update:

			// 	UPDATE userinputs 
			// 	SET vote = '3'
			// 	WHERE user_id = '5'
			// 	AND picture_id = '9'

		}

		public function usersdisplay()
		{
			$query = "SELECT typing FROM userinputs";
		}
	}
 ?>