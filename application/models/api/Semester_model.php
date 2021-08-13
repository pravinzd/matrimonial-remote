<?php

class Semester_model extends CI_Model{
    public function __construct(){
        parent::__construct();

        //loading database
        $this->load->database();
        // $this->db
    }
    public function create($data){
        return $this->db>insert("message", $data);
    }
}

?>