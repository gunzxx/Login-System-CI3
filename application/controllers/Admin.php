<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Admin extends CI_Controller
{
    private $data = [];

    public function __construct()
    {
        parent::__construct();

        if (!($this->session->userdata('email') && $this->session->userdata('role_id'))) {
            return redirect('auth/login');
        }

        if($this->session->userdata('role_id') != 1)
        {
            return redirect('user');
        }

        $this->data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
    }

    public function index()
    {
        $this->dashboard();
    }
    
    public function dashboard()
    {
        $data = $this->data;
        $data['active'] = 'dashboard';
        $this->template('admin/index', $data);
    }
}
