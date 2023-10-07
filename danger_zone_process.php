<?php
    $userID = $_GET['id'];
    $lat = $_GET['at'];
    $lng =$_GET['lo'];
    $report_content = $_GET['txt'];
    $address = $_GET['address'];

    $host = "jj7932.cafe24.com";
    $user = "jj7932";
    $pw = "Wowlsdl15987!";
    $dbName = "jj7932";

    $conn = new mysqli($host, $user, $pw, $dbName);

    // Check connection
    if ($conn->connect_error) {
      die("Connection failed: " . $conn->connect_error);
    }

    $sql = "INSERT INTO danger_zone(id, address, lat, lng, report_content) VALUES('$userID', '$address', '$lat', '$lng', '$report_content')";

    if ($conn->query($sql) === TRUE) {
      echo "<script>";
      echo "alert('등록이 완료되었습니다!');";
      echo "location.href='https://jj7932.cafe24.com/dbp/main.php';";
      echo "</script>";
    } else {
      echo "<script>";
      echo "alert('등록에 실패했습니다!');";
      echo "</script>";
      echo "Error: " . $sql . "<br>" . $conn->error;
    }
    $conn -> close();
?>
