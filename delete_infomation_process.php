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
    $sql = "DELETE FROM user_infomation WHERE id='$userId'";
    break;

  case "police":
    $sql = "DELETE FROM Police WHERE polNum='$userId'";
    break;
}

if($conn -> query($sql) === TRUE){
  echo "<script>";
  echo "alert('탈퇴가 완료 되었습니다.');";
  echo "location.href='logout_process.php';";
  echo "</script>";
}
?>
