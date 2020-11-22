<?php

class M_login extends CI_Model
{
    public function login($table, $data)
    {
        $data = $this->db->get_where($table, $data);
        return $data;
    }
}
