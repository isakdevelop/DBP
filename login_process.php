<?php
session_start();

$id = $_POST['id-input'];
$password = $_POST['pw-input'];

$host = "jj7932.cafe24.com";
$user = "jj7932";
$pw = "Wowlsdl15987!";
$dbName = "jj7932";

$conn = new mysqli($host, $user, $pw, $dbName);

if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}

$sql = "SELECT name, pw, email, phone FROM user_infomation WHERE id='$id'";

$result = mysqli_query($conn, $sql);
$nameFromDB;
$pwFromDB;
$emailFromDB;
while($row = mysqli_fetch_array($result)){
  $nameFromDB = $row['name'];
  $pwFromDB = $row['pw'];
  $emailFromDB = $row['email'];
  $phoneFromDB = $row['phone'];

  if($password === $pwFromDB){
    $_SESSION['id'] = $id;
    $_SESSION['email'] = $emailFromDB;
    $_SESSION['name'] = $nameFromDB;
    $_SESSION['phone'] = $phoneFromDB;
    $_SESSION['pw'] = $pwFromDB;
    echo "<script>";
    echo "location.href = 'https://jj7932.cafe24.com/dbp/main.php';";
    echo "</script>";
  }
  else {
    echo "<script>";
    echo "alert('잘못된 비밀번호입니다!');";
    echo "location.href='https://jj7932.cafe24.com/dbp/login.php';";
    echo "</script>";
  }
}
// else{
//   echo "<script>";
//   echo "alert('존재하지 않는 아이디 입니다.');";
//   echo "location.href='https://jj7932.cafe24.com/dbp/login.php';";
//   echo "</script>";
// }


$sql = "SELECT name, pw, phone, police_station_in_charge AS psic, jurisdiction FROM Police WHERE polNum='$id'";

$result = mysqli_query($conn, $sql);
$nameFromDB;
$pwFromDB;
while($row = mysqli_fetch_array($result)){
  $nameFromDB = $row['name'];
  $pwFromDB = $row['pw'];
  $phoneFromDB = $row['phone'];
  $psicFromDB = $row['psic'];
  $jurisdictionFromDB = $row['jurisdiction'];


  if($password === $pwFromDB){
    $_SESSION['id'] = $id;
    $_SESSION['name'] = $nameFromDB;
    $_SESSION['police'] = $id;
    $_SESSION['phone'] = $phoneFromDB;
    $_SESSION['psic'] = $psicFromDB;
    $_SESSION['jurisdiction'] = $jurisdictionFromDB;
    $_SESSION['pw'] = $pwFromDB;

    echo "<script>";
    echo "location.href = 'https://jj7932.cafe24.com/dbp/main.php';";
    echo "</script>";
  }
  else {
    echo "<script>";
    echo "alert('잘못된 비밀번호입니다!');";
    echo "location.href='https://jj7932.cafe24.com/dbp/login.php';";
    echo "</script>";
  }
}
// else{
//   echo "<script>";
//   echo "alert('존재하지 않는 아이디 입니다.');";
//   echo "location.href='https://jj7932.cafe24.com/dbp/login.php';";
//   echo "</script>";
// }

$userId = $_SESSION['id'] ?? '';
$isExist = false;
if($userId == ''){
  $isExist = false;
}
else{
  $isExist = true;
}

if(!$isExist){
  echo "<script>";
  echo "alert('존재하지 않는 아이디 입니다.');";
  echo "location.href='https://jj7932.cafe24.com/dbp/login.php';";
  echo "</script>";
}

?>
