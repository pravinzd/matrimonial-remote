<?php

class Register_model extends CI_Model
{
    public function __construct()
    {
        parent::__construct();

        //loading database
        $this->load->database();
        // $this->db
    }
    public function create_register($register_data)
    {
        return $this->db->insert("member", $register_data);
    }

    public function is_email_exists($email)
    {
        $this->db->select("*");
        $this->db->from("member");
        $this->db->where("email", $email);

        $query = $this->db->get();
        return $query->row();

        // select * from tbl_register where email = $email
    }

    // approval status
    public function approval_status()
    {
        // echo $this->db->get_where('general_settings', array('type' => 'member_approval_by_admin'))->row()->value;
        // exit;
        // return $this->db->get_where('general_settings', array('type' => 'member_approval_by_admin'))->row()->value ? "yes" : "no";

        return $this->db->get_where('general_settings', array('type' => 'member_approval_by_admin'))->row()->value == "yes" ? "pending" : "approved";
    }

    function email_verification()
    {
        $data = [];
        $member_email_verification = $this->db->get_where('general_settings', array('type' => 'member_email_verification'))->row()->value;
        $data['email_verification_code'] = null;
        if ($member_email_verification === 'on') {
            $data['email_verification_code'] = $this->Important_model->generate_key('member', 'email_verification_code', '');
            $data['email_verification_status'] = '0';
        } else {
            $data['email_verification_status'] = '1';
        }
        return $data;
    }



    // public function generate_key($member_email_verification)
    // {
    //     return $this->db->get_where('general_settings', array('type' => 'member_email_verification'))->row()->value == "on" ? "0" : "1";
    // }


    // if ($member_email_verification == 'on') {
    //     $data['email_verification_code'] = $this->Important_model->generate_key('member', 'email_verification_code', '');
    //     $data['email_verification_status'] = '0';
    // } else {
    //     $data['email_verification_status'] = '1';
    // }




}
