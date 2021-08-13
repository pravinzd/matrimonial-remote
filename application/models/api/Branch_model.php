<?php
// if (!defined('BASEPATH')) exit('No direct script access allowed');

class Branch_model extends CI_Model
{

    public function __construct()
    {
        parent::__construct();

        //loading database
        $this->load->database();
        // $this->db
    }
    public function create($data)
    {
        return $this->db->insert("tbl_branches", $data);
    }

    public function get_all_branch()
    {

        $this->db->select("*");
        $this->db->from("tbl_branches");
        $this->db->order_by("id", "DESC");
        $query = $this->db->get();
        return $query->result();
    }

    public function delete_branch($branch_id)
    {

        $this->db->select("*");
        $this->db->from("tbl_branches");
        $this->db->where("id", $branch_id);
        $query = $this->db->get();
        $branch = $query->row();

        if (!empty($branch)) {
            $this->db->where("id", $branch_id);
            return $this->db->delete("tbl_branches");
            // delete from tbl_branches where id = $branch_id
        }
        return FALSE;
    }
}
