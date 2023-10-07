<?php
$title = $_GET['title'];
$content = $_GET['content'];
$idx = $_GET['idx'];
$host = "jj7932.cafe24.com";
$user = "jj7932";
$pw = "Wowlsdl15987!";
$dbName = "jj7932";

$conn = new mysqli($host, $user, $pw, $dbName);
if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}

$sql = "UPDATE Missing_Person_Report SET title = '$title', content = '$content' WHERE idx = '$idx'";

if($conn -> query($sql) === TRUE){
  echo "<script>location.href='https://jj7932.cafe24.com/dbp/report_missing_person.php'</script>";
}
