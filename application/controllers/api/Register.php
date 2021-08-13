<?php

require APPPATH . "libraries/REST_Controller.php";

// headers
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: POST, GET");

class Register extends REST_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model("api/register_model");
        $this->load->helper(array(
            "authorization",
            "jwt"
        ));
    }

    // create  register
    public function register_post()
    {
        $data = json_decode(file_get_contents("php://input"));
        if (
            isset($data->first_name)
            && isset($data->last_name)
            && isset($data->email)
            && isset($data->gender)
            && isset($data->password)
        ) {
            if (!empty($this->register_model->is_email_exists($data->email))) {
                $this->response(array(
                    "status" => 0,
                    "message" => "Email address already exists."
                ), parent::HTTP_NOT_FOUND);
            } else {

                $register_data = array(
                    "first_name" => $data->first_name,
                    "last_name" => $data->last_name,
                    "gender" => $data->gender,
                    "email" => $data->email,
                    // "password" => sha1($data->password, PASSWORD_DEFAULT)
                    "password" => sha1($data->password),
                    // "email_verification_status" => 1,
                    // "password" => password_hash($data->password, PASSWORD_DEFAULT),
                    "status" => $this->register_model->approval_status(),
                    // "member_email_verification" => $this->Important_model->member_email_verification(),
                );
                $register_data = array_merge($register_data, $this->register_model->email_verification());
                // print_r($register_data);
                // exit;
                // echo  $this->Important_model->member_email_verification();
                // exit;
                // if ($this->Important_model->member_email_verification() == 'on') {
                //     echo "yes";
                //     exit;
                // } else {
                //     echo "no";
                //     exit;
                // }

                if ($this->register_model->create_register($register_data)) {
                    $insert_id = $this->db->insert_id();
                    $member_profile_id = strtoupper(substr(hash('sha512', rand()), 0, 8)) . $insert_id;
                    $this->db->where('member_id', $insert_id);
                    $this->db->update('member', array('member_profile_id' => $member_profile_id));



                    // if ($this->register_model->create_register($register_data)) {
                    $this->response(array(
                        "status" => 1,
                        "message" => "Registration has been created"
                    ), parent::HTTP_OK);
                } else {
                    $this->response(array(
                        "status" => 0,
                        "message" => "Failed to register"
                    ), parent::HTTP_OK);
                }
            }
        } else {
            $this->response(array(
                "status" => 0,
                "message" => "All feilds are needed"
            ), parent::HTTP_NOT_FOUND);
        }
    }




    // login api method
    public function login_post()
    {
        $data = json_decode(file_get_contents("php://input"));

        if (isset($data->email) && isset($data->password)) {
            $email = $data->email;
            $password = $data->password;

            $register_details = $this->register_model->is_email_exists($email);

            if (!empty($register_details)) {
                // email address exists
                if (password_verify($password, $register_details->password)) {

                    $token = authorization::generateToken((array)$register_details);
                    $this->response(array(
                        "status" => 1,
                        "message" => "register successfully",
                        "token" => $token

                    ), parent::HTTP_OK);
                } else {
                    $this->response(array(
                        "status" => 0,
                        "message" => "Password didn't matched "
                    ), parent::HTTP_NOT_FOUND);
                }
            } else {
                $this->response(array(
                    "status" => 0,
                    "message" => "Email address not found"
                ), parent::HTTP_NOT_FOUND);
            }
        } else {
            $this->response(array(
                "status" => 0,
                "message" => "register details needed"
            ), parent::HTTP_NOT_FOUND);
        }
    }
    // validate token method

    public function register_details_get()
    {
        $headers = $this->input->request_headers();
        // print_r($headers);
        $token = $headers['Authorization'];

        try {
            $register_data = authorization::validateToken($token);
            if ($register_data  === false) {
                // false value from validateToken method
                $this->response(array(
                    "status" => 0,
                    "message" => "Unauthorize aceess"
                ), parent::HTTP_UNAUTHORIZED);
            } else {
                // it returns data
                $register_id = $register_data->data->id;
                $this->response(array(
                    "status" => 1,
                    "message" => "register Data ",
                    "data" => $register_data,
                    "register_id" => $register_id
                ), parent::HTTP_OK);
            }
        } catch (Exception $ex) {
            $this->response(array(
                "status" => 0,
                "message" => $ex->getMessage()
            ), parent::HTTP_NOT_FOUND);
        }
    }
}
