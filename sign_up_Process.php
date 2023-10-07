<?php
  $id = $_GET['id'];
  $password = $_GET['pw'];
  $checkpassword = $_GET['cpw'];
  $name = $_GET['name'];
  $year = $_GET['year'];
  $month = $_GET['month'];
  $day = $_GET['day'];
  $gender = $_GET['gender'];
  $email = $_GET['email'];
  $phone = $_GET['phone'];
  $yymmdd = $year.$month.$day;

  $host = "jj7932.cafe24.com";
  $user = "jj7932";
  $pw = "Wowlsdl15987!";
  $dbName = "jj7932";

  $conn = new mysqli($host, $user, $pw, $dbName);

  if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
  }

  $sql = "INSERT INTO user_infomation(id, pw, name, yymmdd, gender, email, phone) VALUES('$id', '$password', '$name', '$yymmdd', '$gender', '$email', '$phone')";

  if($conn -> query($sql) === TRUE){
    echo "New record created successfully";
    echo "<script>";
    echo "alert('회원가입이 완료 되었습니다.');";
    echo "location.href='https://jj7932.cafe24.com/dbp/main.php';";
    echo "</script>";
  }
  else{
    echo "Error: " . $sql . "<br>" . $conn->error;
  }
?>
