<?php
$host = "jj7932.cafe24.com";
$user = "jj7932";
$pw = "Wowlsdl15987!";
$dbName = "jj7932";

$idx = $_GET['idx'];

$pwFromDB;
$conn = new mysqli($host, $user, $pw, $dbName);

if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}

$sql = "DELETE FROM danger_zone WHERE idx = '$idx'";

if($conn -> query($sql) === TRUE){
  echo "New record created successfully";
  echo "<script>";
  echo "alert('삭제 되었습니다.');";
  echo "location.href='https://jj7932.cafe24.com/dbp/danger_map_result.php';";
  echo "</script>";
}
else{
  echo "Error: " . $sql . "<br>" . $conn->error;
}
?>
