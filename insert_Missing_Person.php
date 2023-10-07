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
    <link rel="shoutcut icon" type="image/x-icon" href="./img/titleLogoS.png">
    <link rel="stylesheet" href="./css/insert_Missing_Person.css">
    <link rel="shortcut icon" href="./img/titleLogo.png">
    <link rel="apple-touch-icon-precomposed" href="./img/titleLogo.png">
    <title>실종자 정보 등록</title>
  </head>
  <body>
    <center class="banner">
      <a href="https://jj7932.cafe24.com/dbp/main.php"><img src="./img/titleLogoS.png" alt="배너"></a>
    </center>
    <div id="content">
      <form action="./insert_Missing_Person_Process.php" method="post" name="form" enctype="multipart/form-data" novalidate>
        <h3 class="join_title"><label for="pol">담당 경찰<small> (필수)</small></label></h3>
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
        <h3 class="join_title"><label for="gender">성별<small> (필수)</small></label></h3>
        <span class="box gender_code">
            <select id="gender" name="gender" class="sel">
                <option>성별</option>
                <option value="남자">남자</option>
                <option value="여자">여자</option>
            </select>
        </span>
        <h3 class="join_title"><label for="age">나이</label></h3>
        <span class="box int_age">
            <input type="text" id="age" name="age" class="int" maxlength="3" placeholder="30" oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*)\./g, '$1');">
        </span>
        <h3 class="join_title"><label for="nationality">국적<small> (필수)</small></label></h3>
        <span class="box nationality_code">
            <select id="nationality" name="nationality" class="sel">
                <option>국적</option>
                <option value="내국인">내국인</option>
                <option value="외국인">외국인</option>
            </select>
        </span>
        <h3 class="join_title"><label for="date_of_occurrence">발생 일자<small> (필수)</small></label></h3>
        <span class="box int_date_of_occurrence">
            <input type="text" id="date_of_occurrence" name="date_of_occurrence" class="int" maxlength="20" placeholder="1999년 12월 03일">
        </span>
        <h3 class="join_title"><label for="input_address">주소 입력<small> (편의 기능)</small></label></h3>
        <span class="box int_input_address">
          <div class="input">
            <input id="inputText" type="text" name="address" class="int" maxlength="30" placeholder="주소입력(예:서북구 천안대로 1223-24)">
            <input type="button" id="searchButton" value="검색"></input>
          </div>
        </span>
        <br>
        <div id="map" style="width:100%; height:500px;"></div>
        <h3 class="join_title"><label for="address">주소<small> (필수)</small></label></h3>
        <span class="box int_address">
            <input type="text" id="address" name="address" class="int" maxlength="40">
        </span>
        <h3 class="join_title"><label for="lat_lng">위도 & 경도<small> (필수)</small></label></h3>
        <span class="box int_lat">
            <input type="text" id="lat" name="lat" class="int" maxlength="30">
        </span><br>
        <span class="box int_lng">
            <input type="text" id="lng" name="lng" class="int" maxlength="30">
        </span>
        <h3 class="join_title"><label for="height">키</label></h3>
        <span class="box int_height">
            <input type="text" id="height" name="height" class="int" maxlength="3" placeholder="180" oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*)\./g, '$1');">
        </span>
        <h3 class="join_title"><label for="weight">몸무게</label></h3>
        <span class="box int_weight">
            <input type="text" id="weight" name="weight" class="int" maxlength="3" placeholder="70" oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*)\./g, '$1');">
        </span>
        <h3 class="join_title"><label for="bulid">체형</label></h3>
        <span class="box int_bulid">
            <input type="text" id="bulid" name="bulid" class="int" maxlength="5" placeholder="보통">
        </span>
        <h3 class="join_title"><label for="face_shape">얼굴형</label></h3>
        <span class="box int_face_shape">
            <input type="text" id="face_shape" name="face_shape" class="int" maxlength="5" placeholder="둥근형">
        </span>
        <h3 class="join_title"><label for="hair_color">두발 색상</label></h3>
        <span class="box int_hair_color">
            <input type="text" id="hair_color" name="hair_color" class="int" maxlength="5" placeholder="흑색">
        </span>
        <h3 class="join_title"><label for="hair_shape">두발 형태</label></h3>
        <span class="box int_hair_shape">
            <input type="text" id="hair_shape" name="hair_shape" class="int" maxlength="10" placeholder="곱슬머리">
        </span>
        <h3 class="join_title"><label for="cloth">착의 의상</label></h3>
        <span class="box int_cloth">
            <input type="text" id="cloth" name="cloth" class="int" maxlength="10" placeholder="꽃무늬 난방">
        </span>
        <!-- JOIN BTN-->
        <div class="btn_area">
            <input type="button" id="btnJoin" value="이 전" onclick="history.back()">
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
      <script type="text/javascript" src="//dapi.kakao.com/v2/maps/sdk.js?appkey=3fa891f223b08bd5be79955ae8d9c082&libraries=services"></script>
      <script
          src="https://code.jquery.com/jquery-3.6.1.slim.min.js"
          integrity="sha256-w8CvhFs7iHNVUtnSP0YKEg00p9Ih13rlL9zGqvLdePA="
          crossorigin="anonymous">
      </script>
    <script>
    var lat_ = document.getElementById('lat');
    var lng_ = document.getElementById('lng');
    var address_ = document.getElementById('address');
        window.addEventListener('DOMContentLoaded', function() {
            document.getElementById("searchButton").addEventListener("click", searchAddress);
        });

        var mapContainer = document.getElementById('map'), // 지도를 표시할 div
            mapOption = {
                center: new kakao.maps.LatLng(36.85229272598323, 127.1503037298312), // 지도의 중심좌표
                level: 2 // 지도의 확대 레벨
            };

            var markerCount;
            var at = 0;
            var lo= 0;
            var dbSubmitAddress;

        // 지도를 표시할 div와  지도 옵션으로  지도를 생성합니다
        var map = new kakao.maps.Map(mapContainer, mapOption);
        // 지도를 클릭한 위치에 표출할 마커입니다
        var marker = new kakao.maps.Marker({
            // 지도 중심좌표에 마커를 생성합니다
            position: map.getCenter()
        });
        // 지도에 마커를 표시합니다
        marker.setMap(map);
        var geocoder=new daum.maps.services.Geocoder();
        // 지도에 클릭 이벤트를 등록합니다
        // 지도를 클릭하면 마지막 파라미터로 넘어온 함수를 호출합니다
        kakao.maps.event.addListener(map, 'click', function(mouseEvent) {

            // 클릭한 위도, 경도 정보를 가져옵니다
            var latlng = mouseEvent.latLng;

            // 마커 위치를 클릭한 위치로 옮깁니다
            marker.setPosition(latlng);


            at = latlng.getLat();
            lo = latlng.getLng();
            getDBSubmitAddress(lo, at, function(result, status){
              if(status == kakao.maps.services.Status.OK){
                dbSubmitAddress = !!result[0].road_address ? (result[0].road_address.address_name) : result[0].address.address_name;

                console.log(at);
                console.log(lo);
                console.log(dbSubmitAddress);
                lat_.value = at;
                lng_.value = lo ;
                address_.value = dbSubmitAddress;
              }
            });
        });

        function searchAddress(){
          // 주소-좌표 변환 객체를 생성합니다
          var geocoder = new kakao.maps.services.Geocoder();

          var address = document.getElementById("inputText").value;

          if(address===""){
            alert('주소를 입력해주세요.');
            return;
          }

          // 주소로 좌표를 검색합니다
          geocoder.addressSearch(address, function(result, status) {

              // 정상적으로 검색이 완료됐으면
               if (status === kakao.maps.services.Status.OK) {

                  var coords = new kakao.maps.LatLng(result[0].y, result[0].x);

                  //마커 표시
                  marker.setPosition(coords);
                  //마커가 있는 곳으로 확대 레벨1로 이동(중앙으로)
                  map.setCenter(coords);
                  map.setLevel(1);
                  at = coords.getLat();
                  lo = coords.getLng();
                  getDBSubmitAddress(lo, at, function(result, status){
                    if(status == kakao.maps.services.Status.OK){
                      dbSubmitAddress = !!result[0].road_address ? (result[0].road_address.address_name) : result[0].address.address_name;
                      console.log(at);
                      console.log(lo);
                      console.log(dbSubmitAddress);
                      lat_.value = at;
                      lng_.value = lo ;
                      address_.value = dbSubmitAddress;
                    }
                  });
              }
          });
        }

        function getDBSubmitAddress(lng, lat, callback){
          geocoder.coord2Address(lng, lat, callback);
        }

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
          gender = document.getElementById('gender').value;
          age = document.getElementById('age').value;
          nationality = document.getElementById('nationality').value;
          date_of_occurrence = document.getElementById('date_of_occurrence').value;
          lat = document.getElementById('lat').value;
          lng = document.getElementById('lng').value;
          address = document.getElementById('address').value;
          weight = document.getElementById('weight').value;
          height = document.getElementById('height').value;
          bulid = document.getElementById('bulid').value;
          face_shape = document.getElementById('face_shape').value;
          hair_color = document.getElementById('hair_color').value;
          hair_shape = document.getElementById('hair_shape').value;
          cloth = document.getElementById('cloth').value;

          if (pass_pol == true) {
            if(name != '' && gender != '' && nationality != '' && date_of_occurrence != '' && lat != ''&& lng != '' && address != ''){
              form.submit();
            }
            else {
              alert('모든 필수 정보를 입력해 주세요!');
              return;
            }
          }
          else {
            alert('존재하지 않는 경찰 번호 입니다!');
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
