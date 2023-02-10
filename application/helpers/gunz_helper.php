<?php

function check_access(int $role_id, int $menu_id)
{
    $ci = get_instance();
    $ci->db->where("role_id",$role_id);
    $ci->db->where("menu_id",$menu_id);
    $tes = $ci->db->get('access_menu',1);
    if($tes->num_rows()<1){
        return false;
    }
    else{
        return true;
    }
}

function is_has_login()
{
    $ci = get_instance();
    if ($ci->session->userdata('email') && $ci->session->userdata('role_id')) {
        return redirect('user');
    }
}

function is_login()
{
    $ci = get_instance();
    if (!($ci->session->userdata('email') && $ci->session->userdata('role_id')))
    {
        return redirect('auth/login');
    }
    else
    {
        $role_id = $ci->session->userdata('role_id');
        $menu = $ci->uri->segment(1);
        if($menu == "submenu"){$menu = "menu";};

        $queryMenu = $ci->db->get_where('menu',['menu'=>$menu])->row_array();
        $menu_id = $queryMenu['id'];

        $accessMenu = $ci->db->get_where('access_menu',["role_id"=>$role_id, "menu_id"=>$menu_id]);
        if($accessMenu->num_rows()<1)
        {
            return redirect('page/block');
        }
    }
}

function is_admin()
{
    $ci = get_instance();
    if ($ci->session->userdata('role_id') != 1) {
        return redirect('user');
    }
}


function dd($variabel)
{
    echo $variabel;
    die;
}

function dds($variabel)
{
    var_dump($variabel);
    die;
}