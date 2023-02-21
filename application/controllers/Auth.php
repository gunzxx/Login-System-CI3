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
				'image' => "default.svg",
				'password' => password_hash($this->input->post('password'), PASSWORD_DEFAULT),
				'role_id' => 2,
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

			$this->_sendEmail($token,'verify');

			$this->db->insert('user',$data);
			$this->db->insert('user_token',$userToken);

			$this->session->set_flashdata('success','Register success, please verify your email!');
			redirect('auth/login');
		}
    }

	public function forgot_password()
	{
		$this->form_validation->set_rules("email", "Email", "trim|required|valid_email");

		if ($this->form_validation->run() == false) {
			$data['title'] = "Forgot";
			$this->load->view('auth/header', $data);
			$this->load->view('auth/forgot');
			$this->load->view('auth/footer');
		}
		else{
			$email = $this->input->post('email');
			$cekToken = $this->db->get_where('user_token', ['email' => $email])->row_array();
			if(!$cekToken){
				$user = $this->db->get_where('user',['email'=>$email, 'is_active'=>1])->row_array();
				if($user){
					// $token = rand(0,9);
					// for($i=0;$i<5;$i++){
					// 	$token = $token.rand(0,9);
					// }
	
					// token
					$token = bin2hex(random_bytes(32));
					$userToken = [
						'email' => $email,
						'token' => $token,
						'created_at' => time(),
					];
					$this->_sendEmail($token, 'forgot');
	
					$this->db->insert('user_token', $userToken);
	
					$this->session->set_flashdata('success', 'Reset link has been send!');
					redirect('auth/login');
				}
				else{
					$this->session->set_flashdata('error', 'Email not found or not activated!');
					redirect('auth/forgot_password');
				}
			}
			else{
				$this->session->set_flashdata('error', 'Reset link has been send!');
				redirect('auth/login');
			}
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

					$this->session->set_flashdata('success', 'Account has been verified, please login!');
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
			redirect('auth/login');
		}
	}

	public function reset()
	{
		if (!($this->input->get('email') && $this->input->get('email'))) {
			redirect('auth');
		}

		$email = $this->input->get('email');
		$token = $this->input->get('token');

		$user_token = $this->db->get_where('user_token', ['token' => $token])->row_array();
		
		if ($user_token) {
			$this->form_validation->set_rules("password", "Password", "trim|min_length[3]|required|matches[password2]",[
				'matches'=> "The Password field does not match"
			]);
			$this->form_validation->set_rules("password2", "Password","trim|min_length[3]|required|matches[password]", [
				'matches' => "The Password field does not match"
			]);

			if ($this->form_validation->run() == false) {
				$data['title'] = "Reset Password";
				$this->load->view('auth/header', $data);
				$this->load->view('auth/reset');
				$this->load->view('auth/footer');
			}
			else {
				$password = $this->input->post('password');
				$password = password_hash($password, PASSWORD_DEFAULT);
				if ((time() - $user_token['created_at']) < (60 * 60 * 24)) {
					$this->db->update('user', ['password' => $password], ['email' => $email]);
	
					$this->session->set_flashdata('success', 'Password has been update, please login!');
					$this->db->delete(
						'user_token',
						['email' => $email]
					);
					redirect('auth/login');
				} else {
					$this->db->delete('user_token', ['email' => $email]);
	
					$this->session->set_flashdata('error', 'Token expired!');
					redirect('auth/login');
				}
			}
		} else {
			$this->session->set_flashdata('error', 'Wrong token!');
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

		$this->email->from('_mainaccount@gunzxx.my.id','G-Admin');
		$this->email->to($this->input->post('email',true));

		if($to == 'verify'){
			$this->email->subject("Account Verification");
			$this->email->message('<div style="height:400px;width:100%;"><p>Click this link to verify your account : </p><a style="background-color: lightblue; box-shadow: 0 0 3px #fff; text-decoration:none; color: #fff;padding: 10px;min-height:40px;border-radius: 10px;" href="' . base_url() . 'auth/verify?email=' . $this->input->post('email') . '&token=' . $token . '">Activate</a></div>');
		}

		else if($to == 'forgot'){
			$this->email->subject("Account Verification");
			$this->email->message('<div style="height:400px;width:100%;background-color:#fff;"><p>Kode verifikasi anda adalah : </p><a style="background-color: lightblue; box-shadow: 0 0 3px #fff; text-decoration:none; color: #fff;padding: 10px;min-height:40px;border-radius: 10px;" href="' . base_url() . 'auth/reset?email=' . $this->input->post('email') . '&token=' . $token . '">Activate</a></div>');
		}

		// $send = $this->email->send();
		if($this->email->send())
		{
			return true;
		}else{
			echo "Internal server  error, please refresh!";
			// echo $this->email->print_debugger();
			die;
		}
	}
}