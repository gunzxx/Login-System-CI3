<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Auth extends CI_Controller 
{
	public function __construct()
	{
		parent::__construct();

		is_has_login();
	}

	public function index()
	{
		// $this->login();
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
			// data user
			$postEmail = $this->input->post('email', true);
			$data = [
				'nickname' => htmlspecialchars($this->input->post('nickname')),
				'email' => htmlspecialchars($postEmail),
				'image' => "default.jpg",
				'password' => password_hash($this->input->post('password'), PASSWORD_DEFAULT),
				'role_id' => 1,
				'is_active' => 0,
				'date_created' => time(),
			];

			// token
			$token = bin2hex(random_bytes(32));
			$userToken = [
				'email' => $postEmail,
				'token' => $token,
				'created_at' => time(),
			];
			// dd($token);

			$this->db->insert('user',$data);
			$this->db->insert('user_token',$userToken);

			$this->_sendEmail($token,'verify');

			$this->session->set_flashdata('register','Register success, please verify your email!');
			redirect('auth/login');
		}
    }

	public function verify(){
		if(!($this->input->get('email') && $this->input->get('email'))){
			redirect('auth');
		}
		$email = $this->input->get('email');
		$token = $this->input->get('token');
		
		$user = $this->db->get_where('user',['email'=>$email])->row_array();
		if($user){
			$user_token = $this->db->get_where('user_token',['token'=>$token])->row_array();
			// dds($user_token);
			if($user_token){
				if((time() - $user_token['created_at']) < (60*60*24)){
					$this->db->update('user',['is_active'=>1],['email'=>$email]);

					$this->session->set_flashdata('register', 'Account has been verified, please login!');
					$this->db->delete(
					'user_token', ['email' => $email]);
					redirect('auth/login');
				}else{
					$this->db->delete('user',['email'=>$email]);
					$this->db->delete('user_token',['email'=>$email]);

					$this->session->set_flashdata('error', 'Token expired!');
					redirect('auth/login');
				}
			}
			else{
				$this->session->set_flashdata('error', 'Wrong token!');
				redirect('auth/login');
			}
		}
		else{
			$this->session->set_flashdata('error', 'Wrong email!');
			redirect('auth/login');
		}
	}

	private function _sendEmail(string $token, string $to = 'verify')
	{
		$config = [
			'mailtype'  => 'html',
			'charset'   => 'utf-8',
			'protocol'  => 'smtp',
			'smtp_host' => 'ssl://mail.gunzxx.my.id',
			'smtp_user' => 'admin@gunzxx.my.id',
			'smtp_pass' => 'Sandiuno_',
			'smtp_port' => 465,
			'newline'   => "\r\n",
		];

		$this->load->library('email',$config);
		$this->email->initialize($config);

		$this->email->from('admin@gunzxx.my.id','G-Admin');
		$this->email->to($this->input->post('email',true));

		if($to == 'verify'){
			$this->email->subject("Account Verification");
			$this->email->message('Click this link to verify your account : <a href="'.base_url().'auth/verify?email='. $this->input->post('email', true) . '&token='.$token .'">Activate</a>');
		}

		if($this->email->send())
		{
			return true;
		}else{
			echo $this->email->print_debugger();
			die;
		}
	}
}