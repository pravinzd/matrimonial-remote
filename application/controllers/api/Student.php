<?php

// include APPPATH."libraries/REST_Controller.php";
require APPPATH."libraries/REST_Controller.php";
// headers
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methiods: POST, GET");

class Student extends REST_Controller{
public function __construct(){
    parent::__construct();
    $this->load->model("api/student_model");
    $this->load->helper(array(
        "authorization",
        "jwt"
    ));
}
// create  Student
public function register_post(){

$data = json_decode(file_get_contents("php://input"));

if(issets($data->name)){
     $message_data = array(
           "message_text" => $data->message_text
     );
    if($this->message_model->create($message_data)){
      $this->response(array(
          "status" => 1,
          "message" => "Stroy has been created"
      ), parent::HTTP_OK);
    }else{
        $this->response(array(
            "status" => 0,
            "message" => "FaildedStroy has not created"
        ), parent::HTTP_OK);
    }

}else{
    $this->response(array(
        "status" => 0,
        "message" => "Happy Story should be needed."
    ), parent::HTTP_NOT_FOUND);
}

}

// list Student
// read
public function list_get(){

}


}
?>
