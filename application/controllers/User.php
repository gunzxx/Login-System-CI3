<?php
defined('BASEPATH') or exit('No direct script access allowed');

class User extends CI_Controller
{
    private $data = [];

    public function __construct()
    {
        parent::__construct();

        if (!($this->session->userdata('email') && $this->session->userdata('role_id'))) {
            return redirect('auth/login');
        }

        $this->data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
    }

    public function index()
    {
        $this->profile();
    }
    
    public function profile()
    {
        $data = $this->data;
        $data['active'] = 'profile';
        $this->template('user/profile',$data);
    }
    
    public function edit()
    {
        $data = $this->data;
        $data['active'] = 'edit profile';
        $this->template('user/profile',$data);
    }

    public function logout()
    {
        $this->session->unset_userdata('email');
        $this->session->unset_userdata('role_id');
        $this->session->set_flashdata('logout', 'You has been logout!');
        redirect('auth/login');
    }
}
