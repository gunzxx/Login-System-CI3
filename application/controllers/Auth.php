<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Auth extends CI_Controller 
{
	public function __construct()
	{
		parent::__construct();

		if ($this->session->userdata('email') && $this->session->userdata('role_id')) {
			return redirect('user');
		}

		$this->load->library('form_validation');
	}

	public function index()
	{
		redirect('auth/login');
	}
	
	public function login()
	{
		$this->form_validation->set_rules("email","Email","trim|required|valid_email");
		$this->form_validation->set_rules("password","Password","trim|required");

		if ($this->form_validation->run() == false)
		{
			$data['title'] = "Login";
			$this->load->view('auth/header',$data);
			$this->load->view('auth/login');
			$this->load->view('auth/footer');
		}
		else
		{
			$email = $this->input->post('email');
			$password = $this->input->post('password');

			$user = $this->db->get_where('user',['email'=>$email])->row_array();
			if($user)
			{
				if($user['is_active']){
					if(password_verify($password, $user['password']))
					{
						$data = [
							'email' => $user['email'],
							'role_id' => $user['role_id'],
						];

						$this->session->set_userdata($data);
						redirect('user');
					}
					else
					{
						$this->session->set_flashdata('login', 'Wrong password');
						redirect('auth/login');
					}
				}
				else{
					$this->session->set_flashdata('login', 'Account is not confirm, please activate your email!');
					redirect('auth/login');
				}
			}
			else
			{
				$this->session->set_flashdata('login', 'Data not found');
				redirect('auth/login');
			}
		}
	}

    public function register()
    {
		$this->form_validation->set_rules('nickname','Nickname','required|trim');
		$this->form_validation->set_rules('email','Email','required|trim|valid_email|is_unique[user.email]',[
			"is_unique" => "Email has been use."
		]);
		$this->form_validation->set_rules('password','Password','required|trim|min_length[3]|matches[password2]',[
			'required' => 'Password required!',
			'matches' => "Password don't match!",
			"min_length" => "Password to short!"
		]);
		$this->form_validation->set_rules('password2','Password','required|trim|min_length[3]|matches[password]');

		if($this->form_validation->run() == false){
			$data['title'] = "Register";
			$this->load->view('auth/header', $data);
			$this->load->view('auth/register');
			$this->load->view('auth/footer');
		}else{
			// echo password_hash($this->input->post('password'), PASSWORD_DEFAULT);exit;die;
			$data = [
				'nickname' => htmlspecialchars($this->input->post('nickname')),
				'email' => htmlspecialchars($this->input->post('email',true)),
				'image' => "default.jpg",
				'password' => password_hash($this->input->post('password'), PASSWORD_DEFAULT),
				'role_id' => 1,
				'is_active' => 1,
				'date_created' => time(),
			];
			$this->db->insert('user',$data);

			$this->session->set_flashdata('register','success');
			redirect('auth/login');
		}
    }
}