<?php
  $id = $_GET['id'];
  $password = $_GET['pw'];
  $name = $_GET['name'];
  $pol = $_GET['pol'];
  $dep = $_GET['dep'];
  $phone = $_GET['phone'];

  $host = "jj7932.cafe24.com";
  $user = "jj7932";
  $pw = "Wowlsdl15987!";
  $dbName = "jj7932";

  $conn = new mysqli($host, $user, $pw, $dbName);

  if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
  }

  $sql = "INSERT INTO Police(polNum, pw, name, police_station_in_charge, jurisdiction, phone) VALUES('$id', '$password', '$name', '$pol', '$dep', '$phone')";

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
