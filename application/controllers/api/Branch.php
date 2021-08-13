<?php

// include APPPATH."libraries/REST_Controller.php";
require APPPATH."libraries/REST_Controller.php";
// headers
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methiods: POST, GET");

class  Branch extends REST_Controller{
public function __construct(){
    parent::__construct();
    $this->load->model("api/branch_model");
    // $this->load->helper(array(
    //     "authorization",
    //     "jwt"
    // ));
}
// create branch
public function create_post(){

$data = json_decode(file_get_contents("php://input"));

if(issets($data->name)){
     $branch_data = array(
           "name" => $data->name
     );
    if($this->branch_model->create($branch_data)){
      $this->response(array(
          "status" => 1,
          "message" => "Branch has been created!"
      ), parent::HTTP_OK);
    }else{
        $this->response(array(
            "status" => 0,
            " " => "Failded to crate branch!"
        ), parent::HTTP_OK);
    }

}else{
    $this->response(array(
        "status" => 0,
        "message" => "Branch Name sould be needed."
    ), parent::HTTP_NOT_FOUND);
}

}

// list Branches
// read
public function list_get(){

}


}
?>
