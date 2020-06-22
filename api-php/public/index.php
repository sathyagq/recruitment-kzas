<?php
require "../bootstrap.php";

header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: OPTIONS,GET,POST,PUT,DELETE");
header("Access-Control-Max-Age: 3600");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");

$requestMethod = $_SERVER["REQUEST_METHOD"];

if($requestMethod === 'POST') {
  $response = array();
  if($_FILES) {
    if(is_uploaded_file($_FILES["logo"]["tmp_name"])) {

      $tmp_file = $_FILES["logo"]["tmp_name"]; //get file from client
      $img = $_FILES["logo"]["name"]; //get file name
      $img_name = pathinfo($img,PATHINFO_FILENAME);
      $extension = pathinfo($img, PATHINFO_EXTENSION);

      if($extension != "png" && $extension != "jpg" && $extension != "jpeg" ) {
        $response["status"] = "error";
        $response["message"] = "Extension not supported.";
      } else {
        $upload_dir = "storage/".$img_name.".".$extension;
        $i = 1;

        while (file_exists($upload_dir)) {
          $actual_name = $img_name."(".$i.")";
          $upload_dir = "storage/".$actual_name.".".$extension;
          $i++;
        }

        if(move_uploaded_file($tmp_file, $upload_dir)) {
          $response["status"] = "success";
          $response["message"] = "Logo in storage.";
          $response["logo_url"] = "http://"."$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]".$upload_dir;
        } else {
          $response["status"] = "error";
          $response["message"] = "Something went wrong.";
        }
      }
    }
  } else {
    $response["status"] = "error";
    $response["message"] = "No file in request.";
  }
  echo json_encode($response);
}





