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
        redirect('user/dashboard');
    }
    
    public function dashboard()
    {
        $data = $this->data;
        $data['active'] = 'dashboard';
        $this->template('user/index', $data);
    }
    
    public function profile()
    {
        $data = $this->data;
        $data['active'] = 'profile';
        $this->template('user/profile',$data);
    }

    private function template(string $view, $data = [])
    {
        $this->load->view('template/header', $data);
        $this->load->view('template/sidebar', $data);
        $this->load->view('template/topbar', $data);
        $this->load->view($view, $data);
        $this->load->view('template/footer', $data);
    }

    public function logout()
    {
        $this->session->unset_userdata('email');
        $this->session->unset_userdata('role_id');
        $this->session->set_flashdata('logout', 'You has been logout!');
        redirect('auth/login');
    }
}
