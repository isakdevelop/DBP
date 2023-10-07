<?php
  $idx = $_GET['idx'];
  $pol = $_POST['pol'];
  $name = $_POST['name'];
  $crime = $_POST['crime'];
  $Place_of_Registration = $_POST['Place_of_Registration'];
  $address = $_POST['address'];

  $host = "jj7932.cafe24.com";
  $user = "jj7932";
  $pw = "Wowlsdl15987!";
  $dbName = "jj7932";

  $conn = new mysqli($host, $user, $pw, $dbName);

  if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
  }

  $test = $_FILES['photo']['name']=='';
  echo "<script>";
  echo "alert('$test');";
  echo "</script>";
  //#########이미지 서버 업로드 (추가)############
  if($test!=1){
    $target_dir = "./photo/";
    $target_file = $target_dir . basename($_FILES['photo']['name']);
    $uploadOk = 1;
    $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));
    #CHECK IF IMAGE FILE IS A ACTUAL IMAGE OF FAKE IMAGE

    $check = getimagesize($_FILES["photo"]["tmp_name"]);
    if($check != false){
      echo "File is an image - " . $check["mime"]. ".";
      $uploadOk = 1;
    }
    else{
      echo "File is no an image.";
      $uploadOk = 0;
    }
    if(file_exists($target_file)){
      echo "Sorry, file already exists.";
      $uploadOk = 0;
    }
    // if($photo == ''){
    //   $uploadOk = 1;
    // }
    if($imageFileType != "jpg" && $imageFileType != "jpeg" && $imageFileType != "png" && $imageFileType != "gif"){
      echo "Sorry, your file is not allowed.";
      $uploadOk = 0;
    }
    if($uploadOk == 0){
      echo "Sorry, your file was not uploaded.";
    }
    else{
      echo "<script>";
      echo "alert('$target_file');";
      echo "</script>";
      if(move_uploaded_file($_FILES["photo"]["tmp_name"], $target_file)){
        $now = date("Y-m-d");

        $sql = "UPDATE wanted SET polNum='$pol', photo='$target_file', name='$name', crime='$crime', Place_of_Registration='$Place_of_Registration', address='$address'"
        ."WHERE idx = '$idx'";
        // $sql = "INSERT INTO wanted(polNum, photo, name, crime, Place_of_Registration, address)
        // VALUES('$pol', '$target_file', '$name', '$crime', '$Place_of_Registration', '$address')";

        if($conn -> query($sql) === TRUE){
          echo "<script>";
          echo "alert('수배자 수정이 완료되었습니다.');";
          echo "location.href='https://jj7932.cafe24.com/dbp/main.php';";
          echo "</script>";
        }
        else{
          echo "Error: " . $sql . "<br>" . $conn->error;
        }
      }
      else{
        echo "Sorry, there was an error uploading your file.";
      }
    }
  }
  else{
    $sql = "UPDATE wanted SET polNum='$pol', name='$name', crime='$crime', Place_of_Registration='$Place_of_Registration', address='$address'"
    ."WHERE idx='$idx'";
    // $sql = "INSERT INTO wanted(polNum, name, crime, Place_of_Registration, address)
    // VALUES('$pol', '$name', '$crime', '$Place_of_Registration', '$address')";
    if($conn -> query($sql) === TRUE){
      echo "<script>";
      echo "alert('수배자 수정이 완료되었습니다.');";
      echo "location.href='https://jj7932.cafe24.com/dbp/main.php';";
      echo "</script>";
    }
    else{
      echo "Error: " . $sql . "<br>" . $conn->error;
    }
  }
?>
