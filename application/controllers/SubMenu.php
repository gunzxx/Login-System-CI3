<?php
defined('BASEPATH') or exit('No direct script access allowed');

class SubMenu extends CI_Controller
{
    private $data = [];

    public function __construct()
    {
        parent::__construct();

        if (!($this->session->userdata('email') && $this->session->userdata('role_id'))) {
            return redirect('auth/login');
        }

        if ($this->session->userdata('role_id') != 1) {
            return redirect('user');
        }

        $this->load->model("Sub_menu_model","submenu");

        $this->data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
    }

    public function index()
    {
        $this->manage();
    }
    
    public function manage()
    {
        $data = $this->data;

        $data['submenus'] = $this->submenu->getMenus();
        $data['menus'] = $this->db->get('menu')->result_array();

        $data['active'] = 'sub menu management';

        $this->form_validation->set_rules('title','Title',"required");
        $this->form_validation->set_rules('menu_id','Menu',"required");
        $this->form_validation->set_rules('url','url',"required");
        $this->form_validation->set_rules('icon','icon',"required");

        // var_dump($this->input->post());die;
        if($this->form_validation->run()==false){
            $this->template('submenu/manage',$data);
        }
        else{
            $this->db->insert('sub_menu',$this->input->post());
            $this->session->set_flashdata('message', 'Menu has been added!');
            redirect('submenu/manage');
        }
    }

    public function delete()
    {
        if($this->input->post('id') == null){
            echo json_encode("gagal");
        }
        $id = $this->input->post('id');
        $this->db->delete('sub_menu',['id' => $id]);

        $data['submenus'] = $this->submenu->getMenus();
        
        $this->load->view('submenu/deletesubmenu', $data);
    }
}
