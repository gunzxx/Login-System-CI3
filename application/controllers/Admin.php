<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Admin extends CI_Controller
{
    private $data = [];

    public function __construct()
    {
        parent::__construct();

        is_login();
        is_admin();

        $this->data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
    }

    public function index()
    {
        redirect('admin/dashboard');
    }
    
    public function dashboard()
    {
        $data = $this->data;
        $data['active'] = 'dashboard';
        $this->template('admin/index', $data);
    }
}
