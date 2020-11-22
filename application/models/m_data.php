<?php

class M_data extends CI_Model
{
    public function allData($table)
    {
        $data = $this->db->get($table);
        return $data;
    }

    public function byData($table, $data)
    {
        $query = $this->db->get_where($table, $data);
        return $query;
    }

    public function tambah($table, $data)
    {
        if ($this->db->insert($table, $data)) {
            return 1;
        } else {
            return 0;
        }
    }

    public function edit($table, $data, $id)
    {
        $this->db->where('id', $id);
        if ($this->db->update($table, $data)) {
            return 1;
        } else {
            return 0;
        }
    }

    public function hapus($id, $table)
    {
        if ($this->db->delete($id, $table)) {
            return 1;
        } else {
            return 0;
        }
    }
}
