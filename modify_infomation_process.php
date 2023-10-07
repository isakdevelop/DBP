<?php
session_start();

$userId = $_SESSION['id'] ?? '';
if($userId == ''){
  echo "<script>";
  echo "alert('로그인 후 이용해주세요!');";
  echo "location.href='https://jj7932.cafe24.com/dbp/login.php';";
  echo "</script>";
}
$mode = $_GET['mode'] ?? '';

$host = "jj7932.cafe24.com";
$user = "jj7932";
$pw = "Wowlsdl15987!";
$dbName = "jj7932";

$conn = new mysqli($host, $user, $pw, $dbName);

if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}

$sql = '';

switch($mode){
  case "user":
    $newPw = $_GET['newPw'] ?? '';
    $newEmail = $_GET['newEmail'] ?? '';
    $newPhone = $_GET['newPhone'] ?? '';
    if($newPw == ''){
      $sql = "UPDATE user_infomation SET email='$newEmail', phone='$newPhone' WHERE id='$userId'";
    }
    else{
      $sql = "UPDATE user_infomation SET pw='$newPw', email='$newEmail', phone='$newPhone' WHERE id='$userId'";
    }
    break;

  case "police":
    $newPw = $_GET['newPw'] ?? '';
    $newPhone = $_GET['newPhone'] ?? '';
    $newPsic = $_GET['newPsic'] ?? '';
    $newJurisdiction = $_GET['newJurisdiction'] ?? '';
    if($newPw == ''){
      $sql = "UPDATE Police SET phone='$newPhone', police_station_in_charge='$newPsic', jurisdiction='$newJurisdiction' WHERE polNum='$userId'";
    }
    else{
      $sql = "UPDATE Police SET pw='$newPw', phone='$newPhone', police_station_in_charge='$newPsic', jurisdiction='$newJurisdiction' WHERE polNum='$userId'";
    }
    break;
}

if($conn -> query($sql) === TRUE){
  echo "<script>";
  echo "alert('수정이 완료 되었습니다.');";
  echo "location.href='logout_process.php';";
  echo "</script>";
}
?>
