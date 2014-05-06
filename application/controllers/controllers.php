<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Controllers extends CI_Controller 
{

	public function index()
	{
		$this->session->unset_userdata('counter');
		$this->load->view('front');
	}

	public function register()
	{
		// go through filter checks, send error messages if necessary
		$this->form_validation->set_rules('name', 'Name', 'trim|required|xss_clean');
		$this->form_validation->set_rules('email', 'Email address', 'trim|required|valid_email|is_unique[users.email]|xss_clean');
		$this->form_validation->set_rules('password', 'Password', 'required|matches[Confirm]');

		if($this->form_validation->run() == FALSE)
		{
			$this->session->set_flashdata('regerrors', validation_errors());
			redirect(base_url('controllers/index'));
		}
		else
		{
			// transfer the post info into variables:
			$name = mysql_real_escape_string($this->input->post('name'));
			$email = mysql_real_escape_string($this->input->post('email'));
			$password = mysql_real_escape_string($this->input->post('password'));

			// put into a hash array:
			$data = array('name' => $name, 'email' => $email, 'password' => $password);

			//run the array through the 'User' method 'register':
			$this->load->model('user');
			$this->user->register($data);
		
			// go directly to the login method:
			$this->login(true);
		}
	}

	public function login($newuser=false)
	{
		if($newuser)
		{
			$this->session->set_flashdata('newuser', 'New user registered!');
		}

		// transfer post info into variables:
		$email = mysql_real_escape_string($this->input->post('email'));
		$password = mysql_real_escape_string($this->input->post('password'));

		// put into a hash array:
		$data = array('email' => $email, 'password' => $password);
	
		// run array through 'User' method 'login', put results in variable $current_user:
		$this->load->model('user');
		$current_user = $this->user->login($data);

		if($current_user) // IF USER EXISTS GO FORWARD --------------------->
		{
			// set $current_user in userdata:
			$this->session->set_userdata('current_user', $current_user);
			// redirect to the method that renders the next view page:
			redirect(base_url('/controllers/introduction'));
		}
		else // if login credentials don't match database	
		{
			$this->session->set_flashdata('loginerrors', "Invalid email/password combination.<br>Try again? Need to register?");
			redirect(base_url('/controllers/index'));
		}
	}

	public function introduction()
	{
		$this->load->view('instructions');
	}

	public function exercise1()
	{
		$this->session->set_userdata('counter', 1);

		$this->load->view('level_one');
	}

	public function process_ex1($option)
	{
		$this->load->model('user');

		//first submission - typing
		if($option == 'entry')
		{
			$typing = mysql_real_escape_string($this->input->post('user_input'));
			$user = $this->session->userdata('current_user');
			$user_id = $user['id'];
			$picture_id = $this->session->userdata('counter');
			$default_id = $this->session->userdata('counter');
			$data = array('typing' => $typing, 'user_id' => $user_id, 'picture_id' => $picture_id, 'default_id' => $default_id);

			$this->user->typinginput($data);
			$default_descr = $this->user->defaults($data);

			$data['default_descr'] = $default_descr;
		

			if($this->session->userdata('counter') == 10)
			{
				$data['complete'] = TRUE;
			}
			else
			{
				$data['complete'] = FALSE;
			}

			echo json_encode($data);
		}
		else  //second submission, vote: $option == 'preference'
		{
			$vote = $this->input->post('vote');
			$data['vote'] = $vote;
			$user = $this->session->userdata('current_user');
			$data['user_id'] = $user['id'];
			$data['picture_id'] = $this->session->userdata('counter');

			$this->user->vote($data);

			$count = $this->session->userdata('counter') + 1;
			$this->session->set_userdata('counter', $count);
			// temp test repl. for the line above:
			// $this->session->set_userdata('counter', 9);
			$data['count'] = $count;
			echo json_encode($data);
		}
	}

	public function review($choice)
	{
		$this->load->model('user');

	// Insert the last 'Next' vote: -------------
		$data['vote'] = $choice;
		$user = $this->session->userdata('current_user');
		$data['user_id'] = $user['id'];
		$data['picture_id'] = $this->session->userdata('counter');

		$this->user->vote($data);
	// End insert the last 'Next' vote ----------
		
		// get default descriptions for review page:
		$defaults['defaults'] = $this->user->display($data);

		$this->load->view('review', $defaults);
	}

	public function checkpoint()
	{
		// echo "Contents of 'this input post', from the Review page form to the checkpoint method in the controller:";
		// var_dump($this->input->post());
		// die();

		$this->load->model('user');

		$user = $this->session->userdata('current_user');
		$data['user_id'] = $user['id'];

		$data['vote'] = $this->input->post('vote_1');
		$data['picture_id'] = $this->input->post('picture_id_1');
		$this->user->updatevote($data);

		$data['vote'] = $this->input->post('vote_2');
		$data['picture_id'] = $this->input->post('picture_id_2');
		$this->user->updatevote($data);

		$data['vote'] = $this->input->post('vote_3');
		$data['picture_id'] = $this->input->post('picture_id_3');
		$this->user->updatevote($data);

		$data['vote'] = $this->input->post('vote_4');
		$data['picture_id'] = $this->input->post('picture_id_4');
		$this->user->updatevote($data);

		$data['vote'] = $this->input->post('vote_5');
		$data['picture_id'] = $this->input->post('picture_id_5');
		$this->user->updatevote($data);

		$data['vote'] = $this->input->post('vote_6');
		$data['picture_id'] = $this->input->post('picture_id_6');
		$this->user->updatevote($data);

		$data['vote'] = $this->input->post('vote_7');
		$data['picture_id'] = $this->input->post('picture_id_7');
		$this->user->updatevote($data);

		$data['vote'] = $this->input->post('vote_8');
		$data['picture_id'] = $this->input->post('picture_id_8');
		$this->user->updatevote($data);

		$data['vote'] = $this->input->post('vote_9');
		$data['picture_id'] = $this->input->post('picture_id_9');
		$this->user->updatevote($data);

		$data['vote'] = $this->input->post('vote_10');
		$data['picture_id'] = $this->input->post('picture_id_10');
		$this->user->updatevote($data);

		echo "<script type='text/javascript'>confirm('Submit your work for grading?')</script>";

		// $this->load->view('/controllers/checkpoint'));
		// $this->checkpoint();
		$this->load->view('lastpage');
	}

	public function logout()
	{
		$this->session->sess_destroy();
		$this->index();
		echo "<script type='text/javascript'>alert('Construction in progress - thanks for trying out the site so far.')</script>";
	}
}
?>