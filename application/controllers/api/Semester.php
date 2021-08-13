<?php

// include APPPATH."libraries/REST_Controller.php";
require APPPATH . "libraries/REST_Controller.php";
// headers
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methiods: POST, GET");

class Semester extends REST_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->helper(array(
            "authorization",
            "jwt"
        ));
        $this->load->model("api/semester_model");
    }
    // create  Project
    public function create_project_post()
    {
        $data = json_decode(file_get_contents("php://input"));

        $headers = $this->input->request_headers();

        $token = $headers['Authorization'];
        try {
            $student_data = authorization::validateToken($token);

            if ($student_data === false) {

                $this->response(array(
                    "status" => 0,
                    "message" => "Unauthorize Token"

                ), parent::HTTP_UNAUTHORIZED);
            } else {

                $student_id = $student_data->data->id;

                if (isset($data->title) && isset($data->level) &&  isset($data->complete_days) &&  isset($data->semester)) {

                    $project_arr_data = array(
                        "student_id" => $student_id,
                        "title" => $data->title,
                        "level" => $data->level,
                        "description" => isset($data->description) ? $data->description : "",
                        "complete_days" => $data->complete_days,
                        "semester" => $data->semester
                    );
                    if ($this->semester_model->create_project($project_arr_data)) {
                        $this->response(array(
                            "status" => 1,
                            "message" => "Project has been created"
                        ), parent::HTTP_OK);
                    } else {
                        $this->response(array(
                            "status" => 0,
                            "message" => "Failed to create Project"
                        ), parent::HTTP_NOT_FOUND);
                    }
                } else {
                    $this->response(array(
                        "status" => 0,
                        "message" => "all fields are needed"
                    ), parent::HTTP_NOT_FOUND);
                }
            }
        } catch (Exception $ex) {
            $this->response(array(
                "status" => 0,
                "message" => $ex->getMessage()

            ), parent::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

    // list Projects
    public function projects_list_get()
    {
        $projects = $this->semester_model->get_all_projects();

        if (count($projects) > 0) {
            $this->response(array(
                "status" => 1,
                "message" => "Projects found",
                "projects" =>  $projects
            ), parent::HTTP_OK);
        } else {
            $this->response(array(
                "status" => 0,
                "message" => "No Projects found"
            ), parent::HTTP_NOT_FOUND);
        }
    }

    // lisying projects by student

    public function get_student_projects_get()
    {
        $headers = $this->input->request_headers();
        $token = $headers["Authorization"];

        try {
            $student_data = authorization::validateToken($token);

            if ($student_data === false) {
                $this->response(array(
                    "status" => 1,
                    "message" => "Unauthorize Access"
                ), parent::HTTP_UNAUTHORIZED);
            } else {
                $student_id = $student_data->data->id;
                $projects = $this->semester_model->get_student_projects($student_id);

                $this->response(array(
                    "status" => 1,
                    "message" => "Projects Found",
                    "Projects" =>  $projects
                ), parent::HTTP_OK);
            }
        } catch (Exception $ex) {
            $this->response(array(
                "status" => 0,
                "message" => $ex->getMessage()
            ), parent::HTTP_NOT_FOUND);
        }
    }

    // Delete Projects by Student
    public function delete_projects_delete()
    {
        $headers = $this->input->request_headers();

        $token = $headers['Authorization'];

        try {
            $student_data = AUTHORIZATION::validateToken($token);

            if ($student_data === false) {
                $this->response(array(
                    "status" => 0,
                    "message" => "Unauthorize Access"
                ), parent::HTTP_UNAUTHORIZED);
            } else {
                $student_id = $student_data->data->id;
                if ($this->semester_model->delete_projects($student_id)) {
                    $this->response(array(
                        "status" => 1,
                        "message" => "Projects has been deleted"
                    ), parent::HTTP_OK);
                } else {
                    $this->response(array(
                        "status" => 0,
                        "message" => "Failed to delete Projects"
                    ), parent::HTTP_INTERNAL_SERVER_ERROR);
                }
            }
        } catch (Exception $ex) {
            $this->response(array(
                "status" => 0,
                "message" => $ex->getMessage()
            ), parent::HTTP_NOT_FOUND);
        }
    }
}
