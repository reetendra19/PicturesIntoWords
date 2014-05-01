<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Controllers extends CI_Controller 
{

	public function __construct()
	{
		parent:: __construct();
		$this->load->model('user');
		$this->load->library('form_validation');
	}

	public function index()
	{
		$this->session->unset_userdata('counter');
		$this->load->view('front');
	}

	public function register()
	{
		// go through filter checks, send error messages if necessary
		$this->form_validation->set_rules('name', 'Name', 'trim|required|is_unique[users.name]|xss_clean');
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
		$current_user = $this->user->login($data);

		if($current_user) // IF USER EXISTS GO FORWARD --------------------->
		{
			// set $current_user in userdata:
			$this->session->set_userdata('current_user', $current_user);
			// redirect to the method that renders the next view page:
			redirect(base_url('/controllers/exercise1'));
		}
		else // if login credentials don't match database	
		{
			$this->session->set_flashdata('loginerrors', "Can't find user in database.<br>Try again? Need to register?");
			redirect(base_url('/controllers/index'));
		}
	}

	public function exercise1()
	{
		$this->session->set_userdata('counter', 1);

		$this->load->view('level_one');
	}

	public function process_ex1($option)
	{
		//first submission - typing
		if($option == 'entry')
		{
			$typing = mysql_real_escape_string($this->input->post('user_input'));
			$user_id = $this->session->userdata('current_user')['id'];
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
		else  //second submission - vote
		{
			$vote = $this->input->post('vote');
			$data['vote'] = $vote;
			$data['user_id'] = $this->session->userdata('current_user')['id'];
			$data['picture_id'] = $this->session->userdata('counter');

			$this->user->vote($data);

			$count = $this->session->userdata('counter') + 1;
			$this->session->set_userdata('counter', $count);
			// temp test repl. for the line above:
			// $this->session->set_userdata('counter', 10);
			$data['count'] = $count;
			echo json_encode($data);
		}
	}

	public function review($choice)
	{

	// Insert the last 'Next' vote: -------------
		$data['vote'] = $choice;
		$data['user_id'] = $this->session->userdata('current_user')['id'];
		$data['picture_id'] = $this->session->userdata('counter');

		$this->user->vote($data);
	// End insert the last 'Next' vote ----------
		
		// get default descriptions for review page:
		$defaults['defaults'] = $this->user->display($data);

		// get user inputs for review page:
		// $userinputs['typing'] = $this->user->display($data);

		$this->load->view('review', $defaults);
	}

	public function checkpoint()
	{
		// var_dump($this->input->post());
		// die();
		// $data['vote'] = $this->input->post('');
		// $data['user_id'] = $this->session->userdata('current_user')['id'];
		// $data['picture_id'] = $this->session->userdata('counter');

		// $this->user->vote($data);
		echo "<script type='text/javascript'>confirm('Submit your work for grading?')</script>";

		// $this->load->view('/controllers/checkpoint'));
		// $this->checkpoint();
		$this->load->view('lastpage');
	}

	// public function checkpoint()
	// {
	// 	$this->load->view('lastpage');
	// }

	public function logout()
	{
		
		$this->session->sess_destroy();
		echo "<script type='text/javascript'>alert('Building in progress - thanks for trying out the site so far.')</script>";
	}




}
?>