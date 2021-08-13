<?php

// include APPPATH."libraries/REST_Controller.php";
require APPPATH . "libraries/REST_Controller.php";
// headers
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: POST, GET");

class Branch extends REST_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model("api/branch_model");
        $this->load->helper("security");
        // $this->load->helper(array(
        //     "authorization",
        //     "jwt"
        // ));
    }
    // create branch
    public function create_post()
    {

        $data = json_decode(file_get_contents("php://input"));

        if (isset($data->name)) {

            $branch_name = $this->security->xss_clean($data->name);

            $branch_data = array(
                "name" => $branch_name
            );
            if ($this->branch_model->create($branch_data)) {
                $this->response(array(
                    "status" => 1,
                    "message" => "Branch has been created!"
                ), parent::HTTP_OK);
            } else {
                $this->response(array(
                    "status" => 0,
                    "message" => "Failded to create branch!"
                ), parent::HTTP_OK);
            }
        } else {
            $this->response(array(
                "status" => 0,
                "message" => "Branch Name should be needed."
            ), parent::HTTP_NOT_FOUND);
        }
    }

    // list Branches
    public function list_get()
    {
        $branch_list = $this->branch_model->get_all_branch();

        if (count($branch_list) > 0) {
            // we have branch list
            $this->response(array(
                "status" => 1,
                "message" => "Branch list",
                "data" => $branch_list
            ));
        } else {
            //No data we have
            $this->response(array(
                "status" => 0,
                "message" => "No data found"
            ), parent::HTTP_NOT_FOUND);
        }
    }

    // delete api Methods
    public function delete_branch_delete()
    {
        $data = json_decode(file_get_contents("php://input"));
        if (isset($data->branch_id)) {
            // we have branch id
            if ($this->branch_model->delete_branch($data->branch_id)) {
                $this->response(array(
                    "status" => 1,
                    "message" => "Deleted Branch"
                ), parent::HTTP_OK);
            } else {
                $this->response(array(
                    "status" => 0,
                    "message" => "Failed to delete branch"
                ), parent::HTTP_INTERNAL_SERVER_ERROR);
            }
        } else {
            //  We are missing branch id
            $this->response(array(
                "status" => 0,
                "message" => "Branch id needed"
            ), parent::HTTP_NOT_FOUND);
        }
    }
}
