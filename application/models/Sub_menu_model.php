<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Sub_menu_model extends CI_Model{
    public function getMenus()
    {
        $query = "
                    SELECT sub_menu.*, menu.menu
                    FROM sub_menu
                    JOIN menu
                    ON sub_menu.menu_id = menu.id
                ";
        return $this->db->query($query)->result_array();
    }
}