<?php
$mode = $_GET['mode'];
$idx = $_GET['idx'];
$photo = $_GET['photo'];

$host = "jj7932.cafe24.com";
$user = "jj7932";
$pw = "Wowlsdl15987!";
$dbName = "jj7932";

$conn = new mysqli($host, $user, $pw, $dbName);

if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}
$sql ='';
switch($mode){
  case "mp":
    $sql = "DELETE FROM Missing_Person WHERE idx = '$idx'";

    if($conn -> query($sql) === TRUE){
      unlink($photo);
      echo "<script>";
      echo "alert('삭제가 완료되었습니다.');";
      echo "location.href='https://jj7932.cafe24.com/dbp/missing_person_info.php'";
      echo "</script>";
    }
  case "cm":
    $sql = "DELETE FROM wanted WHERE idx = '$idx'";

    if($conn -> query($sql) === TRUE){
      unlink($photo);
      echo "<script>";
      echo "alert('삭제가 완료되었습니다.');";
      echo "location.href='https://jj7932.cafe24.com/dbp/criminal_info.php'";
      echo "</script>";
    }
}
?>
