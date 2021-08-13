<?php

class Branch_model extends CI_Model{
    public function __construct(){
        parent::__construct();

        //loading database
        $this->load->database();
        // $this->db
    }
    public function create($data){
        return $this->db>insert("tbl_branches", $data);
    }
}

?>