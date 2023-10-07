<?php
session_start();

$title = $_POST['title'] ?? '';
$content = $_POST['content'] ?? '';
$password = $_POST['password'] ?? '';
$idx = $_GET['idx'] ?? '';

$host = "jj7932.cafe24.com";
$user = "jj7932";
$pw = "Wowlsdl15987!";
$dbName = "jj7932";

$conn = new mysqli($host, $user, $pw, $dbName);
$sql = "SELECT name FROM wanted WHERE idx = '$idx'";

$result = mysqli_query($conn, $sql);
$userID = $_SESSION['id'];
echo $_SESSION['id'] ?? '없음';
$name;
while($row = mysqli_fetch_array($result)){
  $name = $row['name'];
}

$sql = "INSERT INTO wanted_report(title, name, content, idx_ref_mp, id, pw) VALUES('$title', '$name', '$content', '$idx', '$userID', '$password')";

if($conn -> query($sql) === TRUE){
  echo "<script>";
  echo "alert('저장 되었습니다.');";
  echo "location.href='https://jj7932.cafe24.com/dbp/report_criminal.php';";
  echo "</script>";
}
else {
  echo "<script>";
  echo "alert('아닌데용?');";
  echo "</script>";
}

?>
