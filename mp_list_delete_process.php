<?php
$idx = $_GET['idx'];
$name = $_GET['name'];
$host = "jj7932.cafe24.com";
$user = "jj7932";
$pw = "Wowlsdl15987!";
$dbName = "jj7932";

$conn = new mysqli($host, $user, $pw, $dbName);
if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}

$sql = "DELETE FROM Missing_Person_Report WHERE idx = '$idx'";

if($conn -> query($sql) === TRUE){
  echo "<script>location.href='https://jj7932.cafe24.com/dbp/list_missing_person.php?name=$name';</script>";
}
?>
