<?php
$host = "jj7932.cafe24.com";
$user = "jj7932";
$pw = "Wowlsdl15987!";
$dbName = "jj7932";

$conn = new mysqli($host, $user, $pw, $dbName);

if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}

echo "<script>";
echo "var pol_arr = new Array();"; //아이디를 저장할 배열 선언.
echo "</script>";

$sql = "SELECT polNum FROM Police";

$result = mysqli_query($conn, $sql);

while($row = mysqli_fetch_array($result)){
  $polFromDB = $row['polNum'];

  echo "<script>";
  echo "var pol_n = '$polFromDB';"; // 데이터베이스에 있는 id값을 자바스크립트 id 변수에 저장.
  echo "pol_arr.push(pol_n);"; //id 배열에 저장.
  echo "</script>";
}
?>
<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <link rel="shortcut icon" href="./img/titleLogo.png">
    <link rel="stylesheet" href="./css/insert_Missing_Person.css">
    <title>수배자 정보 등록</title>
  </head>
  <body>
    <center class="banner">
      <a href="https://jj7932.cafe24.com/dbp/main.php"><img src="./img/titleLogoS.png" alt="배너"></a>
    </center>
    <div id="content">
      <form action="./insert_Wanted_Process.php" method="post" name="form" enctype="multipart/form-data" novalidate>
        <h3 class="join_title"><label for="pol">담당 경찰 번호<small> (필수)</small></label></h3>
        <span class="box int_pol">
          <input type="text" id="pol" name="pol" class="int" maxlength="20" onchange="check_pol()" onblur="check_pol()">
        </span>
        <span id = "check_pol_1" style="color:blue">&nbsp;경찰 번호가 존재합니다!</span>
        <span id = "check_pol_2" style="color:red">&nbsp;경찰 번호가 존재하지않습니다!</span>
        <h3 class="join_title"><label for="name">사진</label></h3>
        <span class="box_int_photo">
          <input type="file" id="photo" name="photo" accept="image/*" onchange="setThumbnail(event);">
          <div id="image_container"></div>
        </span>
        <h3 class="join_title"><label for="name">성명<small> (필수)</small></label></h3>
        <span class="box int_name">
            <input type="text" id="name" name="name" class="int" maxlength="20" placeholder="홍길동">
        </span>
        <h3 class="join_title"><label for="crime">죄목<small> (필수)</small></label></h3>
        <span class="box int_crime">
            <input type="text" id="crime" name="crime" class="int" maxlength="10" placeholder="살인">
        </span>
        <h3 class="join_title"><label for="Place_of_Registration">등록지<small> (필수)</small></label></h3>
        <span class="box int_Place_of_Registration">
            <input type="text" id="Place_of_Registration" name="Place_of_Registration" class="int" maxlength="40" placeholder="천안시 서북구 공대길 27">
        </span>
        <h3 class="join_title"><label for="address">주소<small> (필수)</small></label></h3>
        <span class="box int_address">
            <input type="text" id="address" name="address" class="int" maxlength="40" placeholder="천안시 서북구 천안대로 1223-24">
        </span>
        <!-- JOIN BTN-->
        <div class="btn_area">
            <input type="button" id="btnJoin" value="이 전" onclick="location.href='./main.php'">
            </input>
            <input type="button" id="btnJoin" value="등 록" onclick="insert()">
                <!-- type을 submit에서 button으로 변경함 -->
            </input>
      </div>
      </form>
      <footer>
          <div class="copyright-wrap">
          <span> Copyright © SCHNET Corp. All Rights Reserved.</span>
          </div>
      </footer>
    </div>
      <script
          src="https://code.jquery.com/jquery-3.6.1.slim.min.js"
          integrity="sha256-w8CvhFs7iHNVUtnSP0YKEg00p9Ih13rlL9zGqvLdePA="
          crossorigin="anonymous">
      </script>
    <script>
        function check_pol(){
          var pol = document.getElementById('pol').value;
          for(var i = 0; i < pol_arr.length; i++){
            if(pol_arr[i] == pol){
              document.getElementById("check_pol_1").style.display = 'block'
              document.getElementById("check_pol_2").style.display = 'none'
              pass_pol = true;
              return;
            }
            else {
              document.getElementById("check_pol_1").style.display = 'none'
              document.getElementById("check_pol_2").style.display = 'block'
              pass_pol = false;
            }
          }
        }

        function insert(){
          pol = document.getElementById('pol').value;
          name = document.getElementById('name').value;
          crime = document.getElementById('crime').value;
          Place_of_Registration = document.getElementById('Place_of_Registration').value;
          address = document.getElementById('address').value;

          if(name != '' && crime != '' && Place_of_Registration != '' && address != ''){
            form.submit();
          }
          else {
            alert('모든 필수 정보를 입력해 주세요!');
            return;
          }
        }
        function setThumbnail(event) {
        var reader = new FileReader();

        reader.onload = function(event) {
          var img = document.createElement("img");
          img.style.width = "200px";
          img.style.height = "250px";
          img.setAttribute("src", event.target.result);
          document.querySelector("div#image_container").appendChild(img);
        };

        reader.readAsDataURL(event.target.files[0]);
      }
      </script>
    </body>
  </html>
