<?php
function uploadFile ($request, $response) {
    if (!isset($_FILES['avatar'])) {
        $result = array('massege' => 'No image data');
        $newResponse = $response->withJson($result);
        return $newResponse;
    }else{
      $files = $_FILES['avatar'];
      $temp = explode(".", $_FILES["avatar"]["name"]);
      $newfilename = round(microtime(true)) . '.' . end($temp);
      $filesize = $_FILES["avatar"]["size"];

      move_uploaded_file($_FILES["avatar"]["tmp_name"],"../img_profile/".$newfilename);

      $result = array('status' => 'success', 'massege' => array('img_name' => $newfilename,'url' => 'http://localhost/resturant_project/img_profile/'.$newfilename,'size' => $filesize));
      $newResponse = $response->withJson($result);
      return $newResponse;
    }
     
}

function insertUser ($request, $response) {
    if (!isset($_FILES['file'])) {
        $result = array('massege' => 'No image data');
        $newResponse = $response->withJson($result);
        return $newResponse;
    }else{
      $allowed =  array('gif','png' ,'JPG');
      $files = $_FILES['file'];
      $temp = explode(".", $_FILES["file"]["name"]);
      $newfilename = round(microtime(true)) . '.' . end($temp);
      $filesize = $_FILES["file"]["size"];
      $ext = pathinfo($newfilename, PATHINFO_EXTENSION);
      if( !in_array($ext,$allowed)) {
          $result = array('status' => 'error', 'massege' => 'You can only use .jpg, .png and .gif file types '.$newfilename);
          $newResponse = $response->withJson($result);
          return $newResponse;
      }else{
        move_uploaded_file($_FILES["file"]["tmp_name"],"../img_idcard/".$newfilename);

         $content[] = array('username' => $_POST['Username'], 'password' => $_POST['Pwd'], 'Fristname' => $_POST['Fristname'],'Lastname' => $_POST['Lastname'], 'IDCard' => $_POST['Idcard'], 'Birthday' => $_POST['Birthday'], 'Address' => $_POST['Address'], 'Telephone' => $_POST['Telephone'], 'ImgProfile' => $_POST['img_ProFile'], 'ImgIDCard' => $newfilename);

        $result = array('status' => 'success', 'massege' => array('url' => 'http://localhost/resturant_project/img_idcard/'.$newfilename));
        $newResponse = $response->withJson($result);
        return $newResponse;
        }  
    }     
}

function updateUser ($request, $response){
    $data = $request->getParam('data');
    $newResponse = $response->withJson(array('status' => 'success', 'massege' => $data));
    return $newResponse;
}

?>