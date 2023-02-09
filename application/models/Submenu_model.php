<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Submenu_model extends CI_Model{
    public function getMenus()
    {
        $query = "
                    SELECT submenu.*, menu.menu
                    FROM submenu
                    JOIN menu
                    ON submenu.menu_id = menu.id
                ";
        return $this->db->query($query)->result_array();
    }
}