<?php

require APPPATH . "libraries/REST_Controller.php";

// headers
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: POST, GET");

class Student extends REST_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model("api/student_model");
        $this->load->helper(array(
            "authorization",
            "jwt"
        ));
    }

    // create  Student
    public function register_post()
    {
        $data = json_decode(file_get_contents("php://input"));
        if (isset($data->name)  && isset($data->email) && isset($data->branch_id) && isset($data->phone) && isset($data->password) && isset($data->gender)) {
            if (!empty($this->student_model->is_email_exists($data->email))) {
                $this->response(array(
                    "status" => 0,
                    "message" => "Email address already exists."
                ), parent::HTTP_NOT_FOUND);
            } else {
                $student_data = array(
                    "name" => $data->name,
                    "email" => $data->email,
                    "phone" => $data->phone,
                    "branch_id" => $data->branch_id,
                    "password" => password_hash($data->password, PASSWORD_DEFAULT),
                    "gender" => $data->gender
                );

                if ($this->student_model->create_student($student_data)) {
                    $this->response(array(
                        "status" => 1,
                        "message" => "Student has been created"
                    ), parent::HTTP_OK);
                } else {
                    $this->response(array(
                        "status" => 0,
                        "message" => "Failed to delet Student"
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

    // list Student
    public function list_get()
    {

        $data =  $this->student_model->students_list();

        if ($data > 0) {
            $this->response(array(
                "status" => 1,
                "Message" => "Students  list",
                "data" => $data
            ), parent::HTTP_OK);
        } else {
            $this->response(array(
                "status" => 0,
                "message" => "No Student list found"
            ), parent::HTTP_NOT_FOUND);
        }
    }

    // update student details
    public function update_details_put()
    {
        $data = json_decode(file_get_contents("php://input"));
        if (isset($data->id) && isset($data->name) && isset($data->email) && isset($data->phone) && isset($data->branch_id) && isset($data->gender)) {
            $student_data = array(
                "name" => $data->name,
                "email" => $data->email,
                "phone" => $data->phone,
                "branch_id" => $data->branch_id,
                "gender" => $data->gender
            );

            if ($this->student_model->update_student($data->id, $student_data)) {
                $this->response(array(
                    "status" => 1,
                    "message" => "Student has been successfully updated"
                ), parent::HTTP_OK);
            } else {
                $this->response(array(
                    "status" => 0,
                    "message" => "Failed to update student data"
                ), parent::HTTP_INTERNAL_SERVER_ERROR);
            }
        } else {
            $this->response(array(
                "status" => 0,
                "message" => "All fields are needed"
            ), parent::HTTP_NOT_FOUND);
        }
    }
    // Delete Student 
    public function delete_student_delete()
    {
        $data = json_decode(file_get_contents("php://input"));

        if (isset($data->id)) {

            if ($this->student_model->find_by_id($data->id)) {
                if (!empty($this->student_model->delete_student($data->id))) {
                    $this->response(array(
                        "status" => 1,
                        "message" => "Student has been deleted"
                    ), parent::HTTP_OK);
                } else {
                    $this->response(array(
                        "status" => 0,
                        "message" => "Failed to Delete student"
                    ), parent::HTTP_INTERNAL_SERVER_ERROR);
                }
            } else {
                $this->response(array(
                    "status" => 0,
                    "message" => "Student doesn't exists"
                ), parent::HTTP_NOT_FOUND);
            }
        } else {
            $this->response(array(
                "status" => 0,
                "message" => "Student Id should be needed"
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

            $student_details = $this->student_model->is_email_exists($email);

            if (!empty($student_details)) {
                // email address exists
                if (password_verify($password, $student_details->password)) {

                    $token = authorization::generateToken((array)$student_details);
                    $this->response(array(
                        "status" => 1,
                        "message" => "Login successfully",
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
                "message" => "Login details needed"
            ), parent::HTTP_NOT_FOUND);
        }
    }
    // validate token method

    public function student_details_get()
    {
        $headers = $this->input->request_headers();
        // print_r($headers);

        $token = $headers['Authorization'];

        try {
            $student_data = authorization::validateToken($token);

            if ($student_data  === false) {
                // false value from validateToken method
                $this->response(array(
                    "status" => 0,
                    "message" => "Unauthorize aceess"
                ), parent::HTTP_UNAUTHORIZED);
            } else {
                // it returns data
                $student_id = $student_data->data->id;

                $this->response(array(
                    "status" => 1,
                    "message" => "Student Data ",
                    "data" => $student_data,
                    "student_id" => $student_id
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
