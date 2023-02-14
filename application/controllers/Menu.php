<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Menu extends CI_Controller
{
    private $data = [];

    public function __construct()
    {
        parent::__construct();

        is_login();

        $this->data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
    }

    public function index()
    {
        $this->manage();
    }
    
    public function manage()
    {
        $data = $this->data;
        $data['menus'] = $this->db->get('menu')->result_array();

        $data['active'] = 'menu management';

        $this->form_validation->set_rules('menu','Menu',"required|trim|min_length[3]|is_unique[menu.menu]",[
            'required'=>"Menu is required!",
            'min_length' => "The Menu field must be 3 characters length.",
            "is_unique" => "Menu exist!",
        ]);

        if($this->form_validation->run()==false){
            $this->template('menu/manage',$data);
        }
        else{
            $this->db->insert('menu',['menu' => ucwords($this->input->post('menu'))]);
            $this->session->set_flashdata('message', 'Menu has been added!');
            redirect('menu/manage');
        }
    }

    public function delete()
    {
        if($this->input->post('id') == null){
            echo json_encode("gagal");
        }
        $id = $this->input->post('id');
        $this->db->delete('submenu',['menu_id' => $id]);
        $this->db->delete('access_menu',['menu_id' => $id]);
        $this->db->delete('menu',['id' => $id]);

        $data['menus'] = $this->db->get('menu')->result_array();
        
        $this->load->view('menu/ajax/delete', $data);
    }
}
