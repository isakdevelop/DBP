<?php
  $pol = $_POST['pol'];
  $name = $_POST['name'];
  $gender = $_POST['gender'];
  $age = $_POST['age'];
  $nationality = $_POST['nationality'];
  $date_of_occurrence = $_POST['date_of_occurrence'];
  $lat = $_POST['lat'];
  $lng = $_POST['lng'];
  $address = $_POST['address'];
  $height = $_POST['height'];
  $weight = $_POST['weight'];
  $bulid = $_POST['bulid'];
  $face_shape = $_POST['face_shape'];
  $hair_color = $_POST['hair_color'];
  $hair_shape = $_POST['hair_shape'];
  $cloth = $_POST['cloth'];

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

        $sql = "INSERT INTO Missing_Person(polNum, name, gender, age, nationality, date_of_occurrence, lat, lng, address, height, weight, bulid, face_shape, hair_color, hair_shape, cloth)
        VALUES('$pol', '$name', '$gender', '$age', '$nationality', '$date_of_occurrence', '$lat', '$lng', '$address', '$height', '$weight', '$bulid', '$face_shape', '$hair_color', '$hair_shape', '$cloth')";

        if($conn -> query($sql) === TRUE){
          $sql2 = "UPDATE Missing_Person SET photo = '$target_file'"."WHERE idx='$idx'";
            if($conn -> query($sql2) === TRUE)  {
            echo "<script>";
            echo "alert('실종자 등록이 완료 되었습니다.');";
            echo "location.href='https://jj7932.cafe24.com/dbp/main.php';";
            echo "</script>";
            }
            else{
              echo "Error: " . $sql2 . "<br>" . $conn->error;
            }
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
    $sql = "INSERT INTO Missing_Person(polNum, name, gender, age, nationality, date_of_occurrence, lat, lng, address, height, weight, bulid, face_shape, hair_color, hair_shape, cloth)
    VALUES('$pol', '$name', '$gender', '$age', '$nationality', '$date_of_occurrence', '$lat', '$lng', '$address', '$height', '$weight', '$bulid', '$face_shape', '$hair_color', '$hair_shape', '$cloth')";
    if($conn -> query($sql) === TRUE){
      echo "<script>";
      echo "alert('실종자 등록이 완료 되었습니다.');";
      echo "location.href='https://jj7932.cafe24.com/dbp/main.php';";
      echo "</script>";
    }
    else{
      echo "Error: " . $sql . "<br>" . $conn->error;
    }
  }
  //########################
  // $sql = "INSERT INTO MissingPerson(photo, polNum, name, gender, age, nationality, date_of_occurrence, lat, lng, address, height, weight) VALUES('$photo', '$pol', '$name', '$gender', '$age', '$nationality', '$date_of_occurrence', '$lat', '$lng', '$address', '$height', '$weight')";
  //
  // if($conn -> query($sql) === TRUE){
  //   echo "New record created successfully";
  //   echo "<script>";
  //   echo "alert('실종자 등록이 완료 되었습니다.');";
  //   echo "location.href='https://jj7932.cafe24.com/sak/main.html';";
  //   echo "</script>";
  // }
  // else{
  //   echo "Error: " . $sql . "<br>" . $conn->error;
  // }
?>
