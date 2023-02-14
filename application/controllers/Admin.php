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

    public function role()
    {
        $data = $this->data;
        $data['active']= "Role Access Management";
        $data['roles']= $this->db->get('role')->result_array();
        $this->template('admin/role', $data);
    }

    public function role_access($role_id)
    {
        $data = $this->data;
        $data['active']= "Role Access Management";
        
        $this->db->where('id !=',1);
        $data['menus'] = $this->db->get('menu')->result_array();
        
        $data['role'] = $this->db->get_where('role',['id'=>$role_id])->row_array();
        $data['title'] = "Role {$data['role']['role']} Access";
        
        $this->template('admin/access', $data);
    }

    public function add_role()
    {
        if(!$this->input->post()){
            return redirect('user');
        }
        $this->form_validation->set_rules('name',"Name", 'required|trim|min_length[3]|is_unique[role.role]',[
            "required"=>"Role name is required",
            "min_length"=>"Role min length 3"
        ]);

        if($this->form_validation->run()==false){
            $this->session->set_flashdata('error', validation_errors());
            redirect('admin/role');
        };

        $role = htmlspecialchars($this->input->post('name'),1);

        $this->db->insert('role',["role"=>$role]);
        $this->session->set_flashdata('message','Data has been added!');
        redirect('admin/role');
    }

    public function role_delete()
    {
        $id = $this->input->post('id');
        $this->db->delete('role', ['id' => $id]);

        $data['roles'] = $this->db->get('role')->result_array();

        $this->load->view('admin/ajax/role', $data);
    }

    public function ch_access()
    {
        $role_id = $this->input->post('role_id');
        $menu_id = $this->input->post('menu_id');

        $data = [
            'role_id' => $role_id,
            'menu_id' => $menu_id,
        ];

        $result = $this->db->get_where('access_menu',$data)->num_rows();
        if($result<1){
            $this->db->insert('access_menu',$data);
        }
        else{
            $this->db->delete('access_menu',$data);
        }

        echo("$role_id dan $menu_id");
        $this->session->set_flashdata('message', "Data has been changed!");
    }
}
