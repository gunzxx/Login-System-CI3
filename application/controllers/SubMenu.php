<?php
defined('BASEPATH') or exit('No direct script access allowed');

class SubMenu extends CI_Controller
{
    private $data = [];

    public function __construct()
    {
        parent::__construct();

        is_login();
        is_admin();

        $this->load->model("Submenu_model","submenu");

        $this->data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
    }

    public function index()
    {
        $this->submenu();
    }
    
    public function submenu()
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
            $this->db->insert('submenu',$this->input->post());
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
        $this->db->delete('submenu',['id' => $id]);

        $data['submenus'] = $this->submenu->getMenus();
        
        $this->load->view('submenu/deletesubmenu', $data);
    }
}
