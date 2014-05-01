<?php 
	class User extends CI_Model
	{
		public function register($data)
		{
			date_default_timezone_set("America/Los_Angeles");

			// put some escape_this_string notations in here for all 3 fields:
			$query = "INSERT INTO user (name, email, password, created_at, updated_at) 
					  VALUES ('{$data['name']}','{$data['email']}','{$data['password']}', NOW(), NOW())";
			
			$this->db->query($query);
		}

		public function login($data)
		{
			$query = "SELECT * FROM user 
					  WHERE email = '{$data['email']}' AND password = '{$data['password']}'";
			return $this->db->query($query)->row_array();
		}

		public function typinginput($data)
		{
			$query = "INSERT INTO userinput (typing, user_id, picture_id, created_at, updated_at) 
				VALUES ('{$data['typing']}', {$data['user_id']}, '{$data['picture_id']}', NOW(), NOW())";
			$this->db->query($query);
		}

		public function defaults($data)
		{
			// retrieve the default description of the present pic:

			$query = "SELECT default_descr FROM picture WHERE id = '{$data['picture_id']}'"; 

			return $this->db->query($query)->row_array();
		}

		public function vote($data)
		{
			// Update the entry made in typinginput, adding a preference vote of 1, 2 or 3 -
			// Also works for the review page:
			$query = "UPDATE userinput 
					  SET vote = '{$data['vote']}'
					  WHERE user_id = '{$data['user_id']}'
					  AND picture_id = '{$data['picture_id']}'";
			$this->db->query($query);
		}

		public function display($data)
		{
			// get the default description and database id# of each picture (this query works)--
			$query = "SELECT userinput.*, picture.default_descr, picture.id
					  FROM userinput
					  LEFT JOIN picture
					  ON userinput.picture_id = picture.id
					  WHERE userinput.user_id = '{$data['user_id']}' AND picture.id BETWEEN 1 AND 10
					  ORDER BY userinput.created_at DESC
					  LIMIT 10";
		
			return $this->db->query($query)->result_array();
		}

		public function usersdisplay()
		{
			$query = "SELECT typing FROM userinput";
		}









	}
 ?>